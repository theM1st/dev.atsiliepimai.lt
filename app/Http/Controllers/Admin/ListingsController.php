<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\ListingRequest;
use App\Category;
use App\Listing;

class ListingsController extends AdminController
{
    public function index()
    {

    }

    public function create()
    {
        //$listings = Listing::categorized(Category::find(2))->get();
        //dd($products);

        //$c = Category::allLeaves()->pluck('id')->toArray();

        $count = Category::withCount('reviews')->get();
        $reviews = Category::find(11)->reviews;
dd($reviews);
dd($count[0]->reviews_count);
        $categories = Category::all()->toHierarchy();

        return $this->display($this->viewPath('create'), [
            'categories' => $categories
        ]);
    }

    public function store(ListingRequest $request)
    {
        //return $this->createAlertRedirect(Country::class, $request->all());
    }
}
