<div class="listings-review-listing">
    <div class="listing-info">
        <div class="row">
            <div class="col-sm-7">
                <div class="listing-info-summary">
                    <h4>{{ trans('common.reviews') }}</h4>

                    <div class="row">
                        <div class="col-sm-6 feedback-container">
                            <div class="rating">
                                {!! starRating($listing->avg_rating, 'sm', 'rating-white') !!}
                                <div class="reviews-count">
                                    ({{ count($listing->reviews) . ' ' . transPlural('common.reviews_plural', count($listing->reviews)) }})
                                </div>
                            </div>
                            <ul class="feedback">
                                @foreach(App\Review::getRatings() as $score => $title)
                                    <?php $value = $listing->reviews()->ofRating($score)->count()*25; ?>
                                    <li>
                                        <div class="title">{{ $title }}</div>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar"
                                                 aria-valuenow="{{ $value }}"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100"
                                                 style="width: {{ $value }}%;">
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            @if ($mainAttribute = $listing->getMainAttribute())
                                <div class="listing-models">
                                    <div class="listing-models-title">{{ $mainAttribute->title }}</div>
                                    @foreach ($mainAttribute->options as $o)
                                        @if ($reviews = $o->reviews($listing->id)->count())
                                            <p class="{{ $model == $o->slug ? 'active' : '' }}">
                                                <a href="{{ (!empty($admin) ? route('listings.reviews', [$listing->id, $o->slug]) : route('listing.show.model', [$listing->slug, $o->slug])) }}">
                                                    {{ $o->option_name }}
                                                </a>
                                                <span>({{ $reviews }})</span>
                                            </p>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 listing-side">
                <h2>{{ $listing->title }}</h2>
                <div class="row">
                    <div class="col-lg-5">
                        <div class="listing-picture">
                            <div class="listing-rating">{{ $listing->avg_rating }}</div>
                            <img class="img-responsive img-circle img-border-white" src="{{ $listing->getPicture('md') }}" alt="{{ $listing->title }}">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="write-review"><a href="{{ route('review.create', $listing->slug) }}" class="btn btn-first btn-lg">Parašykite atsiliepimą</a></div>
                        <div class="ask-question"><a href="" class="btn btn-green btn-empty btn-lg">Užduokite klausimą</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <div class="listing-nav">
                    <ul class="nav nav-pills">
                        <li><a href="{{ route('listings.reviews', $listing->id) }}">Atsiliepimai ({{ $listing->reviews->count() }})</a></li>
                        <li><a href="#listing-questions">Klausimai ir atsakymai</a></li>
                        <li><a href="#listing-description">Produkto detalės</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-5">
                <?php $filters = $listing->getSecondaryAttributes(); ?>
                @if ($filters->count())
                    <div class="listing-filters">
                        <form>
                            <div class="filter-by">Filtruoti pagal:</div>
                            @foreach ($filters as $f)
                                <div class="filter">
                                    {!!
                                        Former::select("filter[$f->id]")
                                        ->options($f->options->pluck('option_name', 'id')->prepend('Visi', ''))
                                        ->class('form-control selectpicker')
                                        ->title('Visi')
                                        //->value($f->id)
                                        ->label($f->title)
                                    !!}
                                </div>
                            @endforeach
                            <input type="hidden" name="sort" value="{{ Request::get('sort') }}">
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>