@extends('layouts.app')
@push('css')
    <link href="{{ asset('dist/css/demo.min.css')}}" rel="stylesheet"/>
@endpush
@section('body')
    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark"><img src="{{ asset('static/logo.svg')}}" height="36" alt="Micro Pesa"></a>
            </div>
            @yield('content')
            <x-copyright/>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('dist/js/demo.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('body').addClass("border-top-wide border-primary d-flex flex-column");
        })
    </script>
@endpush
