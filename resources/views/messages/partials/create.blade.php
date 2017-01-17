{!! Former::open()->route('messages.store')->method('post') !!}
    {!! Former::text('title')->label('common.form.message.title') !!}
    {!! Former::textarea('content')->rows(4)->label('common.form.message.content') !!}
    {!! Former::hidden('recipient_id')->value($recipient->id) !!}
    {!! Former::hidden('redirect')->value(URL::previous()) !!}

    {!! Form::submit(trans('common.form.message.send'), ['class' => 'btn btn-first btn-lg']) !!}
{!! Former::close() !!}
