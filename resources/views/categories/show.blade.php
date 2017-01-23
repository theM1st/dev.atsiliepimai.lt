@extends('layouts.app')

@section('title', getTitle($title))
@section('description', getDescription($category))

@section('content')
    <section class="main-section category-show">
        <div class="container">
            <h2 class="product-title">
                {{ $title }}
            </h2>
            @if ($category->getLevel() == 0)
                <div class="row">
                    <div class="col-sm-9">
                        <div class="row category-list">
                            @foreach ($category->children as $c)
                                <div class="col-md-3">
                                    <a href="{{ route('category.show', $c->slug) }}" class="category-container">
                                        <span class="category-picture">
                                            <img src="{{ $c->getPicture() }}" class="img-responsive" alt="{{ $c->name }}">
                                        </span>
                                        <span class="category-name">
                                            {{ $c->name }}
                                        </span>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('category.show', $c->slug) }}" class="category-container">
                                        <span class="category-picture">
                                            <img src="{{ $c->getPicture() }}" class="img-responsive" alt="{{ $c->name }}">
                                        </span>
                                        <span class="category-name">
                                            {{ $c->name }}
                                        </span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-3">
                        {!! $recentlyViewedListings !!}
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-sm-3">
                        @include('categories.navigation.side')
                    </div>
                    <div class="col-sm-9 category-listings">
                        @include('listings.partials.list', [ 'listings' => $listings ])
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $('#sort').on('changed.bs.select', function () {
            location.href = '/{{ Request::path() }}?sort=' + $(this).val();
        });
    </script>
@endsection