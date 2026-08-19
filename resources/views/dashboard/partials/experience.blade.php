<section id="experience" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-slate-900">Experience</h2>
        <button onclick="toggleForm('experience-form')" class="text-sm bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">Add Experience</button>
    </div>

    <form id="experience-form" method="POST" action="{{ route('experiences.store') }}" class="hidden space-y-4 mb-6 border-b border-slate-200 pb-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="company" placeholder="Company" required
                class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
            <input type="text" name="role" placeholder="Role / Position" required
                class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <input type="date" name="started_at" required
                class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
            <input type="date" name="ended_at"
                class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
            <label class="flex items-center">
                <input type="checkbox" name="is_current" value="1"
                    class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                <span class="ml-2 text-sm text-slate-700">Current position</span>
            </label>
        </div>
        <input type="text" name="location" placeholder="Location"
            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
        <textarea name="description" rows="3" placeholder="Description"
            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none"></textarea>
        <div class="flex gap-2">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium">Save</button>
            <button type="button" onclick="toggleForm('experience-form')" class="text-slate-600 hover:text-slate-800 px-4 py-2">Cancel</button>
        </div>
    </form>

    <div class="space-y-4">
        @forelse ($user->experiences as $experience)
            <div class="border border-slate-200 rounded-lg p-4">
                <div id="experience-display-{{ $experience->id }}">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-semibold text-slate-900">{{ $experience->role }}</h3>
                            <p class="text-sm text-slate-600">{{ $experience->company }} @if($experience->location)&middot; {{ $experience->location }}@endif</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <button type="button" onclick="toggleEdit('experience-display-{{ $experience->id }}', 'experience-edit-{{ $experience->id }}')" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Edit</button>
                            <form method="POST" action="{{ route('experiences.destroy', $experience) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-600 hover:text-red-800">Delete</button>
                            </form>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 mt-1">
                        {{ $experience->started_at?->format('M Y') }} -
                        {{ $experience->is_current ? 'Present' : $experience->ended_at?->format('M Y') }}
                    </p>
                    <p class="text-sm text-slate-600 mt-2 whitespace-pre-line">{{ $experience->description }}</p>
                </div>

                <form id="experience-edit-{{ $experience->id }}" method="POST" action="{{ route('experiences.update', $experience) }}" class="hidden space-y-3">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <input type="text" name="company" value="{{ old('company', $experience->company) }}" required
                            class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                        <input type="text" name="role" value="{{ old('role', $experience->role) }}" required
                            class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <input type="date" name="started_at" value="{{ old('started_at', $experience->started_at?->format('Y-m-d')) }}" required
                            class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                        <input type="date" name="ended_at" value="{{ old('ended_at', $experience->ended_at?->format('Y-m-d')) }}"
                            class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_current" value="1" {{ old('is_current', $experience->is_current) ? 'checked' : '' }}
                                class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-slate-700">Current position</span>
                        </label>
                    </div>
                    <input type="text" name="location" value="{{ old('location', $experience->location) }}"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                    <textarea name="description" rows="3"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">{{ old('description', $experience->description) }}</textarea>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium">Update</button>
                        <button type="button" onclick="toggleEdit('experience-edit-{{ $experience->id }}', 'experience-display-{{ $experience->id }}')" class="text-slate-600 hover:text-slate-800 px-4 py-2 text-sm">Cancel</button>
                    </div>
                </form>
            </div>
        @empty
            <p class="text-slate-500">No experience added yet.</p>
        @endforelse
    </div>
</section>
