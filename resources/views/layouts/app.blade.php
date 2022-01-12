<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <link rel="manifest" href="site.webmanifest">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">

        @include('layouts.stylelib')
        @include('layouts.jslib')
    </head>
    <body>
      <div class="overlaynew">

        <!-- Preloader End -->
        @include('layouts.header')

        <main>
            @yield('content')
        </main>

        @include('layouts.footer')
		 </div>
		 <script src="{{ asset('assets/js/main.js') }}"></script>
		 <script src="{{ asset('assets/js/jquery.slicknav.min.js') }}"></script>
    </body>
</html>
