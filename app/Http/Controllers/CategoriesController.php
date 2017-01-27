<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Listing;

class CategoriesController extends Controller
{
    public function show(Category $category, Request $request)
    {
        $listings = $category->getListings($request->only('sort'));

        $categories = $category->ancestorsAndSelf()->get();

        foreach ($categories as $c) {
            $this->breadcrumbs->addCrumb($c->name, route('category.show', $c->slug));
        }

        return $this->display('categories.show', [
            'category' => $category,
            'title' => ($category->getLevel() ? $category->name . ' kategorijos atsiliepimai' : $category->name),
            'listings' => $listings,
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }
}