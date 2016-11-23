{!! Former::password('password')->placeholder('common.user.new_password')->label('common.user.new_password') !!}
{!! Former::password('password_confirmation')->placeholder('common.user.repeat_password')->label('common.user.repeat_password') !!}
{!!
    Former::password('current_password')
        ->placeholder('common.user.current_password')
        ->label('common.user.current_password')
        ->inlineHelp('common.user.current_password_help')
!!}