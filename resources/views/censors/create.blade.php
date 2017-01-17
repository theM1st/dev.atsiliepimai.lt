@extends('layouts.app')

@section('title', getTitle('Netinkamas atsiliepimas? Pranešk'))

@section('content')
    <section class="main-section review-create">
        <div class="container">
            <h2>
                Netinkamas
                @if ($commentableType == 'question')
                    klausimas
                @elseif ($commentableType == 'answer')
                    atsakymas
                @else
                    atsiliepimas
                @endif
                ?
                Pranešk
            </h2>

            {!! Former::open()->route('censor.store')->method('post') !!}
                {!!
                    Former::textarea('content')
                        ->label(trans('common.form.censor.content'))
                !!}
                {{ Form::hidden('listing_id', $listing->id) }}
                {{ Form::hidden('commentable_type', $commentableType) }}
                {{ Form::hidden('commentable_id', $commentableId) }}
                <hr>
                {!! Former::actions()->first_lg_submit('Pranešti') !!}
            {!! Former::close() !!}
        </div>
    </section>
@endsection
