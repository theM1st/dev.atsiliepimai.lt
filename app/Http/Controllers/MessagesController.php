<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;
use App\User;
use App\Message;
use App\MailSubject;
use App\MailMessage;
use App\MailBox;
use Auth;

class MessagesController extends Controller
{
    public function index($section)
    {
        $box = 'in';

        if ($section == 'outbox') {
            $box = 'out';
        }

        $messages = MailMessage::box($box)->get();

        $viewData = [
            'title' => trans('common.messages.'.$section),
            'section' => $section,
            'messages' => $messages,
            'user' => \Auth::user(),
        ];

        $this->breadcrumbs->addCrumb(trans('common.messages.'.$section));

        $viewData['breadcrumbs'] = $this->breadcrumbs;
        
        return $this->display('messages.index', $viewData);
    }

    public function create(User $receiver)
    {
        $section = 'create';

        $this->breadcrumbs->addCrumb(trans('common.messages.'.$section));

        return $this->display('messages.index', [
            'title' => trans('common.messages.'.$section),
            'section' => $section,
            'receiver' => $receiver,
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }

    public function store(MessageRequest $request)
    {
        $data = $request->all();
        $data['sender_id'] = Auth::user()->id;

        $subject = MailSubject::create([ 'subject' => $request->get('subject') ]);

        $message = new MailMessage($data);

        $subject->messages()->save($message);


        return redirect()->route('messages.index', 'outbox');
    }

    public function show($section, MailSubject $subject)
    {
        $box = 'in';

        if ($section == 'outbox') {
            $box = 'out';
        }

        $messages = MailMessage::box($box)->where('subject_id', $subject->id);

        if ($messages->count() == 0) {
            abort(404);
        }

        if ($box == 'in') {
            $messages->update(['unread' => 0]);
        }

        $title = 'Žinutė ' . $subject->subject;

        $this->breadcrumbs->addCrumb(trans('common.messages.'.$section), route('messages.index', $section));
        $this->breadcrumbs->addCrumb($title);

        $section = 'show';
/*
        if ($message->new) {
            $message->new = 0;
            $message->save();
        }
*/

        return $this->display('messages.index', [
            'title' => $title,
            'section' => $section,
            'subject' => $subject,
            'breadcrumbs' => $this->breadcrumbs,
            'user' => Auth::user(),
            'receiver' => ($box == 'in' ? $messages->get()[0]->sender : $messages->get()[0]->receiver),
        ]);
    }

    public function reply(MailSubject $subject, Request $request)
    {
        $data = $request->all();
        $data['sender_id'] = Auth::user()->id;

        $message = new MailMessage($data);

        $subject->messages()->save($message);

        return redirect()->route('messages.index', 'outbox');
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
        $items = $request->get('delete');

        foreach ($items as $box => $item) {
            $subject = MailSubject::find($item);

            $subject[0]->boxes()->where('box', $box)
                ->where('user_id', Auth::user()->id)
                ->delete();
        }

        return back();
    }
}
