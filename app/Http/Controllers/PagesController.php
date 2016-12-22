<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class PagesController extends Controller
{
    public function index()
    {
        $popularCategories = Category::popular()->get();
        
        return $this->display('pages.index', [
            'title' => '',
            'popularCategories' => $popularCategories,
        ]);
    }
}
