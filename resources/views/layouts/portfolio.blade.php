<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $profile->full_name ?? $profile->user->name }} - Portfolio</title>
    <meta name="description" content="{{ Str::limit($profile->bio, 160) }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('head')
</head>
<body class="antialiased">
    @auth
        @if (auth()->id() === $profile->user_id)
            <div class="bg-indigo-600 text-white text-sm py-2 px-4 text-center">
                You are viewing your public portfolio.
                <a href="{{ route('dashboard') }}" class="underline font-medium ml-1">Back to Dashboard</a>
            </div>
        @endif
    @endauth

    @yield('content')
</body>
</html>
