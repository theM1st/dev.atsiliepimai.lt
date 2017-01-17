@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container">
        <div class="admin-block countries-index">
            {!! adminHeaderTitle() !!}

            <div class="admin-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="country-list sortable-list">
                            <ul class="sortable list-unstyled">
                                @foreach($countries as $c)
                                    <li class="clearfix country-name" data-id="{{ $c->id }}">
                                        <div>
                                            <span class="sort-handle ui-sortable-handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <span class="text">{{ $c->name }}</span>
                                            {!!
                                                Form::tools([
                                                    'edit' => route('countries.edit', $c->id),
                                                    'delete' => route('countries.delete', $c->id)
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
                    var url = '{{ route('countries.move', [':id', ':position']) }}';
                    url = url.replace(':id', ui.item.data('id')).replace(':position', ui.item.index()+1);
                    ajax(url, 'get');
                }
            });
        })();
    </script>
@endsection