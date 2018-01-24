<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Budget !') }}</title>
<link rel="stylesheet" href="https://unpkg.com/bulmaswatch/flatly/bulmaswatch.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>

    <!-- Styles -->
</head>
<body>
    <div id="app">
        
        @include('layouts.navbar')
        @yield('content')
    </div>

    <!-- Scripts -->

    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="{{ asset('js/master.js') }}"></script>
</body>
</html>
