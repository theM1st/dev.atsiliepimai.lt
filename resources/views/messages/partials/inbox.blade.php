<div class="messages-help-note">
    <a href="{{ route('messages.delete') }}" onclick="return actionModal(this)" data-method="get" data-size="modal-sm" class="btn btn-second btn-sm">Trinti pažymėtas</a>
    <div class="message-closed">Žinutė neperskaityta <span class="fa fa-envelope-o" aria-hidden="true"></span></div>
    <div class="message-opened">Žinutė perskaityta <span class="fa fa-envelope-open-o" aria-hidden="true"></span></div>
</div>
{!! Former::open()->route('messages.destroy')->secure()->method('delete')->id('messages-destroy') !!}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">
                    <input type="checkbox" class="icheck">
                </th>
                <th></th>
                <th>Data</th>
                <th>Siuntėjo vardas</th>
                <th>Žinutė</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->messagesIn as $m)
                <tr>
                    <td class="text-center">
                        <input type="checkbox" class="icheck" name="delete[]" value="{{ $m->id }}">
                    </td>
                    <td class="text-center">
                        @if ($m->new)
                            <span class="fa fa-envelope-o" aria-hidden="true"></span>
                        @else
                            <span class="fa fa-envelope-open-o" aria-hidden="true"></span>
                        @endif
                    </td>
                    <td>{{ $m->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $m->sender->username }}</td>
                    <td>{{ $m->title }}</td>
                    <td class="text-center">
                        <a href="{{ route('messages.show', [$section, $m->id]) }}">Rodyti</a>
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