@extends('layouts.app')

@section('title', getTitle($listing, 'title'))

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
                    {!! $recentlyViewedListings !!}
                </div>
            </div>
        </div>
    </section>
@endsection