@extends('layouts.app')

@section('title', getTitle($category))

@section('content')
    <section class="main-section category-show">
        <div class="container">
            <h2 class="product-title">{{ $category->name }}</h2>
            <div class="row">
                <div class="col-sm-3">
                    @include('categories.navigation.side')
                </div>
                <div class="col-sm-9 category-listings">
                    @include('listings.partials.list', [ 'listings' => $listings ])
                </div>
            </div>
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