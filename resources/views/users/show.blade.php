@extends('layouts.app')

@section('title', getTitle($thisUser->username . ' profilis'))

@section('content')
    <section class="main-section user-show">
        <div class="container">
            <h2>{{ $thisUser->username . ' profilis' }}</h2>
            <div class="row">
                <div class="col-sm-3 col-md-2">
                    <img src="{{ $thisUser->getPicture() }}" alt="{{ $thisUser->username }}" class="img-responsive img-circle img-border-grey">
                </div>
                <div class="col-sm-6 col-md-7">
                    <dl class="dl-horizontal">
                        <dt>{{ trans('common.user.created_at') }}:</dt>
                        <dd>{{ $thisUser->created_at->format('Y-m-d') }}</dd>
                        @if ($thisUser->birthday)
                            <dt>{{ trans('common.user.birthday') }}:</dt>
                            <dd>{{ $thisUser->birthday->format('Y-m-d') }}</dd>
                        @endif
                        @if ($thisUser->gender)
                            <dt>{{ trans('common.user.gender') }}:</dt>
                            <dd>{{ trans('common.user.'.$thisUser->gender) }}</dd>
                        @endif
                        @if ($thisUser->place)
                            <dt>{{ trans('common.user.place') }}:</dt>
                            <dd>{{ $thisUser->place }}</dd>
                        @endif
                    </dl>
                </div>
            </div>

            <h3>{{ trans('common.reviews') }}</h3>
            @if ($reviews->count())
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Data</th>
                        <th>Atsiliepimas</th>
                        <th>Produktas/Paslauga</th>
                        <th>Įvertinimas</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($reviews as $r)
                        <tr>
                            <td>{{ $r->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('listing.show', [ $r->listing->slug, '#review'.$r->id ]) }}">{{ str_limit($r->review_title, 50) }}</a>
                            </td>
                            <td>
                                @if ($r->listing->reviews->count() == 0)
                                    <span>{{ str_limit($r->listing->title, 50) }}</span>
                                @else
                                    <a href="{{ route('listing.show', $r->listing->slug) }}">{{ str_limit($r->listing->title, 50) }}</a>
                                @endif
                            </td>
                            <td>{!! starRating($r->rating) !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted text-center">Nėra produktų</p>
            @endif
            <br>
            <h3>{{ trans('common.questions') }}</h3>
            @if ($questions->count())
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Data</th>
                        <th>Klausimas</th>
                        <th>Produktas/Paslauga</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($questions as $q)
                        <tr>
                            <td>{{ $q->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('listing.show', [$q->listing->slug, '#question'.$q->id]) }}">
                                    {{ str_limit($q->title, 60) }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('listing.show', $q->listing->slug) }}">
                                    {{ str_limit($q->listing->title, 60) }}
                                </a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted text-center">Nėra klausimų</p>
            @endif
            <br>
            <h3>{{ trans('common.answers') }}</h3>
            @if ($answers->count())
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Data</th>
                        <th>Atsakymas</th>
                        <th>Produktas/Paslauga</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($answers as $a)
                        <tr>
                            <td>{{ $a->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('listing.show', [$q->listing->slug, '#answer'.$a->id]) }}">
                                    {{ str_limit($a->title, 60) }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('listing.show', $a->question->listing->slug) }}">
                                    {{ str_limit($a->question->listing->title, 60) }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted text-center">Nėra atsakymų</p>
            @endif
        </div>
    </section>
@endsection