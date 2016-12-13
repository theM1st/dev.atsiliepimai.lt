<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\UserReviewVote;

class ReviewsController extends Controller
{
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
