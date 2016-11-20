<div class="profile-nav">
    <h5>
        <span>{{ trans('common.profile.name') }}</span>
    </h5>
</div>
<div class="profile-nav settings-nav">
    <h5>
        <span>{{ trans('common.profile.settings') }}</span>
    </h5>
    <nav>
        <ul>
            @foreach($sections as $s)
                <li>
                    <a href="{{ route('profile.edit', $s) }}"@if($section == $s) class="active"@endif>
                        {{ trans("common.profile.sections.$s") }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</div>