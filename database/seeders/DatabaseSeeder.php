<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SocialLink;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Alex Morgan',
            'email' => 'demo@portfolio.test',
            'password' => Hash::make('password'),
        ]);

        Profile::create([
            'user_id' => $user->id,
            'full_name' => 'Alex Morgan',
            'title' => 'Full Stack Developer & UI Designer',
            'bio' => "I'm a passionate full-stack developer who loves building beautiful, performant web applications. With over 5 years of experience, I help startups and businesses turn ideas into scalable products.",
            'location' => 'Kuala Lumpur, Malaysia',
            'phone' => '+60 12 345 6789',
            'email' => 'demo@portfolio.test',
            'theme' => 'modern',
            'slug' => 'alex-morgan-demo',
            'is_public' => true,
        ]);

        Project::create([
            'user_id' => $user->id,
            'title' => 'E-Commerce Dashboard',
            'description' => 'A comprehensive analytics dashboard for online stores featuring real-time sales tracking, inventory management, and customer insights.',
            'project_url' => 'https://example.com',
            'github_url' => 'https://github.com',
            'technologies' => ['Laravel', 'Vue.js', 'Tailwind CSS', 'Chart.js'],
            'order' => 1,
        ]);

        Project::create([
            'user_id' => $user->id,
            'title' => 'Task Management App',
            'description' => 'Collaborative task management tool with real-time updates, drag-and-drop boards, and team workload insights.',
            'project_url' => 'https://example.com',
            'github_url' => 'https://github.com',
            'technologies' => ['React', 'Node.js', 'MongoDB', 'Socket.io'],
            'order' => 2,
        ]);

        $skills = [
            ['name' => 'Laravel', 'proficiency' => 95, 'category' => 'Backend'],
            ['name' => 'PHP', 'proficiency' => 90, 'category' => 'Backend'],
            ['name' => 'JavaScript', 'proficiency' => 88, 'category' => 'Frontend'],
            ['name' => 'Vue.js', 'proficiency' => 85, 'category' => 'Frontend'],
            ['name' => 'Tailwind CSS', 'proficiency' => 92, 'category' => 'Design'],
            ['name' => 'MySQL', 'proficiency' => 80, 'category' => 'Database'],
        ];

        foreach ($skills as $index => $skill) {
            Skill::create(array_merge($skill, [
                'user_id' => $user->id,
                'order' => $index + 1,
            ]));
        }

        Experience::create([
            'user_id' => $user->id,
            'company' => 'TechNova Solutions',
            'role' => 'Senior Full Stack Developer',
            'description' => 'Lead development of client web applications, mentor junior developers, and architect scalable Laravel APIs.',
            'started_at' => '2022-03-01',
            'is_current' => true,
            'location' => 'Kuala Lumpur',
            'order' => 1,
        ]);

        Experience::create([
            'user_id' => $user->id,
            'company' => 'PixelStudio Agency',
            'role' => 'Web Developer',
            'description' => 'Built responsive websites and e-commerce platforms for diverse clients using Laravel and modern JavaScript frameworks.',
            'started_at' => '2020-06-01',
            'ended_at' => '2022-02-28',
            'location' => 'Remote',
            'order' => 2,
        ]);

        Education::create([
            'user_id' => $user->id,
            'institution' => 'University of Technology',
            'degree' => 'Bachelor of Computer Science',
            'field_of_study' => 'Software Engineering',
            'started_at' => '2016-09-01',
            'ended_at' => '2020-05-30',
            'order' => 1,
        ]);

        SocialLink::create(['user_id' => $user->id, 'platform' => 'GitHub', 'url' => 'https://github.com', 'order' => 1]);
        SocialLink::create(['user_id' => $user->id, 'platform' => 'LinkedIn', 'url' => 'https://linkedin.com', 'order' => 2]);
        SocialLink::create(['user_id' => $user->id, 'platform' => 'Twitter', 'url' => 'https://twitter.com', 'order' => 3]);
    }
}
