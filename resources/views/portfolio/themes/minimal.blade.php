@extends('layouts.portfolio')

@section('head')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@600;700&display=swap');
    .minimal-serif { font-family: 'Playfair Display', serif; }
    .minimal-sans { font-family: 'Inter', sans-serif; }
</style>
@endsection

@section('content')
<div class="minimal-sans bg-stone-50 text-stone-800">
    <div class="max-w-3xl mx-auto px-6 py-16 md:py-24">
        <header class="mb-16">
            @if ($profile->avatar)
                <img src="{{ asset('storage/' . $profile->avatar) }}" alt="" class="w-24 h-24 rounded-full object-cover mb-6 grayscale hover:grayscale-0 transition">
            @endif
            <h1 class="minimal-serif text-5xl md:text-6xl font-bold text-stone-900 mb-3">{{ $profile->full_name ?? $profile->user->name }}</h1>
            @if ($profile->title)
                <p class="text-lg text-stone-500">{{ $profile->title }}</p>
            @endif
            @if ($profile->location)
                <p class="text-sm text-stone-400 mt-1">{{ $profile->location }}</p>
            @endif
            <div class="flex flex-wrap gap-4 mt-6 text-sm">
                @foreach ($profile->user->socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank" class="text-stone-500 hover:text-stone-900 underline decoration-stone-300 underline-offset-4 transition">{{ $link->platform }}</a>
                @endforeach
            </div>
        </header>

        <main class="space-y-14">
            @if ($profile->bio)
                <section>
                    <p class="text-xl md:text-2xl leading-relaxed text-stone-700 whitespace-pre-line">{{ $profile->bio }}</p>
                </section>
            @endif

            @if ($profile->user->skills->isNotEmpty())
                <section>
                    <h2 class="minimal-serif text-2xl font-bold text-stone-900 mb-5">Skills</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($profile->user->skills as $skill)
                            <span class="text-sm border border-stone-300 text-stone-700 px-3 py-1 rounded-full">{{ $skill->name }}</span>
                        @endforeach
                    </div>
                </section>
            @endif

            @if ($profile->user->experiences->isNotEmpty())
                <section>
                    <h2 class="minimal-serif text-2xl font-bold text-stone-900 mb-5">Experience</h2>
                    <div class="space-y-6">
                        @foreach ($profile->user->experiences as $experience)
                            <div class="flex flex-col sm:flex-row sm:justify-between gap-1">
                                <div>
                                    <h3 class="font-semibold text-stone-900">{{ $experience->role }}</h3>
                                    <p class="text-stone-600">{{ $experience->company }}</p>
                                    <p class="text-stone-500 text-sm mt-2 whitespace-pre-line">{{ $experience->description }}</p>
                                </div>
                                <span class="text-sm text-stone-400 shrink-0">
                                    {{ $experience->started_at?->format('M Y') }} -
                                    {{ $experience->is_current ? 'Present' : $experience->ended_at?->format('M Y') }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            @if ($profile->user->projects->isNotEmpty())
                <section>
                    <h2 class="minimal-serif text-2xl font-bold text-stone-900 mb-5">Projects</h2>
                    <div class="space-y-8">
                        @foreach ($profile->user->projects as $project)
                            <article class="group">
                                @if ($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}" alt="" class="w-full h-64 object-cover rounded-lg mb-4 grayscale group-hover:grayscale-0 transition">
                                @endif
                                <h3 class="text-xl font-semibold text-stone-900">{{ $project->title }}</h3>
                                <p class="text-stone-600 mt-2 whitespace-pre-line">{{ $project->description }}</p>
                                @if ($project->technologies)
                                    <p class="text-sm text-stone-400 mt-3">{{ implode(' · ', $project->technologies) }}</p>
                                @endif
                                <div class="flex gap-4 mt-3">
                                    @if ($project->project_url)
                                        <a href="{{ $project->project_url }}" target="_blank" class="text-sm text-stone-500 hover:text-stone-900 underline decoration-stone-300 underline-offset-4">Live</a>
                                    @endif
                                    @if ($project->github_url)
                                        <a href="{{ $project->github_url }}" target="_blank" class="text-sm text-stone-500 hover:text-stone-900 underline decoration-stone-300 underline-offset-4">Code</a>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

            @if ($profile->user->education->isNotEmpty())
                <section>
                    <h2 class="minimal-serif text-2xl font-bold text-stone-900 mb-5">Education</h2>
                    <div class="space-y-4">
                        @foreach ($profile->user->education as $edu)
                            <div>
                                <h3 class="font-semibold text-stone-900">{{ $edu->degree }}</h3>
                                <p class="text-stone-600">{{ $edu->institution }}</p>
                                <p class="text-sm text-stone-400">
                                    {{ $edu->started_at?->format('M Y') }} @if($edu->ended_at) - {{ $edu->ended_at?->format('M Y') }}@endif
                                </p>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            <section class="pt-10 border-t border-stone-200">
                <h2 class="minimal-serif text-2xl font-bold text-stone-900 mb-3">Contact</h2>
                <p class="text-stone-600 mb-4">For inquiries, please email me at</p>
                <a href="mailto:{{ $profile->email ?? $profile->user->email }}" class="text-lg text-stone-900 underline decoration-stone-300 underline-offset-4 hover:decoration-stone-900 transition">{{ $profile->email ?? $profile->user->email }}</a>
            </section>
        </main>

        <footer class="mt-20 pt-8 border-t border-stone-200 text-center text-stone-400 text-sm">
            <p>&copy; {{ date('Y') }} {{ $profile->full_name ?? $profile->user->name }}. Built with PortfolioBuilder.</p>
        </footer>
    </div>
</div>
@endsection
