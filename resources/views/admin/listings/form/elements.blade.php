{!!
    Former::inline_radios('listing_type')->label(trans('common.form.listing.listing_type'))
        ->radios([
            trans('common.product') => ['value' => 'product'],
            trans('common.service') => ['value' => 'service']
        ])
!!}
{!!
    Former::text('name')->label('common.form.listing.name')
        ->inlineHelp('Ne daugiau nei 60 simbolių')
!!}
{{ Form::categoriesHierarchy('category_id', $categories, old('category_id')) }}
<hr>