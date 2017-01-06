<div class="category-navigation">
    <ul>
        @foreach (App\Category::roots()->get() as $c)
            <?php $children = $c->children()->get() ?>
            <li>
                <a href="{{ route('category.show', $c->slug) }}" class="main-category{{ ($c->slug == Request::segment(2) ? ' active' : '') }}">
                    {{ $c->name }}
                </a>
                @if (count($children))
                    <ul>
                        @foreach ($children as $sub)
                            <?php $children2 = $sub->children()->get() ?>
                            <li class="dropdown{{ ($sub->slug == Request::segment(2) || in_array(Request::segment(2), $children2->pluck('slug')->toArray()) ? ' open' : '') }}">
                                <a href="{{ route('category.show', $sub->slug) }}" class="{{ ($sub->slug == Request::segment(2) ? ' active' : '') }}">
                                    {{ $sub->name }}
                                </a>
                                @if (count($children2))
                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        <span class="caret"></span>
                                    </a>
                                @endif
                                @if (count($children2))
                                    <ul class="dropdown-menu" role="menu">
                                        @foreach ($children2 as $sub2)
                                            <li>
                                                <a href="{{ route('category.show', $sub2->slug) }}" class="{{ ($sub2->slug == Request::segment(2) ? ' active' : '') }}">
                                                    {{ $sub2->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</div>