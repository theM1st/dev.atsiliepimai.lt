{!! Former::text('first_name')->placeholder(trans('common.user.first_name'))->label('common.user.first_name') !!}
{!! Former::text('last_name')->placeholder(trans('common.user.last_name'))->label('common.user.last_name') !!}
{!!
    Former::text('telephone')
    ->placeholder(trans('common.user.telephone'))
    ->label('common.user.telephone')
    ->inlineHelp('Jūsų telefonu nebus dalinamasi su trečiosiomis šalimis.')
!!}
{{ Form::birthday($user->birthday) }}
{!!
    Former::select('gender')
    ->options(['male' => trans('common.user.male'), 'female' => trans('common.user.female')])
    ->class('form-control selectpicker gender')
    ->title(trans('common.form.select'))
    ->label('common.user.gender')
!!}