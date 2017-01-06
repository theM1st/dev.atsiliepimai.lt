<div class="col-sm-6 col-md-7">
    <dl class="dl-horizontal">
        <dt>{{ trans('common.user.name') }}:</dt>
        <dd>
            @if ($user->name)
                {{ $user->name }}
            @else
                <a href="{{ route('profile.edit', 'About') }}">Pasakykite mums savo vardą!</a>
            @endif
        </dd>

        <dt>{{ trans('common.user.birthday') }}:</dt>
        <dd>
            @if ($user->birthday)
                {{ $user->birthday->format('Y-m-d') }}
            @else
                <a href="{{ route('profile.edit', 'About') }}">Pasakykite mums savo gimimo datą!</a>
            @endif
        </dd>

        <dt>{{ trans('common.user.gender') }}:</dt>
        <dd>
            @if ($user->gender)
                {{ $user->gender }}
            @else
                <a href="{{ route('profile.edit', 'About') }}">Nurodykite savo lytį</a>
            @endif
        </dd>

        <dt>{{ trans('common.user.place') }}:</dt>
        <dd>
            @if ($user->place)
                {{ $user->place }}
            @else
                <a href="{{ route('profile.edit', 'Address') }}">Redaguoti vietą</a>
            @endif
        </dd>
    </dl>
    <a href="{{ route('profile.edit', 'About') }}" class="btn btn-lg btn-second">{{ trans('common.profile.form.edit') }}</a>
</div>
<div class="col-sm-4 col-md-3">
    <div class="widget-activity">
        <h5>
            <span>Naujausia veikla</span>
        </h5>
        <dl class="dl-horizontal">
            <dt>Atsiliepimai:</dt>
            <dd>{{ $user->reviews->count() }}</dd>
            <dt>Klausimai:</dt>
            <dd>{{ $user->questions->count() }}</dd>
            <dt>Atsakymai:</dt>
            <dd>{{ $user->answers->count() }}</dd>
        </dl>
    </div>
    <div class="widget-recently-viewed-reviews">
        {!! $recentlyViewedListings !!}

    </div>
</div>