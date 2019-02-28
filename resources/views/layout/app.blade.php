<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>

  <!-- HEADER -->
  <header>
    @if (Auth::check())
     @include('layout.sections.nav')
    @endif
  </header>
  <!-- HEADER END -->

  <!-- MAIN  -->
  <div class="main" id="app">
    <div class="container">
      @if (session('message'))
        @include('layout.common.messages')
      @endif
      @yield('content')
    </div>
  </div>
  <script src="{{ asset('js/app.js')}}"></script>
</body>
</html>
