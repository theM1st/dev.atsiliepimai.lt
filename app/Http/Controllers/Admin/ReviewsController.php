<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\ReviewRequest;
use App\Category;
use App\Listing;
use App\Review;
use App\Attribute;
use App\AttributeOption;
use App\reviewAttributeOption;

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

    public function destroy(Review $review)
    {
        return $this->destroyAlertRedirect($review, 'back');
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
