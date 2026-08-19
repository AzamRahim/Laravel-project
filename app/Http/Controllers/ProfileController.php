<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;

        $validated = $request->validate([
            'full_name' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:5000'],
            'location' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'resume_url' => ['nullable', 'url', 'max:255'],
            'theme' => ['required', 'in:modern,creative,minimal'],
            'is_public' => ['boolean'],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'slug' => ['required', 'string', 'max:255', 'unique:profiles,slug,' . ($profile?->id ?? 'NULL')],
        ]);

        if ($request->hasFile('avatar')) {
            if ($profile?->avatar) {
                Storage::disk('public')->delete($profile->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $validated['is_public'] = $request->boolean('is_public', false);

        if (! $profile) {
            $validated['user_id'] = $user->id;
            $user->profile()->create($validated);
        } else {
            $profile->update($validated);
        }

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully.');
    }
}
