@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container">
        <div class="admin-block listings-create">
            {!! adminHeaderTitle() !!}

            <div class="admin-body">
                {!! Former::open()->route('questions.update', [$question->id])->method('put') !!}
                {!!
                    Former::textarea('title')->label('Klausimas')
                !!}
                @if ($attribute = $question->listing->getMainAttribute())
                    {!!
                        Former::select('attribute_option_id')
                        ->options(
                            $attribute->options->pluck('option_name', 'id')
                        )
                        ->class('form-control selectpicker')
                        ->title(trans('common.form.select'))
                        ->label($attribute->title)
                    !!}
                @endif
                <hr>
                {!! Former::actions()->first_lg_submit('common.update') !!}
                {!! Former::close() !!}
            </div>
        </div>
    </div>
@endsection