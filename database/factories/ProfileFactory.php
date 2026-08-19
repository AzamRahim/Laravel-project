<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Profile>
 */
class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'full_name' => fake()->name(),
            'title' => fake()->jobTitle(),
            'bio' => fake()->paragraph(),
            'location' => fake()->city(),
            'email' => fake()->safeEmail(),
            'theme' => fake()->randomElement(['modern', 'creative', 'minimal']),
            'slug' => Str::slug(fake()->unique()->userName()),
            'is_public' => true,
        ];
    }
}
