@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container categories-create">
        {!! adminHeaderTitle() !!}

        <div class="row">
            <div class="col-md-6">
                {!! Former::open()->route('countries.store')->method('post') !!}

                    {!! Former::text('name')->label('common.country.name') !!}

                    {!! Former::actions()->primary_submit('common.create') !!}

                {!! Former::close() !!}
            </div>
        </div>
    </div>
@endsection