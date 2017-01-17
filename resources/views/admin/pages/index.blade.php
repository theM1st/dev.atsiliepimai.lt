@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container">
        <div class="admin-block pages-index">
            {!! adminHeaderTitle() !!}

            <div class="admin-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="page-list sortable-list">
                            <ul class="sortable list-unstyled">
                                @foreach($pages as $p)
                                    <li class="clearfix country-name" data-id="{{ $p->id }}">
                                        <div>
                                            <span class="sort-handle ui-sortable-handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            {!! $p->active ? '<i class="fa fa-circle text-green"></i> ' : '<i class="fa fa-circle text-red"></i> ' !!}
                                            <span class="text">{{ $p->title }}</span>
                                            {!!
                                                Form::tools([
                                                    'edit' => route('pages.edit', $p->id),
                                                    'delete' => route('pages.delete', $p->id)
                                                ])
                                            !!}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
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
                    var url = '{{ route('pages.move', [':id', ':position']) }}';
                    url = url.replace(':id', ui.item.data('id')).replace(':position', ui.item.index()+1);
                    ajax(url, 'get');
                }
            });
        })();
    </script>
@endsection