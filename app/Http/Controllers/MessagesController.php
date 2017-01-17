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
        
        return $this->display('messages.index', $viewData);
    }

    public function create(User $recipient)
    {
        $section = 'create';

        return $this->display('messages.index', [
            'title' => trans('common.messages.'.$section),
            'section' => $section,
            'recipient' => $recipient
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
        $section = 'show';

        if ($message->new) {
            $message->new = 0;
            $message->save();
        }

        return $this->display('messages.index', [
            'title' => $message->title,
            'section' => $section,
            'message' => $message
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
