@extends('layouts.app')

@section('title', getTitle($title))
@section('breadcrumbs', $breadcrumbs->render())

@section('content')
    <section class="main-section profile-show">
        <div class="container">
            <h2>{{ $title }}</h2>
            <div class="row">
                <div class="col-sm-3 col-md-2">
                    @include('profile.partials.navigation')
                </div>
                @include('profile.partials.'.$section)
            </div>
        </div>
    </section>
@endsection