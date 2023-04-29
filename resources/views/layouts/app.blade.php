<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>@php echo env('APP_NAME') @endphp @yield('site-tile')</title>
    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-flags.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-payments.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-vendors.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css')}}">
    <link href="{{ asset('css/app.css')}}" rel="stylesheet"/>
    <link rel="shortcut icon" href="{{ asset('images/favicon.png')}}"/>
    @stack('css')
    @livewireStyles
</head>
<body>

@yield('body')
<!-- Libs JS -->
<!-- Tabler Core -->
@livewireScripts
<script src="{{ asset('js/app.js')}}"></script>
<script src="{{ asset('vendors/select2/select2.min.js')}}"></script>
<script>
    $('.selector').select2({
    });
    class Notify {
        static success(message,title="Success",icon='far fa-check-circle',timeout=15000){
            iziToast.success({
                title: title,
                message: message,
                position: 'topRight',
                timeout: timeout,
                icon:icon
            });
        }

        static warning(message,title="Warning",icon='fas fa-exclamation-circle',timeout=15000){
            iziToast.warning({
                title: title,
                message: message,
                position: 'topRight',
                timeout: timeout,
                icon:icon
            });
        }

        static error(message,title="Error",icon='far fa-times-circle',timeout=15000){
            iziToast.error({
                title: title,
                message: message,
                position: 'topRight',
                timeout: timeout,
                icon:icon
            });
        }
    }
</script>
<script src="{{ asset('dist/js/tabler.min.js')}}"></script>
<script src="{{ asset('vendors/select2/select2.min.js')}}"></script>
@stack('js')
@if(session('success'))
    <script>
        Notify.success('{{session('success')}}');
    </script>
@endif

@if(session('error'))
    <script>
        Notify.error('{{session('error')}}');
    </script>
@endif
</body>
</html>
