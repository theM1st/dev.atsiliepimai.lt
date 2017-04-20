@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container">
        <div class="admin-block review-edit">
            {!! adminHeaderTitle() !!}

            <div class="admin-body">
                <div class="row">
                    <div class="col-md-8">
                        {!! Former::open()->route('reviews.update', $review->id)->method('put')->id('review-form') !!}

                            {!!
                                Former::text('rating')
                                    ->label(trans('common.form.review.rating', ['name' => 'produktą/paslaugą']))
                            !!}

                            {!!
                                Former::text('review_title')->label('common.form.review.title')
                                    ->placeholder('common.form.review.title_placeholder')
                                    ->help('common.form.review.title_help')
                            !!}

                            @if ($attribute = $review->listing->getMainAttribute())
                                @include('admin.reviews.form.attribute_option', ['attribute' => $attribute])
                            @endif

                            {!!
                                Former::textarea('review_description')
                                    ->rows(4)
                                    ->placeholder('common.form.review.description_placeholder')
                                    ->label('common.form.review.description')
                                    ->help('common.form.review.description_help')
                            !!}

                            @if ($attributes = $review->secondaryAttributes)
                                @foreach ($attributes as $attribute)
                                    @include('admin.reviews.form.attribute_option', ['attribute' => $attribute])
                                @endforeach
                            @endif

                            <div class="checkbox-container">
                                {!! Former::checkbox('active')->class('icheck')->text('common.form.review.active') !!}
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    {!! Former::actions()->first_lg_submit('common.update') !!}
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ route('reviews.move', $review->id) }}" class="btn-link btn-lg btn">
                                        {{ trans('admin.reviews.move') }}
                                    </a>
                                </div>
                            </div>


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
        starRating($(".review-edit #rating"), { size: 'md' });


    </script>
@endsection