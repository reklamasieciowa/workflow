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
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
      <!-- Bootstrap core CSS -->
      <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
      <!-- Material Design Bootstrap -->
      <link href="{{asset('css/mdb.min.css')}}" rel="stylesheet">

      <link href="{{ asset('css/app.css') }}" rel="stylesheet">

      @yield('css')
</head>
<body>
    <div id="app">
        <header id="header">
            @include('front._partials._nav')
        </header>
        
        @include('front._partials._flash')
        
        <main id="main" class="my-5">
            @yield('content')
        </main>

        <footer class="page-footer font-small default-color">

          <!-- Copyright -->
          <div class="footer-copyright text-center py-3 text-white">
            {{ config('app.name', 'Laravel') }} © @php echo date('Y'); @endphp 
          </div>
          <!-- Copyright -->

        </footer>
    </div>

  <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/mdb.min.js')}}"></script>

  @yield('footer_js')
</body>
</html>
