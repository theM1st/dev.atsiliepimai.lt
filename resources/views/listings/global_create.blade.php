@extends('layouts.app')

@section('title', getTitle('Parašyti atsiliepimą'))

@section('content')
    <section class="main-section listing-create">
        <div class="container">
            <h2>Apie ką norite parašyti atsiliepimą?</h2>

            {!! Former::open()->route('listing.store')->method('post') !!}
            {!!
                Former::inline_radios('listing_type')->label('')
                    ->class('icheck')
                    ->radios([
                        trans('common.product') => ['value' => 'product'],
                        trans('common.service') => ['value' => 'service']
                    ])
            !!}
            {!!
                Former::text('title')->label('common.form.listing.title')
                    ->value($name)
                    ->help('common.form.listing.title_help')
            !!}
            {{ Form::categoriesHierarchy('category_id', $categories, old('category_id', $listing->category_id)) }}

            {!!
                Former::text('brand_value')->label('common.form.listing.brand')
                    ->placeholder('common.form.listing.brand_placeholder')
                    ->help('common.form.listing.brand_help')
            !!}

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
        starRating($(".listing-create #rating"), { size: 'md' });
    </script>
@endsection