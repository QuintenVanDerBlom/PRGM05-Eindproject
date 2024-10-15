<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HikingTrailController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HikingTrailController::class, 'index'])
->name('home');


Route::get('/trails', function () {
    return view('trails');
})->name('trails');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
