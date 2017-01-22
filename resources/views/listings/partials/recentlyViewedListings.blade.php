@if ($listings)
    <div class="recently-viewed-listings">
        <h5>
            <span>Neseniai žiūrėti</span>
        </h5>
        @foreach ($listings as $l)
            <div class="listing">
                <a href="{{ route('listing.show', $l->slug) }}">
                    <span class="listing-picture">
                        <span class="img-circle img-circle-xs img-border-grey">
                            <img src="{{ $l->getPicture('xs') }}" alt="" class="img-responsive">
                        </span>
                    </span>
                    <span class="listing-container">
                        <p class="listing-title">{{ str_limit($l->title, 25) }}</p>
                        <span class="listing-rating">
                            {!! starRating($l->avg_rating, 'xs') !!}
                                <span class="listing-review-count">
                                ({{ count($l->reviews) . ' ' . transPlural('common.reviews_plural', count($l->reviews)) }})
                            </span>
                        </span>
                    </span>
                </a>
                <div class="remove-item">
                    <a href="{{ route('listing.recently_viewed_remove', $l->slug) }}"><span class="fa fa-times"></span></a>
                </div>
            </div>
        @endforeach
        <a href="{{ route('listing.recently_viewed_remove_all') }}" class="btn btn-third btn-sm" style="margin-top:10px;">Valyti visus įrašus</a>
    </div>
@endif