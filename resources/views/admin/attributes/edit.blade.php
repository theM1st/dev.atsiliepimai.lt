@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container">
        <div class="admin-block attributes-edit">
            {!! adminHeaderTitle() !!}

            <div class="admin-body">
                <div class="row">
                    <div class="col-md-6">
                        {!! Former::open()->route('attributes.update', $attribute->id)->method('put') !!}

                            @include('admin.attributes.form.elements')

                            <hr>

                            <h4>Atributo reikšmės</h4>
                            <table class="table table-striped">
                                <?php $k = 0; ?>
                                @foreach ($attribute->options as $k => $o)
                                    <tr>
                                        <td class="option-nr">{{ $k = $k + 1 }}</td>
                                        <td>
                                            {!!
                                                Former::sm_text('option_name[]')->value($o->option_name)->label('')
                                            !!}
                                            <input name="option_id[]" value="{{ $o->id }}" type="hidden">
                                        </td>
                                        <td>
                                            <a href="{{ route('attribute_options.delete', $o->id) }}" class="btn btn-red btn-empty" onclick="return actionModal(this)" data-method="get" data-size="modal-sm">
                                                {{ trans('common.delete') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="last-option">
                                    <td class="option-nr">{{ $k + 1 }}</td>
                                    <td>
                                        <input class="input-sm form-control" name="option_name[]" value="" type="text">
                                    </td>
                                    <td></td>
                                </tr>
                            </table>
                            <a href="#more" class="btn btn-third btn-more" style="width: 100%">Daugiau</a>

                            <hr>
                            {!! Former::actions()->first_lg_submit('common.update') !!}

                        {!! Former::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .table tr td.option-nr {
            font-size: 24px;
            text-align: right;
        }
        .table  tr  td  .form-group {
            margin-bottom: 0;
        }
    </style>
@endsection

@section('scripts')
    <script>
        (function(o) {

            o.find('.btn-more').click(function() {

                var option = $('.last-option').clone().removeClass('last-option').remove('input[type=hidden]');

                option.find('.option-nr').html(o.find('.table tr').length + 1);
                option.find('input').val('');

                o.find('.table').append(option);

            });

        })($('.attributes-edit'));
    </script>
@endsection