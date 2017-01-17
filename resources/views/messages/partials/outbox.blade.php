<div class="messages-help-note">
    <a href="{{ route('messages.delete') }}" onclick="return actionModal(this)" data-method="get" data-size="modal-sm" class="btn btn-second btn-sm">Trinti pažymėtas</a>
</div>
{!! Former::open()->route('messages.destroy')->secure()->method('delete')->id('messages-destroy') !!}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">
                    <input type="checkbox" class="icheck">
                </th>
                <th>Data</th>
                <th>Gavėjo vardas</th>
                <th>Žinutė</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->messagesOut as $m)
                <tr>
                    <td class="text-center">
                        <input type="checkbox" class="icheck" name="delete[]" value="{{ $m->id }}">
                    </td>
                    <td>{{ $m->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $m->recipient->username }}</td>
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