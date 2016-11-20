<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <a href="/" class="logo">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="{{ config('app.name') }}">
                </a>
            </div>
            <div class="col-md-3 col-sm-4 hidden-xs">
                <div class="search">
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Ieškokite atsiliepimų">
                            <div class="input-group-btn">
                                <button class="btn" type="button">
                                    <span class="fa fa-search" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3 col-sm-4">
                <ul class="nav navbar-nav">
                    <li>
                        <div class="dropdown">
                            <a href="" class="nav-link" data-toggle="dropdown" id="categories-menu">
                                Kategorijos
                                <span class="fa fa-caret-down" aria-hidden="true"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="categories-menu">
                                <li><a href="#">Actionįčįčęš</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        @if (\Auth::guest())
                            <div class="dropdown">
                                <a href="" class="nav-link" data-toggle="dropdown" id="user-login">
                                    Prisijungti
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="user-login">
                                    <li>
                                        <form action="" class="user-login-form">
                                            <div class="form-group">
                                                <label for="email" class="sr-only">{{ trans('common.user.email') }}</label>
                                                <input type="email" class="form-control" id="email" placeholder="{{ trans('common.user.email') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="sr-only">{{ trans('common.user.password') }}</label>
                                                <input type="password" class="form-control" id="password" placeholder="{{ trans('common.user.password') }}">
                                            </div>
                                            <div class="form-group">
                                                <a href="" class="password-reset">Pamiršote slaptažodį?</a>
                                            </div>
                                            <div class="form-group login-button">
                                                <button class="btn btn-first btn-lg">Prisijungti</button>
                                            </div>
                                            <div class="form-group">
                                                Neturi anketos?
                                                <a href="#">Užsiregistruokite</a>
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <div class="dropdown">
                                <a href="" class="nav-link" data-toggle="dropdown" id="user-menu">
                                    {{ \Auth::user()->username }}
                                    <span class="fa fa-caret-down" aria-hidden="true"></span>
                                </a>
                                <ul class="dropdown-menu user-dropdown-menu" aria-labelledby="user-menu">
                                    <li><a href="">{{ trans('common.profile.settings') }}</a></li>
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
            </div>
            <div class="col-md-3 col-sm-4">
                <div class="create-review">
                    <a href="" class="btn btn-first btn-lg">Parašykite atsiliepimą</a>
                </div>
            </div>
        </div>
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