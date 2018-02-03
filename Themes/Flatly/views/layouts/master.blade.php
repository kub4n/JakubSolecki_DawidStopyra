<!DOCTYPE html>
<html>
<head lang="{{ LaravelLocalization::setLocale() }}">
    <meta charset="UTF-8">
    @section('meta')
        <meta name="description" content="@setting('core::site-description')" />
    @show
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @section('title')@setting('core::site-name')@show
    </title>
    <link rel="shortcut icon" href="{{ Theme::url('favicon.ico') }}">

    {!! Theme::style('css/main.css') !!}
    @stack('css-stack')
</head>
<body>


@include('partials.navigation')

    @yield('content')
@include('partials.footer')

{!! Theme::script('js/all.js') !!}
@yield('scripts')

<?php if (Setting::has('core::analytics-script')): ?>
    {!! Setting::get('core::analytics-script') !!}
<?php endif; ?>
@stack('js-stack')
</body>
</html>