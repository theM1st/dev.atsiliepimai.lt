<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\ListingRequest;
use App\Category;
use App\Listing;
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
            'listing' => $listing
        ]);
    }

    public function store(ListingRequest $request)
    {
        $request->merge(['active' => $request->get('active', 0)]);

        return $this->createAlertRedirect(Listing::class, $request->all());
    }

    public function edit(Listing $listing)
    {
        \Former::populate($listing);

        $categories = Category::all()->toHierarchy();

        return $this->display($this->viewPath('edit'), [
            'categories' => $categories,
            'listing' => $listing
        ]);
    }

    public function update(Listing $listing, ListingRequest $request)
    {
        $request->merge(['active' => $request->get('active', 0)]);

        return $this->saveAlertRedirect($listing, $request->all());
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

    public function reviews(Listing $listing)
    {
        $reviews = $listing->reviews()->paginate(3);

        return $this->display($this->viewPath('reviews'), [
            'listing' => $listing,
            'reviews' => $reviews,
            'title' => sprintf('%s %s (%d)', $listing->title, trans('common.reviews'), count($listing->reviews))
        ]);
    }
}
