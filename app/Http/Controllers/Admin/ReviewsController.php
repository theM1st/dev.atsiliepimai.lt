<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\ReviewRequest;
use App\Category;
use App\Listing;
use App\Review;
use App\Attribute;
use App\AttributeOption;

class ReviewsController extends AdminController
{
    public function index()
    {
        $reviews = Review::latest()->where('active', 0)->get();

        return $this->display($this->viewPath(), [
            'reviews' => $reviews
        ]);
    }

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

        return $this->createAlertRedirect(Listing::class, $request);
    }

    public function edit(Review $review)
    {
        \Former::populate($review);
        
        return $this->display($this->viewPath('edit'), [
            'review' => $review,
        ]);
    }

    public function update(Review $review, ReviewRequest $request)
    {
        $review->saveOptions($request->only('attribute_option_id', 'option_value'));

        $request->merge(['active' => $request->get('active', 0)]);

        return $this->saveAlertRedirect($review, $request, 'back');
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

    public function destroy(Review $review, Request $request)
    {
        $permanently = false;
        if ($request->get('permanently_delete')) {
            $permanently = true;
        }

        if ($request->get('admin_note')) {
            $review->admin_note = $request->get('admin_note');
            $review->save();
        }
        
        return $this->destroyAlertRedirect($review, 'back', $permanently);
    }

    public function move(Review $review)
    {
        return $this->display($this->viewPath('move'), [
            'review' => $review,
        ]);
    }

    public function postMove(Review $review, Request $request)
    {
        $this->validate($request, [
            'listing_id' => 'required',
            'old_listing_id' => 'required',
        ]);

        $listing = Listing::findOrFail($request->listing_id);

        $review->listing_id = $listing->id;

        $return = $this->saveAlertRedirect($review, $request, 'edit', [$review->id]);

        Listing::find($request->old_listing_id)->updateAvgRating();

        return $return;
    }

    public function toggleOption(Review $review, $attributeId, $status)
    {
        $reviewAttribute = $review->getReviewAttribute($attributeId);

        if ($status == 'cancel') {
            $review->attributes()->detach($attributeId);

            alert('Atsiliepimo atributo reikšmė ištrinta. Nepamirškite pasirinkti kitą.', 'success');
        }

        if ($status == 'accept') {
            $attributeOption = new AttributeOption([
                'option_name' => $reviewAttribute->pivot->option_value,
            ]);

            $option = Attribute::find($attributeId)->options()->save($attributeOption);

            if ($option) {
                /*reviewAttributeOption::where('review_id', $review->id)
                    ->where('attribute_id', $attributeId)
                    ->delete();*/
                $review->attributes()->detach($attributeId);

                $review->attributes()->attach($attributeId, [ 'attribute_option_id' => $option->id ]);

                alert('Atsiliepimo atributo reikšmė sėkmingai įdėta į bendra sąrašą ir priskirta atsiliepimui.', 'success');
            }
        }

        return $this->redirectRoutePath('back');
    }
}
