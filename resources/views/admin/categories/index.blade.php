@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container">
        <div class="admin-block categories-index">
            {!! adminHeaderTitle() !!}

            <div class="admin-body">
                <div class="row">
                    <div class="col-md-7">
                        <ul class="category-list">
                            <li>
                                {{ trans('common.category.main') }}
                                <ul class="sortable">
                                    @foreach($categories as $node)
                                        {!! adminRenderNode($node) !!}
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        (function(){
            $('.sortable').sortable({
                handle: '.sort-handle',
                update: function(event, ui) {
                    var url = '{{ route('categories.move', [':id', ':position']) }}';
                    url = url.replace(':id', ui.item.data('id')).replace(':position', ui.item.index());
                    ajax(url, 'get');
                }
            });
        })();
    </script>
@endsection