<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Luna') }}</title>
    <link rel="icon" type="image/ico" href="{{ asset('images/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!--Bostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    <!---- Toastr --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <link rel="stylesheet" href= "{{ asset('css/app.css') }}">
    <link rel="stylesheet" href= "{{ asset('css/header.css') }}">
    <script src="{{ asset('js/header.js') }}"></script>
    <link rel="stylesheet" href= "{{ asset('css/input.css') }}">
    <link rel="stylesheet" href= "{{ asset('css/card.css') }}">
    <link rel="stylesheet" href= "{{ asset('css/index.css') }}">



</head>
<body class="font-sans antialiased" style="background-color: #1E1F22{{--#1A1A1B;--}}">
    @include('layouts.header')
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="d-flex justify-content-center mt-0 mt-lg-4">
            <div class="card custom-card">
                @include('layouts.input')
                @yield('content')
            </div>
        </div>
        <div style="height: 100px">
        </div>
    </div>
</body>
</html>
