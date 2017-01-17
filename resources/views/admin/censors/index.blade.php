@extends('layouts.app')

@section('title', getTitle(trans('admin.censors.index')))

@section('content')
    <div class="container">
        <div class="admin-block listings-index">
            {!! adminHeaderTitle(trans('admin.censors.index')) !!}

            <div class="admin-body">
                <table class="table table-striped data-table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th nowrap>{{ trans('common.date') }}</th>
                        <th>{{ trans('common.product_service') }}</th>
                        <th>{{ trans('common.form.censor.content') }}</th>
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
        @foreach($censors as $c)
            dataSet.push([
                '{{ $c->created_at->format('Y-m-d H:i') }}',
                '{{ $c->listing->title }}',
                '{{ $c->content }}',
                '{{ $c->user->username }}',
                '{!!
                    Form::tools([
                        'show_censor_commentable' => route('listings.reviews', [$c->listing->id, '#'.(strpos($c->commentable_type, 'Review') ? 'review' : (strpos($c->commentable_type, 'Question') ? 'question' : 'answer') ).$c->commentable_id]),
                        'delete' => route('censors.delete', $c->id),
                    ])
                !!}'
            ]);
        @endforeach

        var dataTableOptions = {
            data: dataSet,
            order: [0, 'desc'],
        };
    </script>
@endsection

@include('admin.dataTables')

