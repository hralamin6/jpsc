<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard') - {{config('app.name')}}</title>
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
    <meta name="twitter:image" content="@yield('image', config('app.url').'/frontend/images/jpsc.jpg')" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/fontawesome-free/css/all.min.css">
{{--    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">--}}
{{--    <link rel="stylesheet" href="{{ asset('backend') }}/dist/css/adminlte.min.css">--}}
{{--    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">--}}

    <link rel="stylesheet" href="{{ secure_asset('backend') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ secure_asset('backend') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="{{ secure_asset('backend') }}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ secure_asset('backend') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"  />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @stack('css')
    @livewireStyles

{{--    <script src="{{ asset('backend') }}/plugins/jquery/jquery.min.js"></script>--}}
{{--    <script src="{{ asset('backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>--}}
{{--    <script src="{{ asset('backend') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>--}}
{{--    <script src="{{ asset('backend') }}/dist/js/adminlte.js"></script>--}}
{{--    <script src="{{ asset('backend') }}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>--}}
{{--    <script src="{{ asset('backend') }}/plugins/raphael/raphael.min.js"></script>--}}
{{--    <script src="{{ asset('backend') }}/plugins/jquery-mapael/jquery.mapael.min.js"></script>--}}
{{--    <script src="{{ asset('backend') }}/plugins/jquery-mapael/maps/usa_states.min.js"></script>--}}
{{--    <script src="{{ asset('backend') }}/plugins/chart.js/Chart.min.js"></script>--}}
{{--    <script src="{{ asset('backend') }}/dist/js/demo.js"></script>--}}
{{--    <script src="{{ asset('backend') }}/dist/js/pages/dashboard2.js"></script>--}}
{{--    <script src="{{ asset('backend') }}/plugins/sweetalert2/sweetalert2.min.js" ></script>--}}

    <script src="{{ secure_asset('backend') }}/plugins/jquery/jquery.min.js" defer></script>
    <script src="{{ secure_asset('backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js" defer></script>
    <script src="{{ secure_asset('backend') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js" defer></script>
    <script src="{{ secure_asset('backend') }}/plugins/jquery-mousewheel/jquery.mousewheel.js" defer></script>
    <script src="{{ secure_asset('backend') }}/plugins/raphael/raphael.min.js" defer></script>
    <script src="{{ secure_asset('backend') }}/plugins/jquery-mapael/jquery.mapael.min.js" defer></script>
    <script src="{{ secure_asset('backend') }}/plugins/jquery-mapael/maps/usa_states.min.js" defer></script>
    <script src="{{ secure_asset('backend') }}/plugins/chart.js/Chart.min.js" defer></script>
    <script src="{{ secure_asset('backend') }}/plugins/sweetalert2/sweetalert2.min.js"  defer></script>
    <script src="{{ secure_asset('backend') }}/dist/js/demo.js" defer></script>
    <script src="{{ secure_asset('backend') }}/dist/js/adminlte.js" defer></script>
    <script src="{{ secure_asset('backend') }}/dist/js/pages/dashboard2.js" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js" ></script>
    <script src="{{ mix('js/app.js') }}" data-turbolinks-track="reload"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>
<body id="bodyId" class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed @if (Session::has('nightMode')) dark-mode @endif @if (Session::has('sidebarCollapse')) sidebar-collapse @endif">
<div class="wrapper">
{{--    <div class="preloader flex-column justify-content-center align-items-center">--}}
{{--        <img class="animation__wobble" src="{{ asset('backend') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width  ="60">--}}
{{--    </div>--}}
{{--@include('layouts.app.navbar')--}}
{{--@include('layouts.app.sidebar')--}}
    @livewire('header-component')
    @livewire('sidebar-component')
{{ $slot }}
    <footer class="main-footer">
        <strong>Copyright &copy; {{date('Y')}} <a href="{{config('app.url')}}">{{config('app.name')}}</a>.</strong>
        All rights reserved.
    </footer>
</div>

<script>
    window.addEventListener('show-form', event => {
        $('#form').modal(event.detail.action);
    })

    window.addEventListener('show-delete-confirmation', event => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, do  it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('deleteConfirmed')
            }
        })
    })

    window.addEventListener('deleted', event => {
        Swal.fire(
            'Deleted!',
            event.detail.message,
            'success'
        )
    })
</script>
@stack('js')

<x-livewire-alert::scripts />
@livewireScripts
<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false"></script>

</body>
</html>
