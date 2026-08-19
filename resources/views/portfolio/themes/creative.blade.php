@extends('layouts.portfolio')

@section('head')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap');
    .creative-font { font-family: 'Space Grotesk', sans-serif; }
    .creative-clip { clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%); }
</style>
@endsection

@section('content')
<div class="creative-font bg-neutral-950 text-white">
    <header class="creative-clip bg-gradient-to-br from-fuchsia-600 via-purple-600 to-indigo-600 relative overflow-hidden">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
        <div class="max-w-5xl mx-auto px-6 py-24 md:py-36 relative">
            <div class="flex flex-col md:flex-row items-end md:items-center gap-10">
                @if ($profile->avatar)
                    <img src="{{ asset('storage/' . $profile->avatar) }}" alt="" class="w-44 h-44 rounded-2xl object-cover rotate-3 border-4 border-white/20 shadow-2xl">
                @else
                    <div class="w-44 h-44 rounded-2xl bg-white/10 flex items-center justify-center text-6xl font-bold rotate-3 border-4 border-white/20">
                        {{ strtoupper(substr($profile->full_name ?? $profile->user->name, 0, 1)) }}
                    </div>
                @endif
                <div class="flex-1">
                    <p class="text-fuchsia-200 font-medium tracking-widest uppercase text-sm mb-2">Portfolio</p>
                    <h1 class="text-5xl md:text-7xl font-bold leading-tight">{{ $profile->full_name ?? $profile->user->name }}</h1>
                    @if ($profile->title)
                        <p class="text-2xl md:text-3xl text-white/80 mt-3">{{ $profile->title }}</p>
                    @endif
                    <div class="flex flex-wrap gap-3 mt-6">
                        @foreach ($profile->user->socialLinks as $link)
                            <a href="{{ $link->url }}" target="_blank" class="bg-white/10 hover:bg-white/20 backdrop-blur border border-white/20 text-white px-5 py-2 rounded-full text-sm font-medium transition">{{ $link->platform }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-6 py-16 space-y-20">
        @if ($profile->bio)
            <section class="bg-neutral-900 border border-neutral-800 rounded-3xl p-8 md:p-12">
                <h2 class="text-3xl font-bold mb-4 text-fuchsia-400">About</h2>
                <p class="text-lg text-neutral-300 leading-relaxed whitespace-pre-line">{{ $profile->bio }}</p>
            </section>
        @endif

        @if ($profile->user->skills->isNotEmpty())
            <section>
                <h2 class="text-3xl font-bold mb-8 text-fuchsia-400">Skills</h2>
                <div class="flex flex-wrap gap-3">
                    @foreach ($profile->user->skills as $skill)
                        <div class="group relative bg-neutral-900 border border-neutral-800 rounded-2xl px-5 py-3 hover:border-fuchsia-500 transition">
                            <span class="font-semibold">{{ $skill->name }}</span>
                            <div class="absolute -bottom-1 left-5 right-5 h-1 bg-fuchsia-500 rounded-full" style="width: {{ $skill->proficiency }}%"></div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($profile->user->experiences->isNotEmpty())
            <section>
                <h2 class="text-3xl font-bold mb-8 text-fuchsia-400">Experience</h2>
                <div class="space-y-6">
                    @foreach ($profile->user->experiences as $experience)
                        <div class="bg-neutral-900 border-l-4 border-fuchsia-500 rounded-r-2xl p-6">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                                <div>
                                    <h3 class="text-xl font-bold">{{ $experience->role }}</h3>
                                    <p class="text-fuchsia-300">{{ $experience->company }}</p>
                                </div>
                                <span class="text-sm text-neutral-400 bg-neutral-800 px-3 py-1 rounded-full">
                                    {{ $experience->started_at?->format('M Y') }} -
                                    {{ $experience->is_current ? 'Present' : $experience->ended_at?->format('M Y') }}
                                </span>
                            </div>
                            <p class="text-neutral-400 mt-3 whitespace-pre-line">{{ $experience->description }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($profile->user->projects->isNotEmpty())
            <section>
                <h2 class="text-3xl font-bold mb-8 text-fuchsia-400">Selected Work</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($profile->user->projects as $project)
                        <div class="bg-neutral-900 rounded-3xl overflow-hidden border border-neutral-800 hover:border-fuchsia-500 transition group">
                            @if ($project->image)
                                <div class="overflow-hidden">
                                    <img src="{{ asset('storage/' . $project->image) }}" alt="" class="w-full h-56 object-cover group-hover:scale-105 transition duration-500">
                                </div>
                            @endif
                            <div class="p-6">
                                <h3 class="text-xl font-bold">{{ $project->title }}</h3>
                                <p class="text-neutral-400 mt-2 text-sm line-clamp-3">{{ $project->description }}</p>
                                @if ($project->technologies)
                                    <div class="flex flex-wrap gap-2 mt-4">
                                        @foreach ($project->technologies as $tech)
                                            <span class="text-xs bg-fuchsia-500/10 text-fuchsia-300 border border-fuchsia-500/20 px-2 py-1 rounded">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="flex gap-4 mt-5">
                                    @if ($project->project_url)
                                        <a href="{{ $project->project_url }}" target="_blank" class="text-sm font-bold text-fuchsia-400 hover:text-fuchsia-300">View Live</a>
                                    @endif
                                    @if ($project->github_url)
                                        <a href="{{ $project->github_url }}" target="_blank" class="text-sm font-bold text-neutral-400 hover:text-white">Source</a>
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
                <h2 class="text-3xl font-bold mb-8 text-fuchsia-400">Education</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($profile->user->education as $edu)
                        <div class="bg-neutral-900 border border-neutral-800 rounded-2xl p-6">
                            <h3 class="text-lg font-bold">{{ $edu->degree }}</h3>
                            <p class="text-fuchsia-300">{{ $edu->institution }}</p>
                            @if ($edu->field_of_study)
                                <p class="text-neutral-400 text-sm">{{ $edu->field_of_study }}</p>
                            @endif
                            <p class="text-neutral-500 text-sm mt-2">
                                {{ $edu->started_at?->format('M Y') }} @if($edu->ended_at) - {{ $edu->ended_at?->format('M Y') }}@endif
                            </p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <section class="text-center bg-gradient-to-r from-fuchsia-600 to-indigo-600 rounded-3xl p-12">
            <h2 class="text-3xl font-bold mb-3">Let's build something amazing</h2>
            <p class="text-white/80 mb-6">Open for opportunities and collaborations.</p>
            <a href="mailto:{{ $profile->email ?? $profile->user->email }}" class="inline-block bg-white text-indigo-600 hover:bg-neutral-100 px-8 py-3 rounded-full font-bold transition">Contact Me</a>
        </section>
    </main>

    <footer class="border-t border-neutral-800 py-10 text-center text-neutral-500 text-sm">
        <p>&copy; {{ date('Y') }} {{ $profile->full_name ?? $profile->user->name }}. Built with PortfolioBuilder.</p>
    </footer>
</div>
@endsection
