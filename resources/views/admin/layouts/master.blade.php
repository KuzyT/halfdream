<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $meta['title'] ?? config('halfdream.admin.title') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="{{ config('halfdream.theme_color') }}">
    <meta name="msapplication-TileColor" content="{{ config('halfdream.theme_color') }}">
    <meta name="theme-color" content="{{ config('halfdream.theme_color') }}">

    <!-- Styles -->
    <link href="{{ config('halfdream.mix') ? mix('css/admin.css') : asset('css/admin.css') }}" rel="stylesheet">

    @stack('css')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            ]) !!};
    </script>
</head>
<body>
<div id="app">
    <header class="hero is-light">
        <div class="hero-head">
            @include('halfdream::admin.includes.navbar')
        </div>
    </header>
    <div class="wrapper">
        <div class="columns">
            <aside class="column is-2 aside">
                @include('halfdream::admin.includes.menu')
            </aside>
            <main class="column main">
                <nav class="breadcrumb is-small" aria-label="breadcrumbs">
                    <ul>
                        <li>Home</li>
                    </ul>
                </nav>
                <div class="level">
                    <div class="level-left">
                        <div class="level-item">
                            <div class="title hast-text-primary">
                                @yield('title')
                            </div>
                        </div>
                    </div>
                    <div class="level-right">
                        <div class="level-item">
                            @yield('actions')
                        </div>
                    </div>
                </div>
                @yield('content')
            </main>
        </div>
    </div>
</div>

<script src="{{ config('halfdream.mix') ? mix('js/admin.js') : asset('js/admin.js') }}"></script>
@include('halfdream::admin.includes.messages')
{!! Halfdream::script() !!}
@stack('scripts')
</body>
</html>
