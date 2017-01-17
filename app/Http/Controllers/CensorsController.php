<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CensorRequest;
use App\Listing;
use App\Review;
use App\Censor;
use App\Question;
use App\Answer;
use Auth;

class CensorsController extends Controller
{
    public function create(Listing $listing, $commentableType, $commentableId)
    {
        return $this->display('censors.create', [
            'listing' => $listing,
            'commentableType' => $commentableType,
            'commentableId' => $commentableId,
        ]);
    }

    public function store(CensorRequest $request)
    {
        $listing = Listing::findOrFail($request->get('listing_id'));

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        $censor = new Censor($data);

        if ($request->get('commentable_type') == 'review') {
            $review = Review::find($request->get('commentable_id'));

            $review->censors()->save($censor);
        }

        if ($request->get('commentable_type') == 'question') {
            $question = Question::find($request->get('commentable_id'));

            $question->censors()->save($censor);
        }

        if ($request->get('commentable_type') == 'answer') {
            $answer = Answer::find($request->get('commentable_id'));

            $answer->censors()->save($censor);
        }

        alert(trans('common.form.censor.create.success'), 'success');

        return redirect()->route('listing.show', $listing->slug);
    }
}
