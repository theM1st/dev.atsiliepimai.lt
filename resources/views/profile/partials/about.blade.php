{!! Former::text('first_name')->placeholder(trans('common.user.first_name'))->label('common.user.first_name') !!}
{!! Former::text('last_name')->placeholder(trans('common.user.last_name'))->label('common.user.last_name') !!}
{!!
    Former::text('telephone')
    ->placeholder(trans('common.user.telephone'))
    ->label('common.user.telephone')
    ->inlineHelp('Jūsų telefonu nebus dalinamasi su trečiosiomis šalimis.')
!!}
<div class="form-group">
    <div class="col-sm-12">
        <div class="form-label">{{ trans('common.user.birthday') }}</div>
    </div>
</div>
<div class="form-group">
    <label for="first_name" class="control-label col-lg-4 col-sm-4">{{ trans('common.user.birthday') }}</label>
    <div class="col-lg-5 col-sm-7">
        {{ Form::birthday($user->birthday) }}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-12">
        <div class="form-label">{{ trans('common.user.gender') }}</div>
    </div>
</div>
{!!
    Former::select('gender')
    ->options(['male' => trans('common.user.male'), 'female' => trans('common.user.female')])
    ->class('form-control selectpicker gender')
    ->title(trans('common.form.select'))
    ->label('common.user.gender')
!!}