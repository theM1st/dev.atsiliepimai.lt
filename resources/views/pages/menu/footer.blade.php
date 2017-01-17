<ul class="nav nav-pills">
    @foreach ($pages as $p)
        <li><a href="{{ route('page.show', $p->slug) }}">{{ $p->title }}</a></li>
    @endforeach
</ul>