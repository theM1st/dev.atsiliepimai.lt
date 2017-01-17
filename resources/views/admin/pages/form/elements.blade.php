{!! Former::text('title')->label('common.form.page.title') !!}
{!!
    Former::textarea('description')
        ->label('common.form.page.description')
        ->rows(2)
        ->autofocus()
        ->inlineHelp('Aprašymas reikalingas paieškos sistemoms pvz. Google ir t.t. Ilgis ne mažiau 50 ir ne daugiau nei 160 simbolių.')
!!}
{!! Former::textarea('content')->label('common.form.page.content')->class('froala-editor') !!}
<div class="checkbox-container">
    {!! Former::checkbox('active')->class('icheck')->text('common.form.page.active') !!}
</div>