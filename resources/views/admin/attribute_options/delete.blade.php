@extends('modal')

@section('content')
    {!! Former::open()->route('attribute_options.destroy', ['id'=>$option->id])->secure()->method('delete') !!}
        <div class="text-center">
            {!! Former::sm_third_empty_button('common.cancel')->data_dismiss('modal')->style('margin-right:20px') !!}
            {!! Former::sm_red_empty_submit('common.delete') !!}
        </div>
    {!! Former::close() !!}
@endsection
