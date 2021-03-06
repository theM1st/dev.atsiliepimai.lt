<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\ListingRequest;
use App\Category;
use App\Listing;
use App\Attribute;
use App\AttributeOption;
use App\Brand;

class ListingsController extends AdminController
{
    public function index()
    {
        $listings = Listing::with('category')
            ->with('reviews')
            ->latest()
            ->take(500)->get();

        //dd($listings[0]->reviews()->first()->review_title);

        return $this->display($this->viewPath(), [
            'listings' => $listings
        ]);
    }

    public function create(Listing $listing)
    {
        $categories = Category::all()->toHierarchy();

        return $this->display($this->viewPath('create'), [
            'categories' => $categories,
            'listing' => $listing,
            'mainAttributes' => Attribute::main()->pluck('name', 'id'),
            'attributes' => Attribute::secondary()->pluck('name', 'id'),
        ]);
    }

    public function store(ListingRequest $request)
    {
        $request->merge(['active' => $request->get('active', 0)]);

        if ($model = $this->createAlert(Listing::class, $request)) {
        }

        return $this->redirectRoutePath();
    }

    public function edit(Listing $listing)
    {
        \Former::populate($listing);
        //dd($listing->attributes()->where('main', 1)->first()->options->toArray());
        $categories = Category::all()->toHierarchy();

        return $this->display($this->viewPath('edit'), [
            'categories' => $categories,
            'listing' => $listing,
            'mainAttributes' => Attribute::main()->pluck('name', 'id'),
            'attributes' => Attribute::secondary()->pluck('name', 'id'),
        ]);
    }

    public function update(Listing $listing, ListingRequest $request)
    {
        $request->merge(['active' => $request->get('active', 0)]);

        $saved = $this->saveAlert($listing, $request);

        if ($saved) {
            $attributes = $request->only('attribute_id');
            if (!empty($attributes['attribute_id'][0])) {
                $listing->attributes()->sync($attributes['attribute_id']);
            }
        }

        return $this->redirectRoutePath('back');
    }

    public function delete(Listing $listing)
    {
        return [
            'html' => view('admin.listings.delete', [
                'title' => 'Ar tikrai ištrinti?',
                'listing' => $listing,
            ])->render()
        ];
    }

    public function destroy(Listing $listing)
    {
        return $this->destroyAlertRedirect($listing);
    }

    public function toggleBrand(Listing $listing, $status)
    {
        if ($status == 'cancel') {
            $listing->update([ 'brand_value' => null]);

            alert('Produkto gamintojo reikšmė ištrinta.', 'success');
        }

        if ($status == 'accept') {
            $brandSlug = str_slug($listing->brand_value);
            $brand = Brand::where('slug', $brandSlug)->first();

            if (!$brand) {
                $brand = Brand::create([ 'name' => $listing->brand_value ]);
                $listing->brand_id = $brand->id;
                $listing->save();

                alert('Produkto gamintojo reikšmė sėkmingai įdėta į bendra sąrašą ir priskirta produktui.', 'success');
            }
        }

        return $this->redirectRoutePath('back');
    }

    public function reviews(Listing $listing, Request $request, $model=null)
    {
        if ($model) {
            $request->merge(['model' => $model]);
        }

        $reviews = $listing->getReviews($request->only('sort', 'model', 'filter'));

        $questions = $listing->getQuestions($request->only('model'));

        $model = AttributeOption::attributeOptionBySlug($model);

        return $this->display($this->viewPath('reviews'), [
            'listing' => $listing,
            'reviews' => $reviews,
            'questions' => $questions,
            'model' => $model,
            'title' => sprintf('%s %s', $listing->title, trans('common.reviews'))
        ]);
    }

    public function json()
    {
        $listings = Listing::where('title', 'like', '%' . request()->get('term') . '%')->get();

        return $listings;
    }
}
