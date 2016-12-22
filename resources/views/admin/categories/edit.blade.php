@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container">
        <div class="admin-block categories-edit">
            {!! adminHeaderTitle() !!}

            <div class="admin-body">
                <div class="row">
                    <div class="col-md-7">
                        {!! Former::open_for_files()->route('categories.update', $category->id)->method('put') !!}
                            <div class="form-group">
                                <img src="{{ $category->getPicture() }}" alt="{{ $category->name }}" class="img-responsive">
                            </div>
                            @include('admin.categories.form.elements')

                            {!! Former::actions()->first_lg_submit('common.update') !!}

                        {!! Former::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection