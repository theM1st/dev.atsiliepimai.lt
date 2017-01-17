<div class="btn-group">{{--
--}}<button type="button" class="btn btn-second btn-empty btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-ellipsis-h"></span></button>{{--
--}}<ul class="dropdown-menu dropdown-menu-right">{{--
    --}}@foreach ($tools as $name => $address)<li><a href="{{ $address }}" @if($name=='delete')onclick="return actionModal(this)" data-method="get" data-size="modal-sm" @endif @if($name=='show_censor_commentable') target="_blank"@endif>{{ trans('common.' . $name) }}</a></li>@endforeach{{--
--}}</ul></div>