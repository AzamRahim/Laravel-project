<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class PublicPortfolioController extends Controller
{
    public function show(Request $request, string $slug)
    {
        $profile = Profile::where('slug', $slug)
            ->with([
                'user.projects',
                'user.skills',
                'user.experiences',
                'user.education',
                'user.socialLinks',
            ])
            ->firstOrFail();

        if (! $profile->is_public) {
            abort(404);
        }

        $theme = $profile->theme ?? 'modern';

        return view("portfolio.themes.{$theme}", compact('profile'));
    }
}
