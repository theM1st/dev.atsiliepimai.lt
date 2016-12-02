{!!
    Former::text('name')->label('common.category.name')
        ->inlineHelp('Pavadinimas turi būti unikalus ir ne daugiau nei 60 simbolių')
!!}
{!!
    Former::select('parent_id')
        ->options(collect($categories)->prepend(trans('common.category.main'), ''))
        ->class('form-control selectpicker')
        ->title(trans('common.category.main'))
        ->label('common.category.parent')
        ->data_live_search('true')
!!}

{!!
    Former::textarea('description')
        ->label('common.description')
        ->rows(2)
        ->autofocus()
        ->inlineHelp('Aprašymas reikalingas paieškos sistemoms pvz. Google ir t.t. Ilgis ne mažiau 50 ir ne daugiau nei 160 simbolių, idealiai kiekviena kategorija turi turėti unikalų aprašymą (meta description).')
!!}

<div class="checkbox-container">
{!! Former::checkbox('active')->text('common.category.active') !!}
</div>
<hr>