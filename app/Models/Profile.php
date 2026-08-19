<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'title',
        'bio',
        'location',
        'phone',
        'email',
        'avatar',
        'resume_url',
        'theme',
        'slug',
        'is_public',
        'customization',
    ];

    protected function casts(): array
    {
        return [
            'is_public' => 'boolean',
            'customization' => 'array',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
