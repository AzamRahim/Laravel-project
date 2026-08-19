<?php

namespace App\Policies;

use App\Models\SocialLink;
use App\Models\User;

class SocialLinkPolicy
{
    public function update(User $user, SocialLink $socialLink): bool
    {
        return $user->id === $socialLink->user_id;
    }

    public function delete(User $user, SocialLink $socialLink): bool
    {
        return $user->id === $socialLink->user_id;
    }
}
