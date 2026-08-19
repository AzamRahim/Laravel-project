<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'proficiency' => ['required', 'integer', 'min:0', 'max:100'],
            'category' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['user_id'] = $request->user()->id;

        Skill::create($validated);

        return redirect()->route('dashboard')->with('success', 'Skill added successfully.');
    }

    public function update(Request $request, Skill $skill)
    {
        $this->authorize('update', $skill);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'proficiency' => ['required', 'integer', 'min:0', 'max:100'],
            'category' => ['nullable', 'string', 'max:255'],
        ]);

        $skill->update($validated);

        return redirect()->route('dashboard')->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        $this->authorize('delete', $skill);

        $skill->delete();

        return redirect()->route('dashboard')->with('success', 'Skill deleted successfully.');
    }
}
