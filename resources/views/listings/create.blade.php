@extends('layouts.app')

@section('title', getTitle())

@section('content')
    <section class="main-section listing-create">
        <div class="container">
            <h2>Apie ką norite parašyti atsiliepimą?</h2>
            <form action="{{ route('listing.create') }}" class="listing-search-form">
                <label for="search">Produktas, paslauga ar parduotuvės pavadinimas</label>
                <div class="input-group">

                    <input name="q" id="search" placeholder="Ieškokite tarp visų produktų ir paslaugų" class="form-control" type="text" value="{{ $q }}">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-first">Ieškoti</button>
                    </div>
                </div>
            </form>
            <br>
            @if ($q)
                <div class="well">
                    <strong>Nerandate ko ieškote?</strong>
                    <a href="{{ route('listing.global_create') }}?name={{ $q }}" class="btn btn-second">Įdėti produktą/paslaugą ir parašyti atsiliepimą</a>
                </div>
            @endif
            @include('listings.partials.list', [ 'listings' => $listings ])
        </div>
    </section>
@endsection