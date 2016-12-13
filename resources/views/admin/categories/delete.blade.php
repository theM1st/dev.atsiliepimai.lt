@extends('modal')

@section('content')
    {!! Former::open()->route('categories.destroy', ['id'=>$category->id])->secure()->method('delete') !!}
        <div class="text-center">
            @if (count($category->children))
                <p class="alert alert-danger">Negalima ištrinti kategoriją, nes ji turi subkategoriją(-as).</p>
                {!! Former::sm_first_empty_button('common.ok')->data_dismiss('modal') !!}
            @else
                {!! Former::sm_third_empty_button('common.cancel')->data_dismiss('modal')->style('margin-right:20px') !!}
                {!! Former::sm_red_empty_submit('common.delete') !!}

            @endif

        </div>
    {!! Former::close() !!}
@endsection
