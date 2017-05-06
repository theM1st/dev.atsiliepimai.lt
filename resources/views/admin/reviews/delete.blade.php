@extends('modal')

@section('content')
    {!! Former::open()->route('reviews.destroy', ['id' => $review->id])->secure()->method('delete') !!}
    {!!
        Former::textarea('admin_note')
            ->label('')
            ->rows(1)
            ->placeholder('Parašykite komentarą vartotojui, kad atsiliepimas netinkamas ir reikia pataisyti.')
    !!}
    <div>
        <p>Arba pažymėkite varnele, kad pilnai ištrinti atsiliepimą iš sistemos.</p>
        <div class="checkbox checkbox-container">
            {!! Former::checkbox('permanently_delete')
            ->text('pilnai ištrinti') !!}
        </div>
    </div>
    <div class="text-center">
        {!! Former::sm_third_empty_button('common.cancel')->data_dismiss('modal')->style('margin-right:20px') !!}
        {!! Former::sm_red_empty_submit('common.delete') !!}
    </div>
    {!! Former::close() !!}
@endsection