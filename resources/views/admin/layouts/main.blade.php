@extends('layouts.app')

@push('css')
    <link href="{{ asset('dist/css/demo.min.css')}}" rel="stylesheet"/>
@endpush

@section('body')
    <div class="wrapper d-flex flex-column" style="min-height: 100vh">
        @include('admin.layouts.partials.header')
        @include('admin.layouts.partials.navbar')
        <div class="page-wrapper">
            @yield('content')
            <x-footer/>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('dist/js/demo.min.js')}}"></script>
@endpush
