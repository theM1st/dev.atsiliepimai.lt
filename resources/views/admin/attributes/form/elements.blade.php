{!!
    Former::text('name')->label('common.form.attribute.name')
        ->help('common.form.attribute.name_help')
!!}
{!!
    Former::text('title')->label('common.form.attribute.title')
        ->help('common.form.attribute.title_help')
!!}
<div class="checkbox-container">
    {!! Former::checkbox('main')->class('icheck')->text('common.form.attribute.main')->check() !!}
</div>