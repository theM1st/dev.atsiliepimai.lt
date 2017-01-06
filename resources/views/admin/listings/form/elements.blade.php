{!!
    Former::inline_radios('listing_type')->label('common.form.listing.listing_type')
        ->class('icheck')
        ->radios([
            trans('common.product') => ['value' => 'product'],
            trans('common.service') => ['value' => 'service']
        ])
!!}
{!!
    Former::text('title')->label('common.form.listing.title')
        ->help('common.form.listing.title_help')
!!}

{{ Form::categoriesHierarchy('category_id', $categories, old('category_id', $listing->category_id)) }}

<div class="checkbox-container">
    {!! Former::checkbox('active')->class('icheck')->text('common.form.listing.active')->check() !!}
</div>

{!!
    Former::select('attribute_id[]')
    ->options($mainAttributes)
    ->value($listing->attributes)
    ->class('form-control selectpicker')
    ->title(trans('common.form.select'))
    ->label('common.form.listing.main_attribute')
    ->help('Gali būti tik vienas pagrindinis atributas (Modeliai, karta ir t.t.)')
!!}

{!!
    Former::select('attribute_id[]')
    ->options($attributes)
    ->value($listing->attributes)
    ->class('form-control selectpicker')
    ->multiple('')
    ->title(trans('common.form.select'))
    ->label('common.form.listing.another_attributes')
    ->help('Galima pasirinkti keletą atributų, naudojamas kaip atsiliepimų filtras (Kėbulo tipas, kuro tipas...)')
!!}

{!!
    Former::file('picture')
        ->label('common.form.listing.picture')
        ->class('file-control')
        ->inlineHelp('common.form.picture_rules')
        ->max(3, 'MB')
!!}
