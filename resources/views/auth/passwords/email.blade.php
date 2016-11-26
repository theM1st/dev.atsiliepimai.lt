@extends('layouts.app')

@section('title', getTitle(trans('common.forgot_password')))

<!-- Main Content -->
@section('content')
    <section class="main-section auth-reset">
        <div class="container">
            <h2>{{ trans('common.forgot_password') }}</h2>

            <div class="row">
                <div class="col-sm-offset-2 col-sm-8">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="alert alert-info">
                        Nurodykite savo prisijungimo el paštas ir mes atsiųsime instrukcijos, kaip atstatyti slaptažodį.
                    </div>

                    {!! Former::open()->action(url('/password/email'))->method('post') !!}
                        {!! Former::email('email')->label('common.your_email') !!}

                        {!! Former::actions()->first_lg_submit('common.form.reset_password') !!}
                    {!! Former::close() !!}
                </div>
            </div>
        </div>
    </section>
    {{--
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

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

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
--}}
@endsection
