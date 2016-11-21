@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container users-create">
        {!! adminHeaderTitle() !!}

        <div class="row">
            <div class="col-md-6">
                {!! Former::open()->route('users.store')->method('post') !!}

                    {!! Former::email('email')->label('common.user.email') !!}
                    {!! Former::text('username')->label('common.user.username') !!}
                    {!! Former::password('password')->label('common.user.password') !!}
                    {!! Former::password('password_confirmation')->label('common.user.repeat_password') !!}

                    {!! Former::actions()->primary_submit('common.create') !!}

                {!! Former::close() !!}
            </div>
        </div>
    </div>
@endsection