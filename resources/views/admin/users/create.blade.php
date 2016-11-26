@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="admin-container">
        <div class="container">
            <div class="admin-block users-create">
                {!! adminHeaderTitle() !!}

                <div class="row">
                    <div class="col-md-6">
                        {!! Former::open()->route('users.store')->method('post') !!}

                            {!! Former::email('email')->label('common.user.email') !!}
                            {!! Former::text('username')->label('common.user.username') !!}
                            {!! Former::password('password')->label('common.user.password') !!}
                            {!! Former::password('password_confirmation')->label('common.user.repeat_password') !!}

                            <hr>

                            {!! Former::actions()->first_lg_submit('common.create') !!}

                        {!! Former::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection