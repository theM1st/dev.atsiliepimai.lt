<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\ListingRequest;
use App\Category;
use App\Listing;
use App\Attribute;
use App\Review;

class ListingsController extends AdminController
{
    public function index()
    {
        $listings = Listing::all();

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
            $listing->attributes()->sync($attributes['attribute_id']);
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

    public function reviews(Listing $listing, Request $request, $slug=null)
    {
        $reviews = $listing->getReviews($request->only('sort'));

        return $this->display($this->viewPath('reviews'), [
            'listing' => $listing,
            'reviews' => $reviews,
            'title' => sprintf('%s %s (%d)', $listing->title, trans('common.reviews'), count($listing->reviews))
        ]);
    }
}
