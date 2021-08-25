<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Home Page') - {{config('app.name')}}</title>
    <meta name="description" content="@yield('description', 'This is site Description') - {{config('app.name')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="turbolinks-cache-control" content="no-preview">
    {{--    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" type="text/css" data-turbolinks-track="reload">--}}
    {{--    <script src="{{ mix('js/app.js') }}" data-turbolinks-track="reload"></script>--}}

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="@yield('title', 'Home Page') - {{config('app.name')}}" />
    <meta property="og:description" content="@yield('description', 'This is site Description') - {{config('app.name')}}" />
    <meta property="og:url" content="@yield('url', config('app.url'))" />
    <meta property="og:site_name" content="{{config('app.name')}}" />
    <meta property="og:image" content="@yield('image', config('app.url').'/frontend/images/jpsc.jpg')" />
    <meta property="og:image:secure_url" content="@yield('image', config('app.url').'/frontend/images/jpsc.jpg')" />
    <meta property="og:image:width" content="1536" />
    <meta property="og:image:height" content="1024" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="@yield('description', 'This is site Description') - {{config('app.name')}}" />
    <meta name="twitter:title" content="@yield('title', 'Home Page') - {{config('app.name')}}" />
    <meta name="twitter:image" content="@yield('image', config('app.url').'/frontend/images/jpsc.jpg')" />    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Bootstrap CSS-->
    <link rel="shortcut icon" href="{{asset('frontend')}}/images/5.jpg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Satisfy&amp;display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
{{--    <link rel="stylesheet" href="{{asset('frontend')}}/vendor/bootstrap/css/bootstrap.min.css">--}}
{{--    <link rel="stylesheet" href="{{asset('frontend')}}/vendor/lightbox2/css/lightbox.min.css">--}}
{{--    <link rel="stylesheet" href="{{asset('frontend')}}/css/style.blue.css" id="theme-stylesheet">--}}
{{--    <link rel="stylesheet" href="{{asset('frontend')}}/css/custom.css">--}}

    <link rel="stylesheet" href="{{secure_asset('frontend')}}/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{secure_asset('frontend')}}/vendor/lightbox2/css/lightbox.min.css">
    <link rel="stylesheet" href="{{secure_asset('frontend')}}/css/style.blue.css" id="theme-stylesheet">
    <link rel="stylesheet" href="{{secure_asset('frontend')}}/css/custom.css">
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">

{{$slot}}

{{--<script src="{{asset('frontend')}}/vendor/jquery/jquery.min.js"></script>--}}
{{--<script src="{{asset('frontend')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>--}}
{{--<script src="{{asset('frontend')}}/vendor/lightbox2/js/lightbox.min.js"></script>--}}
{{--<script src="{{asset('frontend')}}/js/front.js"></script>--}}

<script src="{{secure_asset('frontend')}}/vendor/jquery/jquery.min.js"></script>
<script src="{{secure_asset('frontend')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{secure_asset('frontend')}}/vendor/lightbox2/js/lightbox.min.js"></script>
<script src="{{secure_asset('frontend')}}/js/front.js"></script>
@livewireScripts
</body>
</html>
