@extends('modal')

@section('content')
    {!! Former::open()->route('categories.destroy', ['id'=>$category->id])->secure()->method('delete') !!}
        <div class="text-center">
            @if (count($category->children))
                <p class="alert alert-danger">Negalima ištrinti kategoriją, nes ji turi subkategoriją(-as).</p>
                {!! Former::sm_primary_button('common.ok')->data_dismiss('modal') !!}
            @else
                {!! Former::sm_primary_submit('common.delete')->style('margin-right:20px') !!}
                {!! Former::sm_default_button('common.cancel')->data_dismiss('modal') !!}
            @endif

        </div>
    {!! Former::close() !!}
@endsection
