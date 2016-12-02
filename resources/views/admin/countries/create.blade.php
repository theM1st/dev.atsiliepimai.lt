@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container">
        <div class="admin-block countries-create">
            {!! adminHeaderTitle() !!}

            <div class="admin-body">
                <div class="row">
                    <div class="col-md-6">
                        {!! Former::open()->route('countries.store')->method('post') !!}

                            {!! Former::text('name')->label('common.form.country.name') !!}

                            <hr>
                            {!! Former::actions()->first_lg_submit('common.create') !!}

                        {!! Former::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection