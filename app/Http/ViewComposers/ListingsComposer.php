<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class ListingsComposer
{
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $html = '';
        
        if (\Auth::check()) {
            $viewedListings = \Auth::user()->viewedListings()->orderBy('pivot_created_at', 'desc')->get();
            if ($viewedListings->count()) {
                $html = view('listings.partials.recentlyViewedListings', [ 'listings' => $viewedListings ])->render();
            }
        }

        $view->with('recentlyViewedListings', $html);
    }
}