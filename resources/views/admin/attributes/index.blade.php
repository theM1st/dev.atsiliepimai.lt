@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container">
        <div class="admin-block attributes-index">
            {!! adminHeaderTitle() !!}

            <div class="admin-body">
                <table class="table table-striped data-table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>{{ trans('common.form.attribute.name') }}</th>
                        <th>{{ trans('common.form.attribute.title') }}</th>
                        <th>{{ trans('common.form.attribute.main') }}</th>
                        <th class="actions"></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <script>
        var dataSet = [];
        @foreach($attributes as $a)
            dataSet.push([
                '{{ $a->name }}',
                '{{ $a->title }}',
                {
                    display: '{!! ($a->main ? 'Pagrindinis' : '') !!}',
                    value: '{{ $a->main }}'
                },
                '{!!
                    Form::tools([
                        'edit' => route('attributes.edit', [$a->id]),
                        'delete' => route('attributes.delete', $a->id)
                    ])
                !!}'
            ]);
        @endforeach

        var dataTableOptions = {
            data: dataSet,
            order: [0, 'desc'],
            cellObject: [2]
        };
    </script>
@endsection

@include('admin.dataTables')

@section('styles')
    <link href="{{ asset('css/star-rating/star-rating.css') }}" rel="stylesheet">
@endsection

