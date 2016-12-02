@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container">
        <div class="admin-block users-index">
            {!! adminHeaderTitle() !!}

            <div class="admin-body">
                <table class="table table-striped data-table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>{{ trans('common.user.registration') }}</th>
                        <th>{{ trans('common.user.username') }}</th>
                        <th>{{ trans('common.user.email') }}</th>
                        <th>{{ trans('common.user.first_name') }}</th>
                        <th>{{ trans('common.user.last_name') }}</th>
                        <th>{{ trans('common.user.birthday') }}</th>
                        <th class="actions"></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <script>
        var dataSet = [];
        @foreach($users as $u)
                dataSet.push([
                    '{{ $u->created_at->format('Y-m-d H:i') }}',
                    '{{ $u->username }}',
                    '{{ $u->email }}',
                    '{{ $u->first_name }}',
                    '{{ $u->last_name }}',
                    '{{ $u->birthday ? $u->birthday->format('Y-m-d') : null }}',
                    '{!! Form::tools([
                            'edit' => route('users.edit', [$u->id, 'About']),
                            'delete' => route('users.delete', $u->id)
                        ])
                    !!}'
                ]);
        @endforeach

        var dataTableOptions = { data: dataSet, order: [0, 'desc'] }
    </script>
@endsection

@include('admin.dataTables')

@section('scripts')
<script>
    console.log('users.index')
</script>
@endsection

