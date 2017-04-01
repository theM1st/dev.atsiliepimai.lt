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

<div class="row brand-group-container" style="{{ $listing->listing_type == 'service' || old('listing_type') == 'service' ? 'display: none' : '' }}">
    <div class="col-sm-6">
        {!!
            Former::text('brand_value')->label('common.form.listing.brand')
                ->placeholder('common.form.listing.brand_placeholder')
                ->help('common.form.listing.brand_help')
        !!}
    </div>
    @if ($listing->brand_value && !$listing->brand_id)
        <div class="col-sm-6" style="padding-top: 35px;">
            <a href="{{ route('listings.toggleBrand', [$listing->id, 'accept']) }}" class="btn btn-second btn-sm">Patvirtinti</a>
            <a href="{{ route('listings.toggleBrand', [$listing->id, 'cancel']) }}" class="btn btn-red btn-sm">Atmesti</a>
        </div>
    @endif
</div>

<div class="address-group-container" style="{{ $listing->listing_type == 'product' || old('listing_type') == 'product' ? 'display: none' : '' }}">
    {!!
        Former::text('address')->label('common.form.listing.address')
    !!}
</div>

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
