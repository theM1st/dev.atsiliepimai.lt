@extends('modal')

@section('content')
    {!! Former::open()->route('users.destroy', ['id'=>$user->id])->secure()->method('delete') !!}
        <div class="text-center">
            {!! Former::sm_primary_submit('common.delete')->style('margin-right:20px') !!}
            {!! Former::sm_default_button('common.cancel')->data_dismiss('modal') !!}
        </div>
    {!! Former::close() !!}
@endsection
