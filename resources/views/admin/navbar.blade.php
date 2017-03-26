<nav class="navbar navbar-inverse navbar-fixed-top navbar-admin">
    <div class="navbar-header">
        <button type="button" class="collapsed navbar-toggle" data-toggle="collapse" data-target="#bs-admin-navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">{{ trans('admin.control_management_system') }}</a>
    </div>
    <div id="bs-admin-navbar-collapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <div class="btn-group">
                    <a href="{{ route('listings.index') }}">
                        <span class="fa fa-commenting" aria-hidden="true"></span>
                        {{ trans('admin.listings.index') }}
                    </a>
                    <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle">
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('reviews.index') }}">Neaktyvuoti atsiliepimai</a></li>
                        <li><a href="{{ route('listings.create') }}">{{ trans('admin.listings.create') }}</a></li>
                        <li><a href="{{ route('listings.index') }}">{{ trans('admin.listings.index') }}</a></li>
                        <li><a href="{{ route('attributes.index') }}">{{ trans('admin.attributes.index') }}</a></li>
                        <li><a href="{{ route('attributes.create') }}">{{ trans('admin.attributes.create') }}</a></li>
                    </ul>
                </div>
            </li>

            <li class="dropdown">
                <div class="btn-group">
                    <a href="{{ route('categories.index') }}">
                        <span class="fa fa-list" aria-hidden="true"></span>
                        {{ trans('admin.categories.index') }}
                    </a>
                    <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle">
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('categories.create') }}">{{ trans('admin.categories.create') }}</a></li>
                        <li><a href="{{ route('categories.index') }}">{{ trans('admin.categories.index') }}</a></li>
                    </ul>
                </div>
            </li>

            <li class="dropdown">
                <div class="btn-group">
                    <a href="{{ route('brands.index') }}">
                        <span class="fa fa-trophy" aria-hidden="true"></span>
                        {{ trans('admin.brands.index') }}
                    </a>
                    <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle">
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('brands.create') }}">{{ trans('admin.brands.create') }}</a></li>
                        <li><a href="{{ route('brands.index') }}">{{ trans('admin.brands.index') }}</a></li>
                    </ul>
                </div>
            </li>

            <li class="dropdown">
                <div class="btn-group">
                    <a href="{{ route('pages.index') }}">
                        <span class="fa fa-file-o" aria-hidden="true"></span>
                        {{ trans('admin.pages.index') }}
                    </a>
                    <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle">
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('pages.create') }}">{{ trans('admin.pages.create') }}</a></li>
                        <li><a href="{{ route('pages.index') }}">{{ trans('admin.pages.index') }}</a></li>
                    </ul>
                </div>
            </li>

            <li class="dropdown">
                <div class="btn-group">
                    <a href="{{ route('users.index') }}">
                        <span class="fa fa-users" aria-hidden="true"></span>
                        {{ trans('admin.users.index') }}
                    </a>
                    <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle">
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('users.create') }}">{{ trans('admin.users.create') }}</a></li>
                        <li><a href="{{ route('users.index') }}">{{ trans('admin.users.index') }}</a></li>
                    </ul>
                </div>
            </li>

            <li class="dropdown">
                <div class="btn-group">
                    <a href="{{ route('countries.index') }}">
                        <span class="fa fa-globe" aria-hidden="true"></span>
                        {{ trans('admin.countries.index') }}
                    </a>
                    <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle">
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('countries.create') }}">{{ trans('admin.countries.create') }}</a></li>
                        <li><a href="{{ route('countries.index') }}">{{ trans('admin.countries.index') }}</a></li>
                    </ul>
                </div>
            </li>

            <li>
                <a href="{{ route('censors.index') }}">
                    <span class="fa fa-ban" aria-hidden="true"></span>
                    {{ trans('admin.censors.index') }}
                </a>
            </li>
        </ul>
    </div>
</nav>
