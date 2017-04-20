<div class="messages-help-note">
    <a href="{{ route('messages.delete') }}" onclick="return actionModal(this)" data-method="get" data-size="modal-sm" class="btn btn-second btn-sm">Trinti pažymėtas</a>

    <div class="message-closed">
        <span class="fa fa-envelope" aria-hidden="true"></span>
        Žinutė neperskaityta
    </div>
    <div class="message-opened">
        <span class="fa fa-envelope-open-o" aria-hidden="true"></span>
        Žinutė perskaityta
    </div>
</div>
{!! Former::open()->route('messages.destroy')->secure()->method('delete')->id('messages-destroy') !!}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">
                    <input type="checkbox" class="icheck">
                </th>
                <th></th>
                <th>Data</th>
                <th>Siuntėjas</th>
                <th>Tema</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $m)
                <tr>
                    <td class="text-center">
                        <input type="checkbox" class="icheck" name="delete[in][]" value="{{ $m->subject->id }}">
                    </td>
                    <td class="text-center">
                        @if ($m->unread)
                            <span class="fa fa-envelope" aria-hidden="true"></span>
                        @else
                            <span class="fa fa-envelope-open-o" aria-hidden="true"></span>
                        @endif
                    </td>
                    <td>{{ $m->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <div class="user">
                            <a href="{{ route('user.show', $m->sender_id) }}">
                                <img src="{{ $m->sender->getPicture() }}" alt="" class="img-responsive img-circle img-border-grey">
                                {{ $m->sender->username }}
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="subject{{ ($m->unread ? ' new' : '') }}">
                            <a href="{{ route('messages.show', [$section, $m->subject->id]) }}">
                                {{ str_limit($m->subject->subject, 50) }}
                            </a>
                        </div>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('messages.show', [$section, $m->subject->id]) }}">Skaityti</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
{!! Former::close() !!}
@section('scripts')
    <script>
        $('th input').on('ifToggled', function(event){
            if ($(this).prop('checked')) {
                $('td input').iCheck('check');
            } else {
                $('td input').iCheck('uncheck');
            }
        });
    </script>
@endsection