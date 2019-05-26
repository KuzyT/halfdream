<!-- START NAV -->
<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ __route('index') }}">
                <img class="is-logo" src="{{ url( \Lang::has('front.logo') ? __('front.logo') : config('halfdream.front.logo')) }}" alt="{{ \Lang::has('front.title') ? __('front.title') : config('halfdream.front.title') }}">
            </a>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarMenu">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarMenu" class="navbar-menu">
            <div class="navbar-start">
                @include('modules.menu.includes.navmenu', ['items' => menu('main')])
            </div>

            <div class="navbar-end">
                @include('halfdream::general.includes.languagemenu')

                @if (\Auth::check())
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            <figure class="image is-32x32" style="margin-right:.5em;">
                                <img class="avatar" src="{{ url(Auth::user()->getAvatar()) }}">
                            </figure>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="navbar-dropdown is-right">
                            <a class="navbar-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                              <span class="icon is-small">
                                  <font-awesome-icon icon="power-off"></font-awesome-icon>
                              </span>
                                <span>{{ __('Logout') }}</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @else
                    @if (config('halfdream.registration'))
                        <div class="navbar-item">
                            <div class="buttons">
                                <a href="{{ route('register') }}" class="button is-primary">
                                    <strong>{{ __('halfdream::front.auth.register') }}</strong>
                                </a>
                                <a href="{{ route('login') }}" class="button is-light">
                                    {{ __('halfdream::front.auth.login') }}
                                </a>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>
<!-- END NAV -->
