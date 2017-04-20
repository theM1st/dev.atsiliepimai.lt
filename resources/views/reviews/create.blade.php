@extends('layouts.app')

@section('title', getTitle('Parašyti atsiliepimą apie ' . $listing->title))

@section('content')
    <section class="main-section review-create">
        <div class="container">
            <h2>Parašyti atsiliepimą</h2>

            <div class="row">
                <div class="col-sm-8">
                    <div class="listing-picture img-circle img-circle-md img-border-grey">
                        <img src="{{ $listing->getPicture() }}" alt="" class="img-responsive">
                    </div>
                    <div class="listing-title">
                        {{ $listing->title }}
                    </div>
                </div>
                <div class="col-sm-4">
                    <a href="{{ route('listing.create') }}" class="listing-search">Parašyti apie kažką kitą</a>
                </div>
            </div>
            <hr>
            {!! Former::open()->route('review.store', $listing->slug)->method('post')->id('review-form') !!}
                @include('reviews.form.elements')

                <hr>
                {!! Former::actions()->first_lg_submit('Siųsti atsiliepimą') !!}
            {!! Former::close() !!}
        </div>
    </section>
@endsection

@section('styles')
    <link href="{{ asset('css/star-rating/star-rating.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('js/star-rating.js') }}"></script>

    <script>
        starRating($(".review-create #rating"), { size: 'md' });
    </script>
@endsection