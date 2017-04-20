<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Listing;
use App\Brand;

class CategoriesController extends Controller
{
    public function show(Category $category, Request $request, Brand $brand=null)
    {
        $filter = $request->only('sort');
        $filter['brand'] = $brand;
        $listings = $category->getListings($filter);

        $categories = $category->ancestorsAndSelf()->get();

        foreach ($categories as $c) {
            $this->breadcrumbs->addCrumb($c->name, route('category.show', $c->slug));
        }

        $childrenCategories = $listingsWithBrand = null;
        $topCategories = collect([]);

        if ($category->getLevel() == 0) {

            foreach ($category->children as $k => $c) {
                $topCategories[$k] = collect([
                    'category' => $c,
                    'reviews' => $c->reviews(),
                ]);
            }

            $childrenCategories = $category->children->sortBy('name')->all();
        }

        $listingsWithBrand = Listing::categorized($category)
            ->has('brand')
            ->has('reviews')
            ->groupBy('brand_id')
            ->get()->sortBy(function($listing) {
                return $listing->brand->listings->count();
            }, SORT_REGULAR, true)->take(12);

        $title = $category->title;

        if ($brand->id) {
            $title = $brand->title . ' - ' . $title;
        }

        return $this->display('categories.show', [
            'category' => $category,
            'title' => $title,
            'listings' => $listings,
            'childrenCategories' => $childrenCategories,
            'listingsWithBrand' => $listingsWithBrand,
            'topCategories' => $topCategories->sortByDesc('reviews')->take(16),
            'breadcrumbs' => $this->breadcrumbs,
            'brand' => $brand,
        ]);
    }
}