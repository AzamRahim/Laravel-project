<section id="social" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-slate-900">Social Links</h2>
        <button onclick="toggleForm('social-form')" class="text-sm bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">Add Link</button>
    </div>

    <form id="social-form" method="POST" action="{{ route('social-links.store') }}" class="hidden space-y-4 mb-6 border-b border-slate-200 pb-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="platform" placeholder="Platform (e.g. GitHub, LinkedIn)" required
                class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
            <input type="url" name="url" placeholder="URL" required
                class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
        </div>
        <input type="text" name="icon" placeholder="Icon class (optional)"
            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
        <div class="flex gap-2">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium">Save</button>
            <button type="button" onclick="toggleForm('social-form')" class="text-slate-600 hover:text-slate-800 px-4 py-2">Cancel</button>
        </div>
    </form>

    <div class="space-y-2">
        @forelse ($user->socialLinks as $link)
            <div class="border border-slate-200 rounded-lg px-4 py-3">
                <div id="social-display-{{ $link->id }}" class="flex items-center justify-between">
                    <div>
                        <span class="font-medium text-slate-900">{{ $link->platform }}</span>
                        <a href="{{ $link->url }}" target="_blank" class="block text-sm text-indigo-600 hover:underline truncate max-w-md">{{ $link->url }}</a>
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="button" onclick="toggleEdit('social-display-{{ $link->id }}', 'social-edit-{{ $link->id }}')" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Edit</button>
                        <form method="POST" action="{{ route('social-links.destroy', $link) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </div>
                </div>

                <form id="social-edit-{{ $link->id }}" method="POST" action="{{ route('social-links.update', $link) }}" class="hidden space-y-3">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <input type="text" name="platform" value="{{ old('platform', $link->platform) }}" required
                            class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                        <input type="url" name="url" value="{{ old('url', $link->url) }}" required
                            class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                    </div>
                    <input type="text" name="icon" value="{{ old('icon', $link->icon) }}"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                    <div class="flex gap-2">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium">Update</button>
                        <button type="button" onclick="toggleEdit('social-edit-{{ $link->id }}', 'social-display-{{ $link->id }}')" class="text-slate-600 hover:text-slate-800 px-4 py-2 text-sm">Cancel</button>
                    </div>
                </form>
            </div>
        @empty
            <p class="text-slate-500">No social links added yet.</p>
        @endforelse
    </div>
</section>
