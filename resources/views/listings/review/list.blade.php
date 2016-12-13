<div class="inner-header">
    <h3>{{ trans('common.reviews') }}</h3>
    <div class="filter-holder">
        {!!
            Former::select('sort')
            ->options(['a', 'b'])
            ->class('form-control selectpicker')
            ->title(trans('common.form.select'))
            ->label('')
        !!}
    </div>
</div>
<div class="review-list">
    @foreach ($reviews as $r)
        <div class="review">
            <div class="row">
                <div class="col-sm-3 review-author-info">
                    <img src="{{ $r->user->getPicture() }}" alt="{{ $r->user->username }}" class="img-circle img-border-grey">
                    <ul>
                        <li>
                            <span class="fa fa-comments-o" aria-hidden="true"></span>
                            {{ count($r->user->reviews) .' '.transPlural('common.reviews_plural', count($r->user->reviews)) }}
                        </li>
                        <li>
                            <span class="fa fa-handshake-o" aria-hidden="true"></span>
                            1 patarimas
                        </li>
                        <li>
                            <span class="fa fa-envelope" aria-hidden="true"></span>
                            Siųsti AŽ
                        </li>
                    </ul>
                </div>
                <div class="col-sm-9">
                    <h3{{ !$r->active ? ' style=color:#f10028' : '' }}>
                        @if (!$r->active) <i class="fa fa-circle text-red"></i> @endif
                        {{ $r->review_title }}
                    </h3>
                    <div class="review-rating">
                        {!! starRating($r->rating) !!}
                    </div>
                    <div class="review-text">{{ $r->review_description }}</div>
                    <div class="review-info">
                        <p class="review-created">Atsiliepimas parašytas: <span>{{ $r->created_at->format('Y.m.d') }}</span></p>
                        <p class="review-author-name">Parašė: <span>{{ $r->user->username }}</span></p>
                        <p class="review-report">
                            Netinkamas atsiliepimas?
                            <a href="#">Pranešk<span class="fa fa-flag"></span></a>
                        </p>
                        <div class="review-voting">
                            @if (Auth::check() && Auth::user()->reviewVoted($r->id))
                                <div><strong>Jus</strong> jau balsavote.</div>
                            @else
                                {!! Former::open()->route('reviews.vote', $r->id)->method('post') !!}
                                    <button type="submit" class="btn btn-link btn-like" name="like">
                                        <span class="fa fa-thumbs-up"></span>
                                        Super, labai patiko
                                    </button>
                                    <button type="submit" class="btn btn-link btn-dislike" name="dislike">
                                        <span class="fa fa-thumbs-down"></span>
                                        Visai nepatiko
                                    </button>
                                {!! Former::close() !!}
                            @endif
                        </div>
                        @if (!empty($admin))
                            <div style="margin-top: 20px;text-align: right">
                                <a href="{{ route('reviews.edit', $r->id) }}" class="btn btn-second btn-sm">Redaguoti</a>
                                <a href="{{ route('reviews.delete', $r->id) }}" class="btn btn-red btn-sm" onclick="return actionModal(this)" data-method="get" data-size="modal-sm">Trinti</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{ $reviews->links() }}
</div>
@section('scripts')
    <script>
        $('#sort').on('changed.bs.select', function (e) {
            alert('aaa');
        });
    </script>
@endsection