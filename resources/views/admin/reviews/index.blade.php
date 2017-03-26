@extends('layouts.app')

@section('title', getTitle('Neaktyvuoti atsiliepimai'))

@section('content')
    <div class="container">
        <div class="admin-block listings-index">
            {!! adminHeaderTitle('Neaktyvuoti atsiliepimai') !!}

            <div class="admin-body">
                <table class="table table-striped data-table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th nowrap>{{ trans('common.created_date') }}</th>
                        <th>{{ trans('common.product_service') }}</th>
                        <th>{{ trans('common.review') }}</th>
                        <th>{{ trans('common.form.category.parent') }}</th>
                        <th>{{ trans('common.rating') }}</th>
                        <th>Parašė</th>
                        <th class="actions"></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <script>
        var dataSet = [];
        @foreach($reviews as $r)
            dataSet.push([
                '{{ $r->created_at->format('Y-m-d H:i') }}',
                '{{ $r->listing->title }}',
                '{{ $r->review_title }}',
                '{{ $r->listing->category->name }}',
                {
                    display: '{!! starRating($r->rating) !!}',
                    value: '{{ $r->rating }}'
                },
                '{{ $r->user->username }}',
                '{!!
                    Form::tools([
                        'edit' => route('reviews.edit', [$r->id]),
                        'delete' => route('reviews.delete', $r->id)
                    ])
                !!}'
            ]);
        @endforeach

        var dataTableOptions = {
            data: dataSet,
            order: [0, 'desc'],
            cellObject: [4]
        };
    </script>
@endsection

@include('admin.dataTables')

@section('styles')
    <link href="{{ asset('css/star-rating/star-rating.css') }}" rel="stylesheet">
@endsection

