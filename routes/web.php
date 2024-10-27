<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;

// Home route
Route::get('/', function () {
    return view('welcome'); // Change to your actual home view
})->name('home');

// Routes for unauthenticated users (guests)
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

// Routes that require authentication
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Blog routes
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index'); // Show all blogs
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create'); // Show create blog form
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store'); // Store new blog
    Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit'); // Show edit blog form
    Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update'); // Update blog
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy'); // Delete blog
    Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show'); // Show single blog
});

// Routes that require authentication
Route::middleware('auth')->group(function () {
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index'); // Show all blogs
    // Other blog routes
});
Route::get('/', [BlogController::class, 'welcome'])->name('home');
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
