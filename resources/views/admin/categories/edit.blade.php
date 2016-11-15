@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container categories-edit">
        {!! adminHeaderTitle() !!}

        <div class="row">
            <div class="col-md-6">
                {!! Former::open()->route('categories.update', $category->id)->method('put') !!}

                    {!! Former::text('name')->label('common.category.name') !!}
                    {!! Former::select('parent_id')->options(collect($categories)->prepend('', ''))->label('common.category.parent') !!}

                    {!! Former::actions()->primary_submit('common.edit') !!}

                {!! Former::close() !!}
            </div>
        </div>
    </div>
@endsection