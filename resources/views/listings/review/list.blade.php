<div class="inner-header">
    <h3>{{ trans('common.reviews') }}</h3>
    <div class="filter-holder">
        {!!
            Former::select('sort')
            ->options(App\Review::getSortby())
            ->class('form-control selectpicker')
            ->title(trans('common.form.select'))
            ->value('newest')
            ->label('')
        !!}
    </div>
</div>
<div class="listings-review-list" id="reviews">
    @foreach ($reviews as $r)
        <div class="review" id="review{{ $r->id }}">
            <div class="row">
                <div class="col-sm-3 review-author-info">
                    <div class="author-picture">
                        <img src="{{ $r->user->getPicture() }}" alt="{{ $r->user->username }}" class="img-circle img-border-grey img-responsive">
                    </div>
                    <div class="author-name">
                        <a href="{{ route('user.show', $r->user->id) }}">
                            {{ $r->user->username }}
                        </a>
                    </div>
                    <ul>
                        <li>
                            <span class="fa fa-comments-o" aria-hidden="true"></span>
                            {{ count($r->user->reviews) .' '.transPlural('common.reviews_plural', count($r->user->reviews)) }}
                        </li>
                        @if (count($r->user->answers))
                            <li>
                                <span class="fa fa-handshake-o" aria-hidden="true"></span>
                                {{ count($r->user->answers) .' '.transPlural('common.advices_plural', count($r->user->answers)) }}
                            </li>
                        @endif
                        <li>
                            <span class="fa fa-envelope" aria-hidden="true"></span>
                            <a href="{{ route('messages.create', $r->user->id) }}">Siųsti AŽ</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-9">
                    @if ($attributes = $r->attributes->sortByDesc('main')->all())
                        <div class="review-attributes">
                            @foreach ($attributes as $a)
                                @if ($attributeOption = $r->getReviewAttributeOption($a->id))
                                    @if ($a->main)
                                        <span class="badge main-badge">
                                            {{ $attributeOption->option_name }}
                                        </span>
                                    @else
                                        <span class="badge">
                                            {{ $a->title }}:
                                            {{ $attributeOption->option_name }}
                                        </span>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <h3{{ !$r->active ? ' style=color:#f10028' : '' }}>
                        @if (!$r->active) <i class="fa fa-circle text-red"></i> @endif
                        {{ $r->review_title }}
                    </h3>
                    <div class="review-rating">
                        {!! starRating($r->rating) !!}
                    </div>
                    <div class="review-text">{{ $r->review_description }}</div>
                    @if ($r->review_pros)
                        <div class="review-pros">
                            <span class="fa fa-plus-circle"></span>
                            {{ $r->review_pros }}
                        </div>
                    @endif
                    @if ($r->review_cons)
                        <div class="review-cons">
                            <span class="fa fa-minus-circle"></span>
                            {{ $r->review_cons }}
                        </div>
                    @endif
                    <div class="review-info">
                        <p class="review-created">Atsiliepimas parašytas: <span>{{ $r->created_at->format('Y.m.d') }}</span></p>
                        <p class="review-report">
                            Netinkamas atsiliepimas?
                            <a href="{{ route('censor.create', [$r->listing->slug, 'review', $r->id]) }}">Pranešk<span class="fa fa-flag"></span></a>
                        </p>
                        <div class="review-voting">
                            @if (Auth::check() && Auth::user()->reviewVoted($r->id))
                                <div><strong>Jūs</strong> jau balsavote.</div>
                                @if ($positive = $r->positiveVotes->count())
                                    <span class="btn-like">
                                        <span class="fa fa-thumbs-up"></span>
                                        Super, labai patiko
                                        <span>({{ $positive }})</span>
                                    </span>
                                @endif
                                @if ($negative = $r->negativeVotes->count())
                                    <span class="btn-dislike">
                                        <span class="fa fa-thumbs-down"></span>
                                        Visai nepatiko
                                        <span>({{ $negative }})</span>
                                    </span>
                                @endif
                            @elseif(!App\User::isUserReview($r->id))
                                {!! Former::open()->route('reviews.vote', $r->id)->method('post') !!}
                                    <button type="submit" class="btn btn-link btn-like" name="like">
                                        <span class="fa fa-thumbs-up"></span>
                                        Super, labai patiko
                                        @if ($positive = $r->positiveVotes->count())
                                            <span>({{ $positive }})</span>
                                        @endif
                                    </button>
                                    <button type="submit" class="btn btn-link btn-dislike" name="dislike">
                                        <span class="fa fa-thumbs-down"></span>
                                        Visai nepatiko
                                        @if ($negative = $r->negativeVotes->count())
                                            <span>({{ $negative }})</span>
                                        @endif
                                    </button>
                                {!! Former::close() !!}
                            @endif
                        </div>
                        @if (!empty($admin))
                            <div style="margin-top: 20px;text-align: right">
                                <a href="{{ route('reviews.edit', $r->id) }}" class="btn btn-second btn-sm">Redaguoti</a>
                                <a href="{{ route('reviews.delete', $r->id) }}" class="btn btn-red btn-sm" onclick="return actionModal(this)" data-method="get">Trinti</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{ $reviews->appends(['sort' => Request::get('sort'), 'filter' => Request::get('filter')])->links() }}
</div>
@section('scripts')
    @parent
    <script>
        $('#sort').on('changed.bs.select', function () {
            location.href = '/{{ Request::path() }}?sort=' + $(this).val();
        });
        $('.filter select').on('changed.bs.select', function () {
            $('.listing-filters form').submit();
        });
    </script>
@endsection