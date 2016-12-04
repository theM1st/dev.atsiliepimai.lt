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

{{ Form::categoriesHierarchy('category_id', $categories, old('category_id')) }}

{!!
    Former::text('rating')->label('common.form.review.rating')
!!}

{!!
    Former::text('review_title')->label('common.form.review.title')
        ->placeholder('common.form.review.title_placeholder')
        ->help('common.form.review.title_help')
!!}

{!!
    Former::textarea('review_description')
        ->placeholder('common.form.review.description_placeholder')
        ->label('common.form.review.description')
        ->help('common.form.review.description_help')
!!}
<div class="checkbox-container">
    {!! Former::checkbox('active')->class('icheck')->text('common.form.listing.active')->check() !!}
</div>
<hr>