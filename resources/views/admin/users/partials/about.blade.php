{!! Former::text('first_name')->label('common.user.first_name') !!}
{!! Former::text('last_name')->label('common.user.last_name') !!}
{!! Former::text('telephone')->placeholder('+37010002000')->label('common.user.telephone') !!}
<div class="form-group">
    <label for="first_name" class="control-label col-lg-4 col-sm-5">{{ trans('common.user.birthday') }}</label>
    <div class="col-lg-8 col-sm-7">
        {{ Form::birthday($user->birthday) }}
    </div>
</div>

{!!
    Former::select('gender')
    ->options(['', 'male' => trans('common.user.male'), 'female' => trans('common.user.female')])
    ->class('form-control gender')
    ->label('common.user.gender')
!!}