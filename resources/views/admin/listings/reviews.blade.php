@extends('layouts.app')

@section('title', getTitle($title))

@section('content')

<div class="container">
    <div class="admin-block listings-reviews">
        {!! adminHeaderTitle($title) !!}

        <div class="admin-body">
            @include("listings.review.listing", [ 'admin' => true ])
            <div class="row">
                <div class="col-md-9">
                    @include("listings.review.list", [ 'admin' => true ])

                    @include("listings.review.description", [ 'admin' => true ])

                    @include("listings.question.list", [ 'admin' => true ])
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
    <link href="{{ asset('css/star-rating/star-rating.css') }}" rel="stylesheet">
@endsection