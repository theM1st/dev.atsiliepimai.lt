@extends('layouts.app')

@section('title', getTitle('Paieška'))

@section('content')
    <section class="main-section listing-search">
        <div class="container">
            <h2>Paieškos rezultatai pagal žodį <span>"{{ $q }}"</span></h2>
            @include('listings.partials.list', [ 'listings' => $listings ])
        </div>
    </section>
@endsection