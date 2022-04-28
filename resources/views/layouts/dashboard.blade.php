<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title')</title>
  @include('_partials.css')
  @yield('css')
</head>
<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      @include('_partials.topnav')
      @include('_partials.sidebar')
      @yield('content')
    </div>
  </div>
  @include('_partials.footer')
  @include('_partials.js')
  @stack('scripts')
  </body>
</html>