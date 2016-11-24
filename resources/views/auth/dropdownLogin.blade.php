<form action="{{ url('/login') }}" method="POST" class="user-login-form">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="email" class="sr-only">{{ trans('common.user.email') }}</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="{{ trans('common.user.email') }}">
    </div>
    <div class="form-group">
        <label for="password" class="sr-only">{{ trans('common.user.password') }}</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="{{ trans('common.user.password') }}">
    </div>
    <div class="form-group">
        <a href="{{ url('/password/reset') }}" class="password-reset">{{ trans('common.forgot_password') }}?</a>
    </div>
    <div class="form-group login-button">
        <button class="btn btn-first btn-lg">{{ trans('common.form.sign_in') }}</button>
    </div>
    <div class="form-group">
        Neturi anketos?
        <a href="{{ url('/register') }}">Užsiregistruokite</a>
    </div>
</form>