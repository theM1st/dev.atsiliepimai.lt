{!! Former::email('email')->label('common.user.email') !!}
{!! Former::text('username')->label('common.user.username') !!}
{!!
    Former::select('user_role')
    ->options([''=>'', 'admin' => trans('common.user.admin')])
    ->style('width:auto')
    ->label('common.user.user_role')
!!}