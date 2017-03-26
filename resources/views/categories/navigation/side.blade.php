@php
    $realCategory = $category;
@endphp

<div class="category-navigation">
    @if ($category->getLevel() == 0 && $brand->id)
    @else
        @if ($category->getLevel() > 1)
            @php
                $category = $category->parent
            @endphp
        @endif

        @if ($category->children->count())
            <h5>
                <span>{{ $category->name }}</span>
            </h5>
            <ul class="subcategory-list">
                @foreach ($category->children as $c)
                    @php $children2 = $c->children()->get(); $active = ($c->slug == Request::segment(2)); @endphp
                        <li class="dropdown{{ ($active || in_array(Request::segment(2), $children2->pluck('slug')->toArray()) ? ' open' : '') }}">
                            <a href="{{ route('category.show', ($active ? $c->parent->slug : $c->slug)) }}" class="{{ ($active ? ' active' : '') }}">
                                {{ $c->name }}
                                @if ($active)
                                    <span class="fa fa-window-close" aria-hidden="true"></span>
                                @endif
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
    @endif
    @if ($listingsWithBrand->count())
        <h5>
            <span>Gamintojai</span>
        </h5>

        <ul class="subcategory-list">
            @foreach ($listingsWithBrand as $item)
                @php
                    $brandActive = ($item->brand->id == $brand->id ? ' active' : '');
                @endphp
                <li>
                    <a href="{{ ($brandActive ? route('category.show', $realCategory->slug) : route('category.show.brand', [$realCategory->slug, $item->brand->slug])) }}"
                       class="{{ ($brandActive ? ' active' : '') }}">
                        {{ $item->brand->name }}
                        @if ($brandActive)
                            <span class="fa fa-window-close" aria-hidden="true"></span>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>