<div class="form-group">
    <label class="control-label">Gavėjas</label>
    <img src="{{ $receiver->getPicture() }}" alt="{{ $receiver->username }}" class="img-circle img-border-grey img-responsive" style="width: 40px">
    <span>{{ $receiver->username }}</span>
</div>

{!! Former::open()->route('messages.store')->method('post') !!}
    {!! Former::text('subject')->label('common.form.message.title') !!}
    {!! Former::textarea('body')->rows(4)->label('common.form.message.content') !!}
    {!! Former::hidden('receiver_id')->value($receiver->id) !!}

    {!! Form::submit(trans('common.form.message.send'), ['class' => 'btn btn-first btn-lg']) !!}
{!! Former::close() !!}
