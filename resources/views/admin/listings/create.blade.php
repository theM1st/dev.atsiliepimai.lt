@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container">
        <div class="admin-block listings-create">
            {!! adminHeaderTitle() !!}

            <div class="admin-body">
                <div class="row">
                    <div class="col-md-7">
                        {!! Former::open_for_files()->route('listings.store')->method('post') !!}

                            @include('admin.listings.form.elements')

                            {!!
                                Former::text('rating')
                                    ->label(trans('common.form.review.rating', ['name' => 'produktą/paslaugą']))
                            !!}

                            {!!
                                Former::text('review_title')->label('common.form.review.title')
                                    ->placeholder('common.form.review.title_placeholder')
                                    ->help('common.form.review.title_help')
                            !!}

                            {!!
                                Former::textarea('review_description')
                                    ->rows(4)
                                    ->placeholder('common.form.review.description_placeholder')
                                    ->label('common.form.review.description')
                                    ->help('common.form.review.description_help')
                            !!}

                            <hr>

                            {!! Former::actions()->first_lg_submit('common.create') !!}

                        {!! Former::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link href="{{ asset('css/star-rating/star-rating.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('js/star-rating.js') }}"></script>

    <script>
        listingTypeToggle();
        starRating($(".listings-create #rating"), { size: 'md' });
    </script>
@endsection