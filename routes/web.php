<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PublicPortfolioController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SocialLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('projects', ProjectController::class)->only(['store', 'update', 'destroy']);
    Route::resource('skills', SkillController::class)->only(['store', 'update', 'destroy']);
    Route::resource('experiences', ExperienceController::class)->only(['store', 'update', 'destroy']);
    Route::resource('education', EducationController::class)->only(['store', 'update', 'destroy']);
    Route::resource('social-links', SocialLinkController::class)->only(['store', 'update', 'destroy']);
});

Route::get('/p/{slug}', [PublicPortfolioController::class, 'show'])->name('portfolio.public');
