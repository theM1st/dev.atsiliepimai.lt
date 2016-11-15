@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container categories-create">
        {!! adminHeaderTitle() !!}

        <div class="row">
            <div class="col-md-6">
                {!! Former::open()->route('countries.update', $country->id)->method('put') !!}

                    {!! Former::text('name')->label('common.country.name') !!}

                    {!! Former::actions()->primary_submit('common.edit') !!}

                {!! Former::close() !!}
            </div>
        </div>
    </div>
@endsection