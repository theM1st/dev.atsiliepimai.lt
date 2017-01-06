@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <section class="main-section pages-index">
        <div class="listing-search">
            <div class="container">
                <div class="listing-search-container">
                    <form action="{{ route('listing.search') }}" class="listing-search-form">
                        <div class="listing-search-title">
                            Suraskite geriausius produktus ir paslaugas
                        </div>
                        <div class="input-group">
                            <input name="q" placeholder="Ieškokite tarp visų prekių ir paslaugų" type="text" class="form-control">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-first">
                                    <span class="fa fa-search" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="popular-categories">
            <div class="container">
                <div class="popular-categories-title">Populiarios kategorijos</div>
                <div class="popular-category-list">
                    @foreach ($popularCategories as $c)
                        <div class="col-sm-6 col-md-4 col-lg-3 popular-category">
                            <a href="{{ route('category.show', $c->slug) }}">
                                <span class="popular-category-container">
                                    <span class="popular-category-picture">
                                        <img src="{{ $c->getPicture() }}" class="img-responsive" alt="{{ $c->name }}">
                                    </span>
                                    <span class="popular-category-name">
                                        {{ $c->name }}
                                    </span>
                                </span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="last-reviews">
            <div class="container">
                <div class="last-review-container">
                    <div class="last-reviews-title">Paskutiniai atsiliepimai</div>
                    <div class="last-review-list clearfix">
                        @foreach ($lastReviews as $r)
                            <div class="col-sm-6 col-md-3 last-review">
                                <div class="last-review-info">
                                    <span class="last-review-picture">
                                        <img src="{{ $r->listing->getPicture('xs') }}" class="img-circle" alt="{{ $r->listing->title }}">
                                    </span>
                                    <span class="last-review-name">
                                        {{ str_limit($r->listing->title, 20) }}
                                    </span>
                                    <span class="last-review-description">
                                        {{ str_limit($r->review_description, 100) }}
                                    </span>
                                    <a href="{{ route('listing.show', $r->listing->slug) }}" class="btn btn-first last-review-more">Daugiau</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection