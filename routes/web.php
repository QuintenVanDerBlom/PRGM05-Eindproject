<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HikingTrailController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name("home");


Route::get('/trails', [HikingTrailController::class, 'trailIndex'])->name('trails.index');

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
    Route::get('/categories/show', [CategoryController::class, 'index'])->name('categories.show');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::patch('/categories/{category}/toggle', [CategoryController::class, 'toggleStatus'])->name('categories.toggleStatus');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\UserController;

Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.show');
    Route::get('/users/{user}/edit-role', [UserController::class, 'editRole'])->name('users.editRole');
    Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
});



require __DIR__.'/auth.php';
