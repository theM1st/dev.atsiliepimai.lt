@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container">
        <div class="admin-block listings-create">
            {!! adminHeaderTitle() !!}

            <div class="admin-body">
                <div class="row">
                    <div class="col-md-7">
                        {!! Former::open()->route('listings.store')->method('post') !!}

                            @include('admin.listings.form.elements')

                            {!! Former::actions()->first_lg_submit('common.create') !!}

                        {!! Former::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection