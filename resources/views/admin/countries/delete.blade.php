@extends('modal')

@section('content')
    {!! Former::open()->route('countries.destroy', ['id'=>$country->id])->secure()->method('delete') !!}
    <div class="text-center">
        {!! Former::sm_first_empty_submit('common.delete')->style('margin-right:20px') !!}
        {!! Former::sm_third_empty_button('common.cancel')->data_dismiss('modal') !!}
    </div>
    {!! Former::close() !!}
@endsection