@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container">
        <div class="admin-block pages-edit">
            {!! adminHeaderTitle() !!}

            <div class="admin-body">
                <div class="row">
                    <div class="col-md-8">
                        {!! Former::open()->route('pages.update', $page->id)->method('put') !!}

                            @include('admin.pages.form.elements')

                            <hr>
                            {!! Former::actions()->first_lg_submit('common.update') !!}

                        {!! Former::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.froalaEditor')
@endsection