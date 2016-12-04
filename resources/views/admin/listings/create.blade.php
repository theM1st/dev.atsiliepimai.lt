@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container">
        <div class="admin-block listings-create">
            {!! adminHeaderTitle() !!}

            <div class="admin-body">
                <div class="row">
                    <div class="col-md-7">
                        {!! Former::open()->route('listings.store')->method('post') !!}

                            @include('admin.listings.form.elements')

                            {{ Form::hidden('user_id', Auth::user()->id) }}
                            {!! Former::actions()->first_lg_submit('common.create') !!}

                        {!! Former::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link href="{{ asset('css/star-rating/star-rating.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('js/star-rating.js') }}"></script>

    <script>
        starRating($(".listings-create #rating"));
    </script>
@endsection