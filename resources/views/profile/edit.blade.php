@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <section class="main-section profile-edit">
        <div class="container">
            <h2>{{ trans("common.profile.sections.$section") }}</h2>
            <div class="row">
                <div class="col-sm-3">
                    @include('profile.partials.navigation')
                </div>
                <div class="col-sm-9">
                    {!! Former::open_for_files()->route('profile.update', $user->id)->method('put') !!}

                        @include("profile.partials.$section")

                        {!! Former::actions()->primary_submit('common.update') !!}

                    {!! Former::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection