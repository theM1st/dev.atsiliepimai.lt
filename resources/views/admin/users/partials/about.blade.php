{!! Former::text('first_name')->label('common.user.first_name') !!}
{!! Former::text('last_name')->label('common.user.last_name') !!}
{!! Former::text('telephone')->placeholder('+37010002000')->label('common.user.telephone') !!}
<div class="form-group">
    <label for="first_name" class="control-label col-lg-4 col-sm-4">{{ trans('common.user.birthday') }}</label>
    <div class="col-lg-8 col-sm-8">
        {{ Form::birthday($user->birthday) }}
    </div>
</div>

{!!
    Former::select('gender')
    ->options(['', 'male' => trans('common.user.male'), 'female' => trans('common.user.female')])
    ->class('form-control selectpicker gender')
    ->label('common.user.gender')
    ->title(trans('common.form.select'))
!!}