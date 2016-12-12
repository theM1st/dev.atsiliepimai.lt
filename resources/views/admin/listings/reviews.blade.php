@extends('layouts.app')

@section('title', getTitle($title))

@section('content')

<div class="listing-reviews">
    <div class="container">
        <div class="admin-block listings-index">
            {!! adminHeaderTitle($title) !!}

            <div class="admin-body">
                <div class="row">
                    <div class="col-sm-9">
                        @include("listings.review.list", [ 'admin' => true ])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
    <link href="{{ asset('css/star-rating/star-rating.css') }}" rel="stylesheet">
@endsection