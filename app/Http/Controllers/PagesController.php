<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use App\Category;

class PagesController extends Controller
{
    public function index()
    {
        $popularCategories = Category::popular()->get();

        $lastReviews = Review::latest()->limit(4)->get();
        
        return $this->display('pages.index', [
            'title' => '',
            'popularCategories' => $popularCategories,
            'lastReviews' => $lastReviews,
        ]);
    }
}
