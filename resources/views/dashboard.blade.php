@extends('layouts.app')

@section('title', 'Dashboard - Portfolio Builder')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Dashboard</h1>
            <p class="text-slate-600 mt-1">Manage your portfolio content and design.</p>
        </div>
        <a href="{{ route('portfolio.public', $user->profile->slug) }}" target="_blank"
            class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg font-medium transition">
            View Public Portfolio
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
            </svg>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <aside class="lg:col-span-1">
            <nav class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 sticky top-4">
                <ul class="space-y-1">
                    <li><a href="#profile" class="block px-3 py-2 rounded-lg hover:bg-slate-100 text-slate-700 font-medium">Profile & Design</a></li>
                    <li><a href="#projects" class="block px-3 py-2 rounded-lg hover:bg-slate-100 text-slate-700 font-medium">Projects</a></li>
                    <li><a href="#skills" class="block px-3 py-2 rounded-lg hover:bg-slate-100 text-slate-700 font-medium">Skills</a></li>
                    <li><a href="#experience" class="block px-3 py-2 rounded-lg hover:bg-slate-100 text-slate-700 font-medium">Experience</a></li>
                    <li><a href="#education" class="block px-3 py-2 rounded-lg hover:bg-slate-100 text-slate-700 font-medium">Education</a></li>
                    <li><a href="#social" class="block px-3 py-2 rounded-lg hover:bg-slate-100 text-slate-700 font-medium">Social Links</a></li>
                </ul>
            </nav>
        </aside>

        <div class="lg:col-span-3 space-y-8">
            @include('dashboard.partials.profile')
            @include('dashboard.partials.projects')
            @include('dashboard.partials.skills')
            @include('dashboard.partials.experience')
            @include('dashboard.partials.education')
            @include('dashboard.partials.social')
        </div>
    </div>
</div>
@endsection
