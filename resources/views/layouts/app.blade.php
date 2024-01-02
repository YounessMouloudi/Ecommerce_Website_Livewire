<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <meta name="meta_description" content="@yield('meta_description')">
    <meta name="meta_keyword" content="@yield('meta_keyword')">
    <meta name="meta_author" content="Fit Shop">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>


    <link rel="stylesheet" href="{{asset('style/home.css')}}">
    
    {{-- exzoom product image --}}
    <link rel="stylesheet" href="{{asset('exzoom/jquery.exzoom.css')}}">

    {{-- carousel trending product --}}
    <link rel="stylesheet" href="{{asset('style/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('style/owl.theme.default.min.css')}}">
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    @livewireStyles
</head>
<body>
    <div id="app">
        
        @include('layouts.nav&side.navbarFrontend')

        <main>
            @yield('content')
        </main>

        @include('layouts.nav&side.footer')
    </div>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <script src="{{asset("js/owl.carousel.min.js")}}"></script>
    
    <script src="{{asset("exzoom/jquery.exzoom.js")}}"></script>
    
    @yield('script')
    
    <script>
        window.addEventListener('message', event => {
            // console.log(event);
            if(event.detail){
                alertify.set('notifier','position', 'top-right');
                alertify.notify(event.detail[0].text,event.detail[0].type,2);
            }
        });
        // window.addEventListener('livewire:initialized', () => {
        //     Livewire.on('message', (event) => {
        //         console.log(event);
        //         alertify.set('notifier','position', 'top-right');
        //         alertify.success(event[0].text);
        //     });
        // });
    </script>
    
    @livewireScripts

    @stack('scripts')
</body>
</html>
