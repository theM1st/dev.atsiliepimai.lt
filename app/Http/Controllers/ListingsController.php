<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ListingRequest;
use App\Category;
use App\Listing;
use App\AttributeOption;
use Auth;

class ListingsController extends Controller
{
    public function create(Request $request)
    {
        $listings = null;

        if ($request->get('q')) {
            $listings = Listing::has('reviews')->where('title', 'like', '%' . $request->get('q') . '%')
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

        $listing->setRecentViewed();

        $similarListings = $listing->getSimilarListings();

        $model = AttributeOption::attributeOptionBySlug($model);

        $categories = $listing->category->ancestorsAndSelf()->get();

        foreach ($categories as $c) {
            $this->breadcrumbs->addCrumb($c->name, route('category.show', $c->slug));
        }

        $this->breadcrumbs->addCrumb($listing->title, '');

        return $this->display('listings.show', [
            'listing' => $listing,
            'similarListings' => $similarListings,
            'reviews' => $reviews,
            'questions' => $questions,
            'model' => $model,
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }

    public function search(Request $request)
    {
        $filter = $request->only('sort');

        $listings = Listing::where('title', 'like', '%' . $request->get('q') . '%')
            ->has('reviews')
            ->filter($filter)->paginate(20);

        $this->breadcrumbs->addCrumb('Paieška');

        return $this->display('listings.search', [
            'q' => $request->get('q'),
            'listings' => $listings,
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }

    public function recentlyViewedRemove(Listing $listing)
    {
        if (\Auth::check()) {
            \Auth::user()->viewedListings()->detach($listing->id);
        } else {
            $recentViewed = \Cache::get('recentViewedListings');
            
            foreach ($recentViewed as $k => $item) {
                if ($listing->id == $item->id) {
                    $recentViewed->forget($k);
                }
            }

            $expiresAt = \Carbon\Carbon::now()->addDays(30);
            \Cache::put('recentViewedListings', $recentViewed, $expiresAt);
        }

        return back();
    }

    public function recentlyViewedRemoveAll()
    {
        if (\Auth::check()) {
            \Auth::user()->viewedListings()->remove();
        } else {

        }

        return back();
    }
}
