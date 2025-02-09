<?php

use Illuminate\Support\Facades\Route;

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

require __DIR__.'/auth.php';
