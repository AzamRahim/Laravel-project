<section id="profile" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
    <h2 class="text-xl font-bold text-slate-900 mb-4">Profile & Design</h2>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Full Name</label>
                <input type="text" name="full_name" value="{{ old('full_name', $user->profile->full_name) }}"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Professional Title</label>
                <input type="text" name="title" value="{{ old('title', $user->profile->title) }}"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Bio</label>
            <textarea name="bio" rows="4"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">{{ old('bio', $user->profile->bio) }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Location</label>
                <input type="text" name="location" value="{{ old('location', $user->profile->location) }}"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $user->profile->phone) }}"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Contact Email</label>
                <input type="email" name="email" value="{{ old('email', $user->profile->email ?? $user->email) }}"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Resume URL</label>
                <input type="url" name="resume_url" value="{{ old('resume_url', $user->profile->resume_url) }}"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Portfolio Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $user->profile->slug) }}" required
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
                <p class="text-xs text-slate-500 mt-1">Your public URL: {{ route('portfolio.public', $user->profile->slug) }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Avatar</label>
                <input type="file" name="avatar" accept="image/*"
                    class="w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                @if ($user->profile->avatar)
                    <img src="{{ asset('storage/' . $user->profile->avatar) }}" alt="Avatar" class="mt-2 h-16 w-16 rounded-full object-cover">
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Design Theme</label>
                <select name="theme"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
                    <option value="modern" {{ old('theme', $user->profile->theme) === 'modern' ? 'selected' : '' }}>Modern Professional</option>
                    <option value="creative" {{ old('theme', $user->profile->theme) === 'creative' ? 'selected' : '' }}>Creative Bold</option>
                    <option value="minimal" {{ old('theme', $user->profile->theme) === 'minimal' ? 'selected' : '' }}>Minimal Elegant</option>
                </select>
            </div>
            <div class="flex items-center">
                <label class="flex items-center cursor-pointer mt-6">
                    <input type="checkbox" name="is_public" value="1" {{ old('is_public', $user->profile->is_public) ? 'checked' : '' }}
                        class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 h-5 w-5">
                    <span class="ml-2 text-slate-700">Make portfolio public</span>
                </label>
            </div>
        </div>

        <div class="pt-2">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-lg font-medium transition">
                Save Profile
            </button>
        </div>
    </form>
</section>
