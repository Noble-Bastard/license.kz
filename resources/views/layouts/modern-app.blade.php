@extends('layouts.app')

@section('title')
    @yield('title')
@endsection

@section('meta-description')
    @yield('meta-description')
@endsection

@section('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('new/css/fonts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('new/css/app.css') }}" rel="stylesheet" type="text/css">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @yield('head')
@endsection

@section('content')
    @yield('content')
@endsection

@section('js')
    @yield('js')
    @stack('scripts')
@endsection
