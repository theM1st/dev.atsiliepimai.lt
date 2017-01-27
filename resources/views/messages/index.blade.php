@extends('layouts.app')

@section('title', getTitle($title))
@section('breadcrumbs', $breadcrumbs->render())

@section('content')
    <section class="main-section messages-index">
        <div class="container">
            <h2>{{ $title }}</h2>
            <div class="row">
                <div class="col-sm-3 col-md-2">
                    @include('profile.partials.navigation')
                </div>
                <div class="col-sm-9 col-md-10">
                    @include('messages.partials.'.$section)
                </div>
            </div>
        </div>
    </section>
@endsection