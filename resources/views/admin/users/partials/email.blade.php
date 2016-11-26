@include("profile.partials.$section")
{!!
    Former::select('user_role')
    ->options([''=>'', 'admin' => trans('common.user.admin')])
    ->style('width:auto')
    ->title('Pasirinkite')
    ->class('form-control selectpicker')
    ->label('common.user.user_role')
!!}