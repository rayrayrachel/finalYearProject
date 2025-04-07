<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\CreateJob;
use Livewire\Volt\Volt;
use App\Livewire\JobDetail;
use App\Livewire\ProfileDetail;
use App\Http\Livewire\EditProfile;

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


Volt::route('create-job', 'create-job')
    ->name('create-job');

Route::view('post-job', 'post-job-page')
    ->name('post-job');

Route::get('/profile/{profileId}', function ($profileId) {
    return view('profile-detail', ['profileId' => $profileId]);
})->name('profile.detail');
    

Route::get('/job-detail/{jobId}', function ($jobId) {
    return view('job-detail', compact('jobId'));
})->name('job-detail');

Route::middleware('auth')->get('/edit-profile', function () {
    return view('edit-profile');
})->name('edit-profile');

require __DIR__ . '/auth.php';
