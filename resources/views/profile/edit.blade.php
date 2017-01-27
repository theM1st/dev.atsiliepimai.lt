@extends('layouts.app')

@section('title', getTitle($title))
@section('breadcrumbs', $breadcrumbs->render())

@section('content')
    <section class="main-section profile-edit">
        <div class="container">
            <h2>{{ $title }}</h2>
            <div class="row">
                <div class="col-sm-3 col-md-2">
                    @include('profile.partials.navigation')
                </div>
                <div class="col-sm-8 col-md-9">
                    {!! Former::open_for_files()->route('profile.update', $user->id)->method('put') !!}

                        @include("profile.partials.$section")

                        <hr>

                        <div class="form-group">
                            <div class="col-sm-12">
                            {!! Form::submit(trans('common.profile.form.update'), ['class' => 'btn btn-first btn-lg']) !!}
                            </div>
                        </div>
                    {!! Former::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection