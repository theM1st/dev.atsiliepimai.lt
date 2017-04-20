@extends('layouts.app')

@section('title')
    {{ getTitle($title)}}
@endsection
@section('description', getDescription($category))
@section('breadcrumbs')
{!! $breadcrumbs->render() !!}
@endsection

@section('content')
<section class="main-section category-show">
    <div class="container">
        <h2 class="product-title">
            {{ $category->title }}
        </h2>
        @if ($category->getLevel() == 0 && !$brand->id)
            <div class="row">
                <div class="col-sm-9">
                    <div class="row category-list">
                        @foreach ($topCategories as $item)
                            <div class="col-md-3 col-xs-6">
                                <a href="{{ route('category.show', $item['category']->slug) }}" class="category-container">
                                    <span class="category-picture">
                                        <img src="{{ $item['category']->getPicture() }}" class="img-responsive" alt="{{ $item['category']->name }}">
                                    </span>
                                    <span class="category-name">
                                        {{ $item['category']->name }}
                                    </span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    @if ($childrenCategories)
                        <?php
                            $i = 1;
                            $itemsInCols = intval(ceil(count($childrenCategories) / 4));
                        ?>
                        <div class="all-category-list">
                            <h3>Visos kategorijos</h3>
                            <div class="row">
                                @foreach ($childrenCategories as $c)
                                    @if ($i == 1 || (($i-1) % $itemsInCols == 0))
                                        <div class="col-md-3 category-container">
                                    @endif
                                        <a href="{{ route('category.show', $c->slug) }}">
                                            {{ $c->name }}
                                        </a>
                                    @if ($i == count($childrenCategories) || ($i % $itemsInCols == 0))
                                        </div>
                                    @endif
                                    <?php $i++ ?>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if ($listingsWithBrand->count())
                        <div class="brand-list">
                            <h3>Kategorijos <span>{{ $category->name }}</span> gamitojai</h3>
                            <div class="row">
                                @foreach ($listingsWithBrand as $item)
                                    <div class="col-md-3">
                                        <a href="{{ route('category.show.brand', [$category->slug, $item->brand->slug]) }}" class="brand-container" title="Gamintojas {{ $item->brand->name }}">
                                            <span class="brand-picture">
                                                <img src="{{ $item->brand->getPicture() }}" class="img-responsive" alt="{{ $item->brand->name }}">
                                            </span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
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