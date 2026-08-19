<section id="projects" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-slate-900">Projects</h2>
        <button onclick="toggleForm('project-form')" class="text-sm bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">Add Project</button>
    </div>

    <form id="project-form" method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data" class="hidden space-y-4 mb-6 border-b border-slate-200 pb-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="title" placeholder="Project Title" required
                class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
            <input type="text" name="technologies" placeholder="Technologies (comma separated)"
                class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="url" name="project_url" placeholder="Live URL"
                class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
            <input type="url" name="github_url" placeholder="GitHub URL"
                class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
        </div>
        <textarea name="description" rows="3" placeholder="Project description"
            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none"></textarea>
        <input type="file" name="image" accept="image/*"
            class="w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-700">
        <div class="flex gap-2">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium">Save</button>
            <button type="button" onclick="toggleForm('project-form')" class="text-slate-600 hover:text-slate-800 px-4 py-2">Cancel</button>
        </div>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse ($user->projects as $project)
            <div class="border border-slate-200 rounded-lg p-4">
                <div id="project-display-{{ $project->id }}">
                    @if ($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" alt="" class="w-full h-32 object-cover rounded-lg mb-3">
                    @endif
                    <h3 class="font-semibold text-slate-900">{{ $project->title }}</h3>
                    <p class="text-sm text-slate-600 line-clamp-2">{{ $project->description }}</p>
                    @if ($project->technologies)
                        <div class="flex flex-wrap gap-1 mt-2">
                            @foreach ($project->technologies as $tech)
                                <span class="text-xs bg-slate-100 text-slate-700 px-2 py-1 rounded">{{ $tech }}</span>
                            @endforeach
                        </div>
                    @endif
                    <div class="flex items-center gap-4 mt-3">
                        <button type="button" onclick="toggleEdit('project-display-{{ $project->id }}', 'project-edit-{{ $project->id }}')" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Edit</button>
                        <form method="POST" action="{{ route('projects.destroy', $project) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </div>
                </div>

                <form id="project-edit-{{ $project->id }}" method="POST" action="{{ route('projects.update', $project) }}" enctype="multipart/form-data" class="hidden space-y-3">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <input type="text" name="title" value="{{ old('title', $project->title) }}" required
                            class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                        <input type="text" name="technologies" value="{{ old('technologies', implode(', ', $project->technologies ?? [])) }}"
                            class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <input type="url" name="project_url" value="{{ old('project_url', $project->project_url) }}"
                            class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                        <input type="url" name="github_url" value="{{ old('github_url', $project->github_url) }}"
                            class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                    </div>
                    <textarea name="description" rows="3"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">{{ old('description', $project->description) }}</textarea>
                    @if ($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" alt="" class="w-24 h-16 object-cover rounded">
                    @endif
                    <input type="file" name="image" accept="image/*"
                        class="w-full text-sm text-slate-600 file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:bg-indigo-50 file:text-indigo-700">
                    <div class="flex gap-2">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium">Update</button>
                        <button type="button" onclick="toggleEdit('project-edit-{{ $project->id }}', 'project-display-{{ $project->id }}')" class="text-slate-600 hover:text-slate-800 px-4 py-2 text-sm">Cancel</button>
                    </div>
                </form>
            </div>
        @empty
            <p class="text-slate-500 col-span-2">No projects yet. Add your first project above.</p>
        @endforelse
    </div>
</section>
