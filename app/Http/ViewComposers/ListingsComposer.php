<?php

namespace App\Http\ViewComposers;

use App\Listing;
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
        
        $viewedListings = Listing::recentViewed();

        if ($viewedListings && $viewedListings->count()) {
            $html = view('listings.partials.recentlyViewedListings', [ 'listings' => $viewedListings ])->render();
        }

        $view->with('recentlyViewedListings', $html);
    }
}