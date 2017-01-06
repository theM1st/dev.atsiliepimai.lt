@if ($listing->description)
    <div class="listing-description-container">
        <div class="inner-header">
            <h3>{{ trans('common.form.listing.description') }}</h3>
        </div>
        <div class="listing-description" id="listing-description">
            {!! $listing->description !!}
        </div>
    </div>
@endif