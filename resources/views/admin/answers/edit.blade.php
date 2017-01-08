@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container">
        <div class="admin-block listings-create">
            {!! adminHeaderTitle() !!}

            <div class="admin-body">
                {!! Former::open()->route('answers.update', [$answer->id, '#listing-questions'])->method('put') !!}
                {!!
                    Former::textarea('title')->label('Atsakymas')
                !!}
                <hr>
                {!! Former::actions()->first_lg_submit('common.update') !!}
                {!! Former::close() !!}
            </div>
        </div>
    </div>
@endsection