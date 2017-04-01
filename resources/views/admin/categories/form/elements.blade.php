{!!
    Former::text('name')->label('common.form.category.name')
        ->inlineHelp('Pavadinimas turi būti unikalus ir ne daugiau nei 60 simbolių')
!!}
{!!
    Former::select('parent_id')
        ->options(collect($categories)->prepend(trans('common.form.category.main'), ''))
        ->class('form-control selectpicker')
        ->title(trans('common.form.category.main'))
        ->label('common.form.category.parent')
        ->data_live_search('true')
!!}

{!!
    Former::text('meta_title')
        ->label('common.form.category.meta_title')
        ->inlineHelp('Antraštė reikalinga paieškos sistemoms pvz. Google ir t.t. Ilgis ne daugiau 100 simbolių.')
!!}

{!!
    Former::textarea('description')
        ->label('common.form.category.description')
        ->rows(2)
        ->autofocus()
        ->inlineHelp('Aprašymas reikalingas paieškos sistemoms pvz. Google ir t.t. Ilgis ne mažiau 50 ir ne daugiau nei 160 simbolių, idealiai kiekviena kategorija turi turėti unikalų aprašymą.')
!!}

<div class="checkbox-container">
    {!!
        Former::checkbox('popular')->class('icheck')
            ->text('common.form.category.popular')
            ->help('Kategorija matoma pagrindiniame puslapyje')
    !!}
</div>

<div class="checkbox-container">
{!! Former::checkbox('active')->class('icheck')->text('common.form.category.active') !!}
</div>

{!!
    Former::file('picture')
        ->label('common.form.category.picture')
        ->class('file-control')
        ->inlineHelp('common.form.picture_rules')
        ->max(3, 'MB')
!!}
<hr>