@include("profile.partials.$section")
{!! Former::text('username')->placeholder('common.user.username')->label('common.user.username') !!}
{!!
    Former::select('user_role')
    ->options([''=>'', 'admin' => trans('common.user.admin')])
    ->style('width:auto')
    ->title('Pasirinkite')
    ->class('form-control selectpicker')
    ->label('common.user.user_role')
!!}