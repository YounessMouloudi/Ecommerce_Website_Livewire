<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('admin/vendors/base/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />    
    
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <style>
        .form-control{
            border: 1px solid #ddd;
        }
        .sidebar .nav .nav-item.active {
            background-color: #e9e9e9
        }
        .sidebar .nav .nav-item .nav-link {
            transition-duration: 0.25s
        }
        /* .sidebar .nav.sub-menu .nav-item .nav-link .active{
            background-color: #e9e9e9;
        } */
    </style>
    @livewireStyles
</head>
<body>
    <div class="container-scroller">
        
        @include('layouts.nav&side.navbar')
        
        <div class="container-fluid page-body-wrapper">

            @include('layouts.nav&side.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </div>

        </div>
    </div>

    <script src="{{ asset('admin/vendors/base/vendor.bundle.base.js')}}"></script>
    
    <script src="{{ asset('admin/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
    
    <script src="{{ asset('admin/js/off-canvas.js')}}"></script>
    <script src="{{ asset('admin/js/hoverable-collapse.js')}}"></script>
    <script src="{{ asset('admin/js/template.js')}}"></script>
    
    <script src="{{ asset('admin/js/dashboard.js')}}"></script>
    <script src="{{ asset('admin/js/data-table.js')}}"></script>
    <script src="{{ asset('admin/js/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('admin/js/dataTables.bootstrap4.js')}}"></script>

    @yield('scripts')

    @livewireScripts
    {{-- @stack('script') --}}
</body>
</html>
