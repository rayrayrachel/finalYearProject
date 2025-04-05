<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\CreateJob;
use Livewire\Volt\Volt;
use App\Livewire\JobDetail;

// Route::view('/', 'welcome');

Route::view('/', 'landing-page')->name('landing-page');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('job-list', 'job-list')
    ->name('job-list');

Route::view('company-list', 'company-list')
    ->name('company-list');


// Route::view('job-post', 'job-post')
// ->name('job-post');

Volt::route('create-job', 'create-job')
    ->name('create-job');

Route::view('post-job', 'post-job-page')
    ->name('post-job');

Route::view('profile-detail', 'profile-detail')
    ->name('profile-detail');

// Route::view('create-job', 'create-job')
// ->name('create-job');

// // Route::get('create-job', CreateJob::class)->name('create-job')->middleware('auth');

// // Route::get('/projects/{project}', JobPost::class)->name('project.details');

Route::get('/job-detail/{jobId}', function ($jobId) {
    return view('job-detail', compact('jobId'));
})->name('job-detail');

require __DIR__ . '/auth.php';
