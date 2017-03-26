@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container">
        <div class="admin-block listings-index">
            {!! adminHeaderTitle() !!}

            <div class="admin-body">
                <table class="table table-striped data-table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th nowrap>{{ trans('common.created_date') }}</th>
                        <th>{{ trans('common.product_service') }}</th>
                        <th>{{ trans('common.form.category.parent') }}</th>
                        <th>{{ trans('common.last_review') }}</th>
                        <th>{{ trans('common.rating') }}</th>
                        <th>Atsiliepimų</th>
                        <th></th>
                        <th class="actions"></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <script>
        var dataSet = [];
        @foreach($listings as $l)
            dataSet.push([
                '{{ $l->created_at->format('Y-m-d H:i') }}',
                '{{ $l->title }}',
                '{{ $l->category->name }}',
                '{{ ($l->lastReview() ? $l->lastReview()->review_title : null) }}',
                {
                    display: '{!! starRating($l->avg_rating) !!}',
                    value: '{{ $l->avg_rating }}'
                },
                '{{ count($l->reviews) }}',
                {
                    display: '{!! ($l->active ? '<i class="fa fa-circle text-green"></i>' : '<i class="fa fa-circle text-red"></i>') !!}',
                    value: '{{ $l->active }}'
                },
                '{!!
                    Form::tools([
                        'edit' => route('listings.edit', [$l->id]),
                        'reviews' => route('listings.reviews', [$l->id]),
                        'delete' => route('listings.delete', $l->id)
                    ])
                !!}'
            ]);
        @endforeach

        var dataTableOptions = {
            data: dataSet,
            order: [0, 'desc'],
            cellObject: [4, 6]
        };
    </script>
@endsection

@include('admin.dataTables')

@section('styles')
    <link href="{{ asset('css/star-rating/star-rating.css') }}" rel="stylesheet">
@endsection

