<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Listing;
use App\Question;
use Auth;

class QuestionsController extends Controller
{
    public function store(Listing $listing, QuestionRequest $request)
    {
        $data = $request->all();

        $data['user_id'] = Auth::user()->id;

        $question = new Question($data);

        $saved = $listing->questions()->save($question);

        if ($saved) {
            alert(trans('common.form.question.create.success'), 'success');
        } else {
            alert(trans('common.form.question.create.fail'), 'danger');
        }

        return back();
    }
}
