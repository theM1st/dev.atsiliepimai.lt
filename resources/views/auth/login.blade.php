@extends('layouts.app')

@section('title', getTitle(trans('common.sign_in')))

@section('content')
    <section class="main-section auth-login">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="auth-form">
                        <h2>{{ trans('common.sign_in') }}</h2>
                        {!! Former::open()->action(url('/login'))->method('post') !!}
                            {!! Former::email('email')->label('common.user.email') !!}
                            {!! Former::password('password')->label('common.user.password') !!}

                            <div class="checkbox-container">
                                {!! Former::checkbox('remember')->text('common.user.remember_me') !!}
                            </div>

                            <div class="form-group">
                                {{ Form::button(trans('common.form.sign_in') . '<span class="fa fa-chevron-right"></span>',
                                    array('type' => 'submit', 'class' => 'btn btn-first btn-lg')) }}
                            </div>
                            <div class="form-group">
                                <a href="{{ url('/password/reset') }}" class="forgot-password">{{ trans('common.forgot_password') }}</a>
                            </div>
                        {!! Former::close() !!}
                    </div>
                    <hr>
                    @include("auth.socials")
                </div>
                <div class="col-md-8 hidden-sm hidden-xs">
                    <img src="{{ asset('assets/images/motorbike.png') }}" class="img-responsive">
                </div>
            </div>
        </div>
        <div class="motorbike visible-sm"><img src="{{ asset('assets/images/motorbike.png') }}" class="img-responsive"></div>
    </section>
    {{--
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
