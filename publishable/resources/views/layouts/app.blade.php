<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ (isset($meta['title']) ? $meta['title'] . ' - ' : '') . (\Lang::has('halfdream::front.title') ? __('halfdream::front.title') : config('halfdream.front.title')) }}</title>

    <!-- Meta -->
    <meta name="description" content="{{ $meta['description'] ?? (\Lang::has('halfdream::front.description') ? __('halfdream::front.description') : config('halfdream.front.description')) }}">
    <meta name="author" content="{{ config('halfdream.front.author') }}">
    <meta name="keywords" content="{{ $meta['keywords'] ?? (\Lang::has('halfdream::front.keywords') ? __('halfdream::front.keywords') : config('halfdream.front.keywords')) }}">
    <meta name="revisit-after" content="{{ config('halfdream.front.revisit_after') }}">
    <meta name="robots" content="{{ config('halfdream.front.robots') }}">
    <meta property="og:title" content="{{ $meta['ogtitle'] ?? (\Lang::has('halfdream::front.title') ? __('halfdream::front.title') : config('halfdream.front.title')) }}" />
    <meta property="og:description" content="{{ $meta['ogdescription'] ?? (\Lang::has('halfdream::front.description') ? __('halfdream::front.description') : config('halfdream.front.description')) }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ $meta['ogimage'] ?? (url( \Lang::has('front.logo') ? __('front.logo') : config('halfdream.front.logo'))) }}" />
    <meta property="og:type" content="{{ $meta['ogtype'] ?? config('halfdream.front.og_type') }}" />
    <meta property="og:site_name" content="{{ \Lang::has('halfdream::front.title') ? __('halfdream::front.title') : config('halfdream.front.title') }}" />

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="{{ config('halfdream.theme_color') }}">
    <meta name="msapplication-TileColor" content="{{ config('halfdream.theme_color') }}">
    <meta name="theme-color" content="{{ config('halfdream.theme_color') }}">

    <!-- Styles -->
    <link href="{{ config('halfdream.mix') ? mix('css/app.css') : asset('css/app.css') }}" rel="stylesheet">

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
        @include('includes.navbar')
        <div class="container">
            <!-- START ARTICLE FEED -->
            <section class="section">
                <div class="column is-8 is-offset-2">
                    @yield('content')
                </div>
            </section>
            <!-- END ARTICLE FEED -->
        </div>
        @include('includes.footer')
    </div>

    <!-- Scripts -->
    <script src="{{ config('halfdream.mix') ? mix('js/app.js') : asset('js/app.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
