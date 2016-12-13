@extends('modal')

@section('content')
    {!! Former::open()->route('listings.destroy', ['id' => $listing->id])->secure()->method('delete') !!}
    <div class="text-center">
        <div class="alert alert-danger" style="font-size:14px">
            Visi produkto/paslaugos atsiliepimai, klausimai ir atsakymai bus ištrinti!
        </div>
        {!! Former::sm_third_empty_button('common.cancel')->data_dismiss('modal')->style('margin-right:20px') !!}
        {!! Former::sm_red_empty_submit('common.delete') !!}

    </div>
    {!! Former::close() !!}
@endsection