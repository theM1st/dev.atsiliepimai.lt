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
                <div class="col-sm-offset-1 col-sm-8">
                    {!! Former::open_for_files()->route('profile.update', $user->id)->method('put') !!}

                        @include("profile.partials.$section")

                        <hr>

                        <div class="form-group">
                            <div class="col-sm-12">
                            {!! Form::submit(trans('common.profile.update.button'), ['class' => 'btn btn-first btn-lg']) !!}
                            </div>
                        </div>
                    {!! Former::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection