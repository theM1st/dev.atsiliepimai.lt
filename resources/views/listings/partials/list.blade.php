
@if ($listings)
    <div class="listing-filter clearfix">
        <div class="filter-holder pull-right">
            {!!
                Former::select('sort')
                ->options(App\Listing::getSortby())
                ->class('form-control selectpicker')
                ->title(trans('common.form.select'))
                ->value('newest')
                ->label('')
            !!}
        </div>
    </div>

    <div class="listing-list">

        @foreach($listings as $l)
            <div class="listing-item-container">
                <div class="row">
                    <div class="col-md-10 col-sm-9">
                        <a href="{{ route('listing.show', $l->slug) }}" class="listing-item">
                            <span class="listing-picture img-circle img-circle-md img-border-grey">
                                <img src="{{ $l->getPicture() }}" alt="" class="img-responsive">
                            </span>
                            <span class="listing-title">{{ $l->title }}</span>
                            <span class="listing-rating">
                                {!! starRating($l->avg_rating) !!}
                                <span class="listing-review-count">
                                    ({{ count($l->reviews) . ' ' . transPlural('common.reviews_plural', count($l->reviews)) }})
                                </span>
                            </span>
                            <span class="listing-review">
                                <strong>Paskutinis atsiliepimas:</strong>
                                {{ $l->lastReview()->review_description }}
                            </span>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-3">
                        <a href="{{ route('review.create', $l->slug) }}" class="btn btn-second btn-empty">Rašyti atsiliepimą</a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    {{ $listings->appends(['sort' => Request::get('sort')])->links() }}
@endif