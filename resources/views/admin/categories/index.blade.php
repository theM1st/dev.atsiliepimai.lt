@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container categories-index">
        {!! adminHeaderTitle() !!}
        <div class="row">
            <div class="col-sm-6">
                <ul class="sortable category-list">
                @foreach($categories as $node)
                    {!! adminRenderNode($node) !!}
                @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        (function(){
            $('.sortable').sortable({
                update: function(event, ui) {
                    var url = '{{ route('categories.move', [':id', ':position']) }}';
                    url = url.replace(':id', ui.item.data('id')).replace(':position', ui.item.index());
                    ajax(url, 'get');
                }
            });
        })();
    </script>
@endsection