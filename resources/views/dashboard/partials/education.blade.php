<section id="education" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-slate-900">Education</h2>
        <button onclick="toggleForm('education-form')" class="text-sm bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">Add Education</button>
    </div>

    <form id="education-form" method="POST" action="{{ route('education.store') }}" class="hidden space-y-4 mb-6 border-b border-slate-200 pb-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="institution" placeholder="Institution" required
                class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
            <input type="text" name="degree" placeholder="Degree" required
                class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <input type="text" name="field_of_study" placeholder="Field of Study"
                class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
            <input type="date" name="started_at"
                class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
            <input type="date" name="ended_at"
                class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
        </div>
        <textarea name="description" rows="3" placeholder="Description"
            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none"></textarea>
        <div class="flex gap-2">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium">Save</button>
            <button type="button" onclick="toggleForm('education-form')" class="text-slate-600 hover:text-slate-800 px-4 py-2">Cancel</button>
        </div>
    </form>

    <div class="space-y-4">
        @forelse ($user->education as $edu)
            <div class="border border-slate-200 rounded-lg p-4">
                <div id="education-display-{{ $edu->id }}">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-semibold text-slate-900">{{ $edu->degree }}</h3>
                            <p class="text-sm text-slate-600">{{ $edu->institution }}</p>
                            @if ($edu->field_of_study)
                                <p class="text-xs text-slate-500">{{ $edu->field_of_study }}</p>
                            @endif
                        </div>
                        <div class="flex items-center gap-3">
                            <button type="button" onclick="toggleEdit('education-display-{{ $edu->id }}', 'education-edit-{{ $edu->id }}')" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Edit</button>
                            <form method="POST" action="{{ route('education.destroy', $edu) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-600 hover:text-red-800">Delete</button>
                            </form>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 mt-1">
                        {{ $edu->started_at?->format('M Y') }} @if($edu->ended_at) - {{ $edu->ended_at?->format('M Y') }}@endif
                    </p>
                    <p class="text-sm text-slate-600 mt-2 whitespace-pre-line">{{ $edu->description }}</p>
                </div>

                <form id="education-edit-{{ $edu->id }}" method="POST" action="{{ route('education.update', $edu) }}" class="hidden space-y-3">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <input type="text" name="institution" value="{{ old('institution', $edu->institution) }}" required
                            class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                        <input type="text" name="degree" value="{{ old('degree', $edu->degree) }}" required
                            class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <input type="text" name="field_of_study" value="{{ old('field_of_study', $edu->field_of_study) }}"
                            class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                        <input type="date" name="started_at" value="{{ old('started_at', $edu->started_at?->format('Y-m-d')) }}"
                            class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                        <input type="date" name="ended_at" value="{{ old('ended_at', $edu->ended_at?->format('Y-m-d')) }}"
                            class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                    </div>
                    <textarea name="description" rows="3"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">{{ old('description', $edu->description) }}</textarea>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium">Update</button>
                        <button type="button" onclick="toggleEdit('education-edit-{{ $edu->id }}', 'education-display-{{ $edu->id }}')" class="text-slate-600 hover:text-slate-800 px-4 py-2 text-sm">Cancel</button>
                    </div>
                </form>
            </div>
        @empty
            <p class="text-slate-500">No education added yet.</p>
        @endforelse
    </div>
</section>
