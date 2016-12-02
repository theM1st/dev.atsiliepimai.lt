@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container">
        <div class="admin-block countries-edit">
            {!! adminHeaderTitle() !!}

            <div class="admin-body">
                <div class="row">
                    <div class="col-md-6">
                        {!! Former::open()->route('countries.update', $country->id)->method('put') !!}

                            {!! Former::text('name')->label('common.country.name') !!}

                            <hr>
                            {!! Former::actions()->first_lg_submit('common.update') !!}

                        {!! Former::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection