<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use Auth;

class AnswersController extends Controller
{
    public function store(Question $question, AnswerRequest $request)
    {
        $data = $request->all();

        $data['user_id'] = Auth::user()->id;

        $answer = new Answer($data);

        $saved = $question->answers()->save($answer);

        if ($saved) {
            alert(trans('common.form.answer.create.success'), 'success');
        } else {
            alert(trans('common.form.answer.create.fail'), 'danger');
        }

        return back();
    }
}
