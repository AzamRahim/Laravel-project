<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['user_id'] = $request->user()->id;

        SocialLink::create($validated);

        return redirect()->route('dashboard')->with('success', 'Social link added successfully.');
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $this->authorize('update', $socialLink);

        $validated = $request->validate([
            'platform' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
        ]);

        $socialLink->update($validated);

        return redirect()->route('dashboard')->with('success', 'Social link updated successfully.');
    }

    public function destroy(SocialLink $socialLink)
    {
        $this->authorize('delete', $socialLink);

        $socialLink->delete();

        return redirect()->route('dashboard')->with('success', 'Social link deleted successfully.');
    }
}
