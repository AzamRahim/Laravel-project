<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'started_at' => ['required', 'date'],
            'ended_at' => ['nullable', 'date', 'after_or_equal:started_at'],
            'is_current' => ['boolean'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['is_current'] = $request->boolean('is_current', false);

        Experience::create($validated);

        return redirect()->route('dashboard')->with('success', 'Experience added successfully.');
    }

    public function update(Request $request, Experience $experience)
    {
        $this->authorize('update', $experience);

        $validated = $request->validate([
            'company' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'started_at' => ['required', 'date'],
            'ended_at' => ['nullable', 'date', 'after_or_equal:started_at'],
            'is_current' => ['boolean'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['is_current'] = $request->boolean('is_current', false);

        $experience->update($validated);

        return redirect()->route('dashboard')->with('success', 'Experience updated successfully.');
    }

    public function destroy(Experience $experience)
    {
        $this->authorize('delete', $experience);

        $experience->delete();

        return redirect()->route('dashboard')->with('success', 'Experience deleted successfully.');
    }
}
