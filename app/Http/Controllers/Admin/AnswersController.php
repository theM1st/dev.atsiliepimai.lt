<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\AnswerRequest;
use App\Answer;

class AnswersController extends AdminController
{
    public function edit(Answer $answer)
    {
        \Former::populate($answer);
        
        return $this->display($this->viewPath('edit'), [
            'answer' => $answer,
        ]);
    }

    public function update(Answer $answer, AnswerRequest $request)
    {
        $request->merge(['active' => $request->get('active', 0)]);

        $this->saveAlert($answer, $request);

        return redirect()->route('listings.reviews', $answer->question->listing->id);
    }

    public function delete(Answer $answer)
    {
        return [
            'html' => view('admin.answers.delete', [
                'title' => 'Ar tikrai ištrinti?',
                'answer' => $answer,
            ])->render()
        ];
    }

    public function destroy(Answer $answer)
    {
        return $this->destroyAlertRedirect($answer, 'back');
    }
}
