<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\QuestionRequest;
use App\Question;

class QuestionsController extends AdminController
{
    public function edit(Question $question)
    {
        \Former::populate($question);
        
        return $this->display($this->viewPath('edit'), [
            'question' => $question,
        ]);
    }

    public function update(Question $question, QuestionRequest $request)
    {
        $request->merge(['active' => $request->get('active', 0)]);

        $this->saveAlert($question, $request);

        return redirect()->route('listings.reviews', $question->listing->id);
    }

    public function delete(Question $question)
    {
        return [
            'html' => view('admin.questions.delete', [
                'title' => 'Ar tikrai ištrinti?',
                'question' => $question,
            ])->render()
        ];
    }

    public function destroy(Question $question)
    {
        return $this->destroyAlertRedirect($question, 'back');
    }
}
