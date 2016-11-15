{!! Former::text('address')->label('common.user.address') !!}
{!! Former::text('city')->placeholder('Vilnius')->label('common.user.city') !!}
{!!
    Former::select('country_id')
    ->options(App\Country::lists('name'))
    ->label('common.user.country')
!!}
