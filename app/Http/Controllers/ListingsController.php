<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ListingRequest;
use App\Category;
use App\Listing;
use Auth;

class ListingsController extends Controller
{
    public function create(Request $request)
    {
        $listings = null;

        if ($request->get('q')) {
            $listings = Listing::where('title', 'like', '%' . $request->get('q') . '%')
                ->paginate(20);
        }

        return $this->display('listings.create', [
            'q' => $request->get('q'),
            'listings' => $listings
        ]);
    }

    public function globalCreate(Request $request, Listing $listing)
    {
        $categories = Category::all()->toHierarchy();

        return $this->display('listings.global_create', [
            'categories' => $categories,
            'name' => $request->get('name'),
            'listing' => $listing,
        ]);
    }

    public function store(ListingRequest $request)
    {
        $request->merge(['active' => 1]);

        $listing = Listing::create($request->all());

        if ($listing) {
            alert(trans('common.form.review.create.success'), 'success');
            
            return redirect()->route('profile.show', ['section' => 'reviews']);
        } else {
            alert(trans('common.form.reviews.create.fail'), 'danger');
        }

        return back();
    }

    public function show(Listing $listing, Request $request, $model=null)
    {
        if (!$listing->active || $listing->reviews->count() == 0) {
            abort(404);
        }

        if ($model) {
            $request->merge(['model' => $model]);
        }

        $reviews = $listing->getReviews($request->only('sort', 'model', 'filter'));

        $questions = $listing->getQuestions($request->only('model'));

        if (\Auth::check()) {
            \Auth::user()->viewedListings()->detach($listing->id);
            \Auth::user()->viewedListings()->attach($listing->id);
        }

        return $this->display('listings.show', [
            'listing' => $listing,
            'reviews' => $reviews,
            'questions' => $questions,
            'model' => $model,
        ]);
    }

    public function search(Request $request)
    {
        $filter = $request->only('sort');

        $listings = Listing::where('title', 'like', '%' . $request->get('q') . '%')
            ->has('reviews')
            ->filter($filter)->paginate(20);

        return $this->display('listings.search', [
            'q' => $request->get('q'),
            'listings' => $listings
        ]);
    }

    public function recentlyViewedRemove(Listing $listing)
    {
        \Auth::user()->viewedListings()->detach($listing->id);

        return back();
    }

    public function recentlyViewedRemoveAll()
    {
        \Auth::user()->viewedListings()->remove();

        return back();
    }
}
