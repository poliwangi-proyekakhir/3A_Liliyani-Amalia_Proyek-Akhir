<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @yield('title')

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Fonts -->
  <link rel="icon" href="{{ asset('icons/ic_rs.png') }}" type="image/x-icon">
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @stack('resources')

  <style>
    .filter-table {
      border-collapse: collapse;
    }

    .filter-table {
      border: thin solid grey;
    }

    .filter-table thead {
      border-bottom: thin solid grey;
    }

    .filter-table th,
    .filter-table td {
      padding: 0.25em 0.5em;
    }

    .filter-table th {
      background: #CCC;
    }

    .filter-table tbody tr:nth-child(even) {
      background: #EEE;
    }

    .hidden-row {
      display: none;
    }
  </style>

</head>

<body>
  @include('sweetalert::alert')

  <div class="app">
    @include('layouts.sidebar')

    <div class="main-content">
      @include('layouts.header')

      <div class="main">
        @yield('content')
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  @stack('script')
</body>

</html>
