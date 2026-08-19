@extends('layouts.portfolio')

@section('head')
<style>
    .modern-gradient { background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); }
</style>
@endsection

@section('content')
<div class="font-sans text-slate-800 bg-white">
    <header class="modern-gradient text-white">
        <div class="max-w-5xl mx-auto px-6 py-20 md:py-28">
            <div class="flex flex-col md:flex-row items-center gap-8">
                @if ($profile->avatar)
                    <img src="{{ asset('storage/' . $profile->avatar) }}" alt="" class="w-40 h-40 rounded-full object-cover border-4 border-white/30 shadow-xl">
                @else
                    <div class="w-40 h-40 rounded-full bg-white/20 flex items-center justify-center text-5xl font-bold">
                        {{ strtoupper(substr($profile->full_name ?? $profile->user->name, 0, 1)) }}
                    </div>
                @endif
                <div class="text-center md:text-left">
                    <h1 class="text-4xl md:text-5xl font-bold">{{ $profile->full_name ?? $profile->user->name }}</h1>
                    @if ($profile->title)
                        <p class="text-xl md:text-2xl text-indigo-100 mt-2">{{ $profile->title }}</p>
                    @endif
                    @if ($profile->location)
                        <p class="text-indigo-100 mt-1 flex items-center justify-center md:justify-start gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $profile->location }}
                        </p>
                    @endif
                    <div class="flex flex-wrap justify-center md:justify-start gap-3 mt-5">
                        @foreach ($profile->user->socialLinks as $link)
                            <a href="{{ $link->url }}" target="_blank" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-full text-sm font-medium transition">{{ $link->platform }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-6 py-12 space-y-16">
        @if ($profile->bio)
            <section>
                <h2 class="text-2xl font-bold text-slate-900 mb-4">About Me</h2>
                <p class="text-lg text-slate-600 leading-relaxed whitespace-pre-line">{{ $profile->bio }}</p>
            </section>
        @endif

        @if ($profile->user->skills->isNotEmpty())
            <section>
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Skills</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach ($profile->user->skills as $skill)
                        <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold text-slate-900">{{ $skill->name }}</span>
                                <span class="text-sm text-slate-500">{{ $skill->proficiency }}%</span>
                            </div>
                            <div class="w-full bg-slate-200 rounded-full h-2.5">
                                <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $skill->proficiency }}%"></div>
                            </div>
                            @if ($skill->category)
                                <p class="text-xs text-slate-500 mt-2">{{ $skill->category }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($profile->user->experiences->isNotEmpty())
            <section>
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Experience</h2>
                <div class="relative border-l-2 border-indigo-100 ml-3 space-y-8">
                    @foreach ($profile->user->experiences as $experience)
                        <div class="ml-6 relative">
                            <span class="absolute -left-[31px] top-1.5 w-4 h-4 bg-indigo-600 rounded-full border-4 border-white shadow"></span>
                            <h3 class="text-lg font-bold text-slate-900">{{ $experience->role }}</h3>
                            <p class="text-indigo-600 font-medium">{{ $experience->company }}</p>
                            <p class="text-sm text-slate-500 mt-1">
                                {{ $experience->started_at?->format('M Y') }} -
                                {{ $experience->is_current ? 'Present' : $experience->ended_at?->format('M Y') }}
                            </p>
                            <p class="text-slate-600 mt-2 whitespace-pre-line">{{ $experience->description }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($profile->user->projects->isNotEmpty())
            <section>
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Projects</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($profile->user->projects as $project)
                        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition">
                            @if ($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" alt="" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-slate-900">{{ $project->title }}</h3>
                                <p class="text-slate-600 text-sm mt-2 line-clamp-3">{{ $project->description }}</p>
                                @if ($project->technologies)
                                    <div class="flex flex-wrap gap-2 mt-3">
                                        @foreach ($project->technologies as $tech)
                                            <span class="text-xs bg-indigo-50 text-indigo-700 px-2 py-1 rounded">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="flex gap-4 mt-4">
                                    @if ($project->project_url)
                                        <a href="{{ $project->project_url }}" target="_blank" class="text-sm font-medium text-indigo-600 hover:underline">Live Demo</a>
                                    @endif
                                    @if ($project->github_url)
                                        <a href="{{ $project->github_url }}" target="_blank" class="text-sm font-medium text-slate-600 hover:underline">Source Code</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($profile->user->education->isNotEmpty())
            <section>
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Education</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @foreach ($profile->user->education as $edu)
                        <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                            <h3 class="font-bold text-slate-900">{{ $edu->degree }}</h3>
                            <p class="text-indigo-600 font-medium">{{ $edu->institution }}</p>
                            @if ($edu->field_of_study)
                                <p class="text-sm text-slate-600">{{ $edu->field_of_study }}</p>
                            @endif
                            <p class="text-sm text-slate-500 mt-1">
                                {{ $edu->started_at?->format('M Y') }} @if($edu->ended_at) - {{ $edu->ended_at?->format('M Y') }}@endif
                            </p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <section class="text-center pt-8 border-t border-slate-200">
            <h2 class="text-2xl font-bold text-slate-900 mb-3">Get In Touch</h2>
            <p class="text-slate-600 mb-5">Interested in working together? Reach out via email.</p>
            <a href="mailto:{{ $profile->email ?? $profile->user->email }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition">
                Contact Me
            </a>
        </section>
    </main>

    <footer class="bg-slate-900 text-slate-400 py-8 text-center text-sm">
        <p>&copy; {{ date('Y') }} {{ $profile->full_name ?? $profile->user->name }}. Built with PortfolioBuilder.</p>
    </footer>
</div>
@endsection
