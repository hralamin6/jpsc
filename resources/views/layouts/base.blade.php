<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @hasSection('title')

        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">
    {{--        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">--}}
    <link rel="stylesheet" href="{{ asset('css/tw.css') }}">
    <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">
    @livewireStyles
    {{--        <script src="{{ asset('js/echo.js') }}"></script>--}}
    <script src="{{ url(mix('js/app.js')) }}" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
@yield('body')

@livewireScripts
{{--        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}
<script src="{{ asset('js/sa.js') }}"></script>
<x-livewire-alert::scripts />
<script src="{{ asset('js/spa.js') }}" data-turbolinks-eval="false"></script>

</body>
</html>
