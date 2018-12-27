<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
   <!--  <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Font Awesome -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- Bootstrap core CSS -->
      <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
      <!-- Material Design Bootstrap -->
      <link href="{{asset('css/mdb.min.css')}}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header id="header">
            @yield('nav')
        </header>

        <main id="main">
            @yield('content')
        </main>

        <footer id="footer">
            @yield('footer')
        </footer>
    </div>

  <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/mdb.min.js')}}"></script>
</body>
</html>
