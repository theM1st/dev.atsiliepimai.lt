@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container categories-create">
        {!! adminHeaderTitle() !!}

        <div class="row">
            <div class="col-md-6">
                {!! Former::open()->route('categories.store')->method('post') !!}

                    {!! Former::text('name')->label('common.category.name') !!}
                    {!! Former::select('parent_id')->options(collect($categories)->prepend('', ''))->label('common.category.parent') !!}

                    {!! Former::actions()->primary_submit('common.create') !!}

                {!! Former::close() !!}
            </div>
        </div>
    </div>
@endsection