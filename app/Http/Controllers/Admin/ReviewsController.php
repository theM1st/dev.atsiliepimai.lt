<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\ReviewRequest;
use App\Category;
use App\Listing;
use App\Review;

class ReviewsController extends AdminController
{
    public function create(Listing $listing)
    {
        $categories = Category::all()->toHierarchy();

        return $this->display($this->viewPath('create'), [
            'categories' => $categories,
            'listing' => $listing
        ]);
    }

    public function store(ListingRequest $request)
    {
        $request->merge(['active' => $request->get('active', 0)]);

        return $this->createAlertRedirect(Listing::class, $request->all());
    }

    public function edit(Review $review)
    {
        \Former::populate($review);

        return $this->display($this->viewPath('edit'), [
            'review' => $review
        ]);
    }

    public function update(Review $review, ReviewRequest $request)
    {
        $request->merge(['active' => $request->get('active', 0)]);

        return $this->saveAlertRedirect($review, $request->all(), 'back');
    }

    public function delete(Review $review)
    {
        return [
            'html' => view('admin.reviews.delete', [
                'title' => 'Ar tikrai ištrinti?',
                'review' => $review,
            ])->render()
        ];
    }

    public function destroy(Review $review)
    {
        return $this->destroyAlertRedirect($review, 'back');
    }
}
