@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <section class="main-section profile-show">
        <div class="container">
            <h2>{{ $title }}</h2>
            <div class="row">
                <div class="col-sm-3">
                    @include('profile.partials.navigation')
                </div>
                <div class="col-sm-5">
                    <dl class="dl-horizontal">
                        <dt>{{ trans('common.user.name') }}:</dt>
                        <dd>
                            @if ($user->name)
                                {{ $user->name }}
                            @else
                                <a href="{{ route('profile.edit', 'About') }}">Pasakykite mums savo vardą!</a>
                            @endif
                        </dd>

                        <dt>{{ trans('common.user.birthday') }}:</dt>
                        <dd>
                            @if ($user->birthday)
                                {{ $user->birthday->format('Y-m-d') }}
                            @else
                                <a href="{{ route('profile.edit', 'About') }}">Pasakykite mums savo gimimo datą!</a>
                            @endif
                        </dd>

                        <dt>{{ trans('common.user.gender') }}:</dt>
                        <dd>
                            @if ($user->gender)
                                {{ $user->gender }}
                            @else
                                <a href="{{ route('profile.edit', 'About') }}">Nurodykite savo lytį</a>
                            @endif
                        </dd>

                        <dt>{{ trans('common.user.place') }}:</dt>
                        <dd>
                            @if ($user->place)
                                {{ $user->place }}
                            @else
                                <a href="{{ route('profile.edit', 'Address') }}">Redaguoti vietą</a>
                            @endif
                        </dd>
                    </dl>
                    <a href="{{ route('profile.edit', 'About') }}" class="btn btn-lg btn-second">{{ trans('common.profile.form.edit') }}</a>
                </div>
                <div class="col-sm-4">
                    <div class="widget-activity">
                        <h5>
                            <span>Naujausia veikla</span>
                        </h5>
                        <dl class="dl-horizontal">
                            <dt>Reviews:</dt>
                            <dd>0</dd>
                            <dt>Comments:</dt>
                            <dd>0</dd>
                            <dt>Questions:</dt>
                            <dd>0</dd>
                            <dt>Answers:</dt>
                            <dd>0</dd>
                        </dl>
                    </div>
                    <div class="widget-recently-viewed-reviews">
                        <h5>
                            <span>Neseniai žiūrėti</span>
                        </h5>
                        <button class="btn btn-third btn-sm" type="button">Valyti visus įrašus</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection