<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'institution' => ['required', 'string', 'max:255'],
            'degree' => ['required', 'string', 'max:255'],
            'field_of_study' => ['nullable', 'string', 'max:255'],
            'started_at' => ['nullable', 'date'],
            'ended_at' => ['nullable', 'date', 'after_or_equal:started_at'],
            'description' => ['nullable', 'string', 'max:5000'],
        ]);

        $validated['user_id'] = $request->user()->id;

        Education::create($validated);

        return redirect()->route('dashboard')->with('success', 'Education added successfully.');
    }

    public function update(Request $request, Education $education)
    {
        $this->authorize('update', $education);

        $validated = $request->validate([
            'institution' => ['required', 'string', 'max:255'],
            'degree' => ['required', 'string', 'max:255'],
            'field_of_study' => ['nullable', 'string', 'max:255'],
            'started_at' => ['nullable', 'date'],
            'ended_at' => ['nullable', 'date', 'after_or_equal:started_at'],
            'description' => ['nullable', 'string', 'max:5000'],
        ]);

        $education->update($validated);

        return redirect()->route('dashboard')->with('success', 'Education updated successfully.');
    }

    public function destroy(Education $education)
    {
        $this->authorize('delete', $education);

        $education->delete();

        return redirect()->route('dashboard')->with('success', 'Education deleted successfully.');
    }
}
