<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard 2</title>
    <meta name="turbolinks-cache-control" content="no-preview">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <link rel="stylesheet" href="{{ secure_asset('backend') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ secure_asset('backend') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="{{ secure_asset('backend') }}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ secure_asset('backend') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @stack('css')
    @livewireStyles

    <script src="{{ asset('backend') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="{{ asset('backend') }}/dist/js/adminlte.js"></script>
    <script src="{{ asset('backend') }}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="{{ asset('backend') }}/plugins/raphael/raphael.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/chart.js/Chart.min.js"></script>
    <script src="{{ asset('backend') }}/dist/js/demo.js"></script>
    <script src="{{ asset('backend') }}/dist/js/pages/dashboard2.js"></script>
    <script src="{{ asset('backend') }}/plugins/sweetalert2/sweetalert2.min.js" ></script>

    <script src="{{ secure_asset('backend') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ secure_asset('backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ secure_asset('backend') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="{{ secure_asset('backend') }}/dist/js/adminlte.js"></script>
    <script src="{{ secure_asset('backend') }}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="{{ secure_asset('backend') }}/plugins/raphael/raphael.min.js"></script>
    <script src="{{ secure_asset('backend') }}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="{{ secure_asset('backend') }}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <script src="{{ secure_asset('backend') }}/plugins/chart.js/Chart.min.js"></script>
    <script src="{{ secure_asset('backend') }}/dist/js/demo.js"></script>
    <script src="{{ secure_asset('backend') }}/dist/js/pages/dashboard2.js"></script>
    <script src="{{ secure_asset('backend') }}/plugins/sweetalert2/sweetalert2.min.js" ></script>
    <script src="{{ mix('js/app.js') }}" data-turbolinks-track="reload"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
{{--    <div class="preloader flex-column justify-content-center align-items-center">--}}
{{--        <img class="animation__wobble" src="{{ asset('backend') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">--}}
{{--    </div>--}}
@include('layouts.app.navbar')
@include('layouts.app.sidebar')
{{ $slot }}
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.1.0
        </div>
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
