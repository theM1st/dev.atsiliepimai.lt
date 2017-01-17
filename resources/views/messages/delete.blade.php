@extends('modal')

@section('content')
    <div class="text-center">
        {!! Former::sm_third_button('common.cancel')->data_dismiss('modal')->style('margin-right:20px') !!}
        {!! Former::sm_red_button('common.delete') !!}
    </div>
    <script>
        $('.btn-red').click(function() {
            $('#messages-destroy').submit();
        });
    </script>
@endsection

