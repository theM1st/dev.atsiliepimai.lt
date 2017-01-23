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

        return $this->display('categories.show', [
            'category' => $category,
            'title' => ($category->getLevel() ? $category->name . ' kategorijos atsiliepimai' : $category->name),
            'listings' => $listings,
        ]);
    }
}