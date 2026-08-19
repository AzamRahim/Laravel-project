@extends('layouts.app')

@section('title', 'Portfolio Builder - Create Your Professional Portfolio')

@section('content')
<div class="bg-white">
    <section class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28 text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-slate-900 tracking-tight">
                Build your portfolio in minutes
            </h1>
            <p class="mt-6 text-lg md:text-xl text-slate-600 max-w-2xl mx-auto">
                Create a stunning professional portfolio, showcase your projects, skills, and experience, and switch between beautiful designs with one click.
            </p>
            <div class="mt-10 flex justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl font-semibold text-lg transition">Get Started Free</a>
                <a href="#features" class="bg-white border border-slate-300 hover:border-slate-400 text-slate-700 px-8 py-3 rounded-xl font-semibold text-lg transition">Learn More</a>
            </div>
        </div>
    </section>

    <section id="features" class="bg-slate-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-slate-900 mb-12">Everything you need</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Profile Management</h3>
                    <p class="text-slate-600 mt-2">Add your bio, contact info, avatar, and resume link in one place.</p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Portfolio Sections</h3>
                    <p class="text-slate-600 mt-2">Showcase projects, skills, experience, education, and social links.</p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">3 Beautiful Designs</h3>
                    <p class="text-slate-600 mt-2">Switch between Modern, Creative, and Minimal themes instantly.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-slate-900 mb-6">Ready to build your portfolio?</h2>
            <p class="text-slate-600 mb-8">Join today and get your personal portfolio online in minutes.</p>
            <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl font-semibold text-lg transition">Create Your Portfolio</a>
        </div>
    </section>
</div>
@endsection
