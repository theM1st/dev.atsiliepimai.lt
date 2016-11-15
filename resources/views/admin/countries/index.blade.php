@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container countries-index">
        {!! adminHeaderTitle() !!}
        <div class="row">
            <div class="col-sm-6">
                <ul class="sortable list-unstyled country-list">
                    @foreach($countries as $c)
                        <li class="clearfix country-name" data-id="{{ $c->id }}">
                            {{ $c->name }}
                            {!! Form::actions([
                                'edit' => route('countries.edit', $c->id),
                                'delete' => route('countries.delete', $c->id)
                            ]) !!}
                        </li>
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
                    var url = '{{ route('countries.move', [':id', ':position']) }}';
                    url = url.replace(':id', ui.item.data('id')).replace(':position', ui.item.index());
                    ajax(url, 'get');
                }
            });
        })();
    </script>
@endsection