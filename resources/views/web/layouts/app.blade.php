<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', config('app.name')) - Laravel</title>
  <link rel="shortcut icon" href="/favicon.png">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  @yield('script')

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  @yield('type')
</head>

<body>
<div id="app">
  @include('web.layouts._header')

  <main class="py-4">
    @include('web.layouts._message')
    @yield('content')
  </main>

  @include('web.layouts._footer')
</div>

</body>
</html>