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
<hr>