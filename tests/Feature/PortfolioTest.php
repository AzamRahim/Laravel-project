<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PortfolioTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_public_portfolio(): void
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create([
            'user_id' => $user->id,
            'slug' => 'john-doe',
            'is_public' => true,
        ]);

        $response = $this->get(route('portfolio.public', $profile->slug));

        $response->assertOk();
        $response->assertSee($profile->full_name);
    }

    public function test_private_portfolio_returns_not_found(): void
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create([
            'user_id' => $user->id,
            'slug' => 'private-user',
            'is_public' => false,
        ]);

        $response = $this->get(route('portfolio.public', $profile->slug));

        $response->assertNotFound();
    }

    public function test_user_can_update_profile_and_theme(): void
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create([
            'user_id' => $user->id,
            'slug' => 'old-slug',
        ]);

        $this->actingAs($user)
            ->put(route('profile.update'), [
                'full_name' => 'Updated Name',
                'title' => 'New Title',
                'bio' => 'New bio',
                'theme' => 'creative',
                'slug' => 'new-slug',
                'is_public' => '1',
            ])
            ->assertRedirect(route('dashboard'));

        $profile->refresh();
        $this->assertEquals('Updated Name', $profile->full_name);
        $this->assertEquals('creative', $profile->theme);
        $this->assertTrue($profile->is_public);
    }

    public function test_user_can_add_project(): void
    {
        $user = User::factory()->create();
        Profile::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->post(route('projects.store'), [
                'title' => 'Awesome Project',
                'description' => 'A test project.',
                'technologies' => 'PHP, Laravel',
            ])
            ->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('projects', [
            'user_id' => $user->id,
            'title' => 'Awesome Project',
        ]);
    }

    public function test_user_can_delete_own_social_link(): void
    {
        $user = User::factory()->create();
        $link = $user->socialLinks()->create(['platform' => 'GitHub', 'url' => 'https://github.com', 'order' => 1]);

        $this->actingAs($user)
            ->delete(route('social-links.destroy', $link))
            ->assertRedirect(route('dashboard'));

        $this->assertDatabaseMissing('social_links', ['id' => $link->id]);
    }

    public function test_user_can_edit_project(): void
    {
        $user = User::factory()->create();
        $project = $user->projects()->create([
            'title' => 'Old Title',
            'description' => 'Old description',
            'order' => 1,
        ]);

        $this->actingAs($user)
            ->put(route('projects.update', $project), [
                'title' => 'Updated Title',
                'description' => 'Updated description',
                'technologies' => 'PHP, Laravel',
            ])
            ->assertRedirect(route('dashboard'));

        $project->refresh();
        $this->assertEquals('Updated Title', $project->title);
        $this->assertEquals(['PHP', 'Laravel'], $project->technologies);
    }

    public function test_user_can_edit_experience(): void
    {
        $user = User::factory()->create();
        $experience = $user->experiences()->create([
            'company' => 'Old Co',
            'role' => 'Old Role',
            'started_at' => '2020-01-01',
            'order' => 1,
        ]);

        $this->actingAs($user)
            ->put(route('experiences.update', $experience), [
                'company' => 'New Co',
                'role' => 'New Role',
                'started_at' => '2021-01-01',
                'is_current' => true,
            ])
            ->assertRedirect(route('dashboard'));

        $experience->refresh();
        $this->assertEquals('New Co', $experience->company);
        $this->assertTrue($experience->is_current);
    }
}
