@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <section class="main-section pages-index">
        <div class="container">
            <div class="popular-categories">
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
    </section>
@endsection