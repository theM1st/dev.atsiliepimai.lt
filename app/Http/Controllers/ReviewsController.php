<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Category;
use App\Listing;
use App\Review;
use App\UserReviewVote;
use Auth;

class ReviewsController extends Controller
{
    public function create(Listing $listing)
    {
        $categories = Category::all()->toHierarchy();

        return $this->display('reviews.create', [
            'categories' => $categories,
            'listing' => $listing,
            'review' => new Review,
        ]);
    }

    public function store(Listing $listing, ReviewRequest $request)
    {
        $data = $request->all();

        $data['user_id'] = Auth::user()->id;
        $data['active'] = 0;

        $review = new Review($data);

        $saved = $listing->reviews()->save($review);

        if ($saved) {
            $review->saveOptions($request->only('attribute_option_id', 'option_value'));

            alert(trans('common.form.review.create.success'), 'success');

            return redirect()->route('profile.show', ['section' => 'reviews']);
        } else {
            alert(trans('common.form.reviews.create.fail'), 'danger');
        }

        return back();
    }

    public function update(Review $review, ReviewRequest $request)
    {
        $review->saveOptions($request->only('attribute_option_id', 'option_value'));

        $request->merge(['active' => 0]);

        $review->fill($request->all());

        $review->save();

        $review->restore();

        alert(trans('common.form.review.update.success'), 'success');

        return redirect()->route('profile.show', 'reviews');
    }

    public function vote(Review $review, Request $request)
    {
        if (!is_null($request->get('like'))) {
            $v = 1;
        }

        if (!is_null($request->get('dislike'))) {
            $v = -1;
        }

        $vote = new UserReviewVote([
            'user_id' => \Auth::user()->id,
            'vote' => $v
        ]);

        ($review->votes()->save($vote)) ?
            alert(trans('common.review_vote.success'), 'success'):
            alert(trans('common.fail'), 'danger');

        return back();
    }
}
