<section id="skills" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-slate-900">Skills</h2>
        <button onclick="toggleForm('skill-form')" class="text-sm bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">Add Skill</button>
    </div>

    <form id="skill-form" method="POST" action="{{ route('skills.store') }}" class="hidden space-y-4 mb-6 border-b border-slate-200 pb-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <input type="text" name="name" placeholder="Skill name" required
                class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
            <input type="text" name="category" placeholder="Category (e.g. Frontend)"
                class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
            <div class="flex items-center gap-3">
                <input type="range" name="proficiency" min="0" max="100" value="75"
                    class="w-full accent-indigo-600" oninput="updateRangeLabel(this)">
                <span class="text-sm text-slate-700 w-12 range-label">75%</span>
            </div>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium">Save</button>
            <button type="button" onclick="toggleForm('skill-form')" class="text-slate-600 hover:text-slate-800 px-4 py-2">Cancel</button>
        </div>
    </form>

    <div class="flex flex-wrap gap-2">
        @forelse ($user->skills as $skill)
            <div class="bg-slate-50 border border-slate-200 rounded-lg px-3 py-2">
                <div id="skill-display-{{ $skill->id }}" class="flex items-center gap-2">
                    <div>
                        <span class="font-medium text-slate-900">{{ $skill->name }}</span>
                        <div class="text-xs text-slate-500">{{ $skill->category }} &middot; {{ $skill->proficiency }}%</div>
                    </div>
                    <div class="flex items-center gap-2 ml-2">
                        <button type="button" onclick="toggleEdit('skill-display-{{ $skill->id }}', 'skill-edit-{{ $skill->id }}')" class="text-indigo-600 hover:text-indigo-800 text-sm">Edit</button>
                        <form method="POST" action="{{ route('skills.destroy', $skill) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm">&times;</button>
                        </form>
                    </div>
                </div>

                <form id="skill-edit-{{ $skill->id }}" method="POST" action="{{ route('skills.update', $skill) }}" class="hidden space-y-2">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col sm:flex-row gap-2">
                        <input type="text" name="name" value="{{ old('name', $skill->name) }}" required
                            class="px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                        <input type="text" name="category" value="{{ old('category', $skill->category) }}"
                            class="px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                        <div class="flex items-center gap-2 min-w-[140px]">
                            <input type="range" name="proficiency" min="0" max="100" value="{{ old('proficiency', $skill->proficiency) }}"
                                class="w-full accent-indigo-600" oninput="updateRangeLabel(this)">
                            <span class="text-sm text-slate-700 w-12 range-label">{{ $skill->proficiency }}%</span>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded text-sm font-medium">Update</button>
                        <button type="button" onclick="toggleEdit('skill-edit-{{ $skill->id }}', 'skill-display-{{ $skill->id }}')" class="text-slate-600 hover:text-slate-800 px-3 py-1.5 text-sm">Cancel</button>
                    </div>
                </form>
            </div>
        @empty
            <p class="text-slate-500">No skills added yet.</p>
        @endforelse
    </div>
</section>
