@extends('layouts.app')

@section('title', getTitle($listing->title . ' ' . ($model ? $model->option_name : '')))
@section('description', getDescription($listing->lastReview()->review_description))

@section('content')
    <section class="main-section listing-show">
        <div class="container">
            @include("listings.review.listing")

            <div class="row">
                <div class="col-md-9">
                    @include("listings.review.list")
                    @include("listings.review.description")
                    @include("listings.question.list")
                </div>
                <div class="col-sm-3">
                    @if ($similarListings)
                        <div class="recently-viewed-listings">
                            <h5>
                                <span>Panašūs produktai</span>
                            </h5>
                            @foreach ($similarListings as $l)
                                <div class="listing">
                                    <a href="{{ route('listing.show', $l->slug) }}">
                                        <span class="listing-picture">
                                            <img src="{{ $l->getPicture('xs') }}" alt="" class="img-responsive img-circle img-border-grey">
                                        </span>
                                        <span class="listing-container">
                                            <p class="listing-title">{{ str_limit($l->title, 25) }}</p>
                                            <span class="listing-rating">
                                                {!! starRating($l->avg_rating, 'xs') !!}
                                                <span class="listing-review-count">
                                                    ({{ count($l->reviews) . ' ' . transPlural('common.reviews_plural', count($l->reviews)) }})
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {!! $recentlyViewedListings !!}
                </div>
            </div>
        </div>
    </section>
@endsection