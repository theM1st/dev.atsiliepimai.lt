<div class="profile-user">
    <img src="{{ $user->getPicture() }}" alt="{{ $user->username }}" class="img-responsive img-circle img-border-grey">
    <div class="username">{{ $user->username }}</div>
    <div class="join-date">{{ $user->created_at->format('Y-m-d') }}</div>
</div>
<div class="profile-nav">
    <h5>
        <span>{{ trans('common.profile.name') }}</span>
    </h5>
    <nav>
        <ul>
            @foreach(App\User::getProfileSections()['profile'] as $s)
            <li>
                <a href="{{ route('profile.show', $s) }}"@if(isset($section) && $section == $s) class="active"@endif>
                    {{ trans("common.profile.sections.$s") }}
                </a>
            </li>
            @endforeach
        </ul>
    </nav>
</div>
<div class="profile-nav settings-nav">
    <h5>
        <span>{{ trans('common.profile.settings') }}</span>
    </h5>
    <nav>
        <ul>
            @foreach(App\User::getProfileSections()['settings'] as $s)
                <li>
                    <a href="{{ route('profile.edit', $s) }}"@if(isset($section) && $section == $s) class="active"@endif>
                        {{ trans("common.profile.sections.$s") }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</div>