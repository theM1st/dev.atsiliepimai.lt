<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;
use App\User;
use App\Message;
use Auth;

class MessagesController extends Controller
{
    public function index($section)
    {
        $viewData = [
            'title' => trans('common.messages.'.$section),
            'section' => $section,
            'user' => \Auth::user(),
        ];

        $this->breadcrumbs->addCrumb(trans('common.messages.'.$section));

        $viewData['breadcrumbs'] = $this->breadcrumbs;
        
        return $this->display('messages.index', $viewData);
    }

    public function create(User $recipient)
    {
        $section = 'create';

        $this->breadcrumbs->addCrumb(trans('common.messages.'.$section));

        return $this->display('messages.index', [
            'title' => trans('common.messages.'.$section),
            'section' => $section,
            'recipient' => $recipient,
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }

    public function store(MessageRequest $request)
    {
        $user = Auth::user();

        $message = new Message($request->all());

        $user->messagesOut()->save($message);

        return redirect($request->redirect);
    }

    public function show($section, Message $message)
    {
        $title = 'Žinutė ' . $message->title;

        $this->breadcrumbs->addCrumb(trans('common.messages.'.$section), route('messages.index', $section));
        $this->breadcrumbs->addCrumb($title);

        $section = 'show';

        if ($message->new) {
            $message->new = 0;
            $message->save();
        }

        return $this->display('messages.index', [
            'title' => $title,
            'section' => $section,
            'message' => $message,
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }

    public function delete()
    {
        return [
            'html' => view('messages.delete', [
                'title' => 'Ar tikrai ištrinti?',
            ])->render()
        ];
    }

    public function destroy(Request $request)
    {
        Message::destroy($request->get('delete'));

        return back();
    }
}
