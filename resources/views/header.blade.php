<header class="header">
    <div class="container">
        <div class="navbar-header">
            <button aria-controls="bs-navbar" aria-expanded="true" class="navbar-toggle" data-target="#bs-navbar" data-toggle="collapse" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand">
                <img src="{{ asset('assets/images/logo.png') }}" alt="{{ config('app.name') }}">
            </a>
            <button class="btn btn-link search-panel-toggle" aria-controls="search-panel" data-toggle="collapse" data-target="#search-panel">
                <span class="fa fa-search" aria-hidden="true"></span>
            </button>
        </div>

        <div class="search-panel navbar-collapse collapse" id="search-panel">
            <form action="{{ route('listing.search') }}">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Ieškoti tarp produktų, paslaugų">
                    <div class="input-group-btn">
                        <button class="btn" type="submit">
                            <span class="fa fa-search" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>


        <nav class="navbar-collapse collapse" id="bs-navbar">
            <div class="create-review">
                <a href="{{ route('listing.create') }}" class="btn btn-first btn-lg">Parašykite atsiliepimą</a>
            </div>
            <ul class="nav navbar-nav">
                <li>
                    <div class="dropdown">
                        <a href="" class="nav-link categories-menu-link" data-toggle="dropdown" id="categories-menu">
                            Kategorijos
                            <span class="fa fa-caret-down" aria-hidden="true"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="categories-menu">
                            @foreach ($mainCategories as $c)
                            <li>
                                <a href="{{ route('category.show', $c->slug) }}">
                                    {{ $c->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                @if (\Auth::check())
                    <li>
                        <a href="{{ route('messages.index', 'inbox') }}" class="nav-link profile-messages-link">
                            <span class="fa fa-envelope-o hidden-sm hidden-xs" aria-hidden="true"></span>
                            <span class="visible-sm visible-xs">Žinutės</span>
                            @if ($messages = \Auth::user()->newMessages()->count())
                                <span class="label label-danger">{{ $messages }}</span>
                            @endif
                        </a>
                    </li>
                @endif
                <li>
                    @if (\Auth::guest())
                        <div class="dropdown">
                            <a href="" class="nav-link" data-toggle="dropdown" id="user-login">
                                Prisijungti
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="user-login">
                                <li>
                                    @include('auth.dropdownLogin')
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="dropdown">
                            <a href="" class="nav-link user-menu-link" data-toggle="dropdown" id="user-menu">
                                <span class="username">{{ \Auth::user()->username }}</span>
                                <span class="fa fa-caret-down" aria-hidden="true"></span>
                            </a>
                            <ul class="dropdown-menu user-dropdown-menu" aria-labelledby="user-menu">
                                <li><a href="{{ route('profile.show', 'me') }}">{{ trans('common.profile.sections.me') }}</a></li>
                                <li><a href="{{ route('profile.edit', 'About') }}">{{ trans('common.profile.settings') }}</a></li>
                                <li class="divider" role="separator"></li>
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ trans('common.logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                </li>
            </ul>

        </nav>
    </div>
</header>
{{--
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (\Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ \Auth::user()->username }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
--}}