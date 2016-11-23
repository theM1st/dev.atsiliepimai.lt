{!! Former::text('address')->placeholder('common.user.address')->label('common.user.address') !!}
{!! Former::text('city')->placeholder('common.user.city')->label('common.user.city') !!}
{!!
    Former::select('country_id')
    ->options(App\Country::lists('name'))
    ->label('common.user.country')
    ->title(trans('common.form.select'))
    ->class('form-control selectpicker')
!!}
