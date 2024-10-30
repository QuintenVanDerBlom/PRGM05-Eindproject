<?php

use App\Http\Controllers\HikingTrailController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name("home");

Route::get('/trails', function () {
    return view('trails');
})->name("trails");

Route::get('/about', function () {
    return view('about_us');
})->name("about-us");

Route::get('/contact', function () {
    return view('contact_us');
})->name("contact-us");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/trails/show', [HikingTrailController::class, 'index'])->name('trails.show');
    Route::get('/trails/create', [HikingTrailController::class, 'create'])->name('trails.create');
    Route::post('/trails', [HikingTrailController::class, 'store'])->name('trails.store');
    Route::get('trails/{hikingTrail}/edit', [HikingTrailController::class, 'edit'])->name('trails.edit');
    Route::put('trails/{hikingTrail}', [HikingTrailController::class, 'update'])->name('trails.update');
    Route::delete('/trails/{id}', [HikingTrailController::class, 'destroy'])->name('trails.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
