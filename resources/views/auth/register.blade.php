@extends('layouts.app')

@section('title', getTitle(trans('common.sign_up')))

@section('content')
    <section class="main-section auth-register">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-6">
                    <div class="auth-form">
                        <h2>{{ trans('common.sign_up') }}</h2>
                        {!! Former::open()->action(url('/register'))->method('post') !!}
                            {!! Former::email('email')->label('common.user.email') !!}
                            {!! Former::text('username')->label('common.user.username') !!}
                            {!! Former::password('password')->label('common.user.password') !!}
                            {!! Former::password('password_confirmation')->label('common.user.repeat_password') !!}

                            <div class="checkbox-container">
                                {!! Former::checkbox('page_rules')->class('icheck')->text('- Su puslapio taisyklėmis susipažinau ir sutinku') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::button(trans('common.form.sign_up') . '<span class="fa fa-chevron-right"></span>',
                                    array('type' => 'submit', 'class' => 'btn btn-first btn-lg')) }}
                            </div>
                        {!! Former::close() !!}
                    </div>
                    <hr>
                    @include("auth.socials")
                </div>
                <div class="col-md-7 hidden-sm hidden-xs">
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
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
