<div class="mail-messages">
    <div class="replay-form">
        {!! Former::open()->route('messages.reply', [$subject->id])->method('post') !!}
            <div class="row">
                <div class="col-sm-10">
                    {!! Former::textarea('body')->rows(2)->label('')->placeholder('Žinutė...') !!}
                </div>
                <div class="col-sm-2">
                    {!! Form::submit('Siųsti žinutę', ['class' => 'btn btn-first']) !!}
                </div>
            </div>
            {!! Former::hidden('receiver_id')->value($receiver->id) !!}
        {!! Former::close() !!}
    </div>
    <hr>
    @foreach ($subject->messages as $item)
        <div class="message{{ ($item->sender_id == $user->id ? ' right' : '')}}">
            <div class="message-info">
                <span class="user">
                    @if ($item->sender_id != $user->id)
                        {{ $item->sender->username }}
                    @endif
                </span>
                <span class="date">
                    {{ $item->created_at->format('Y-m-d H:i') }}
                </span>
            </div>
            <img src="{{ $item->sender->getPicture() }}" alt="{{ $item->sender->username }}" class="img-circle img-border-grey img-responsive">
            <div class="message-text">
                {{ $item->body }}
            </div>
        </div>
    @endforeach

</div>