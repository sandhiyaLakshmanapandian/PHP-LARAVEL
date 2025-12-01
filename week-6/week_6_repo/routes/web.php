<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::redirect('/', 'login');

Auth::routes();

// Home page
 Route::get('home', [HomeController::class, 'index'])->name('home');
// ------------------------
// Admin-only routes
// ------------------------
Route::middleware(['auth', 'role:Admin'])->group(function () {

    // Users CRUD
    Route::resource('users', UserController::class);

    // Roles CRUD
   

    // Blogs CRUD (all blogs)
    Route::resource('blogs', BlogController::class);
});

// ------------------------
// Authenticated users with permissions
// ------------------------
Route::middleware(['auth'])->group(function () {

    // Users can see themselves if they have read permission
    Route::get('users', [UserController::class, 'index'])
        ->middleware('permission:user_profile_read')
        ->name('users.index');

    Route::get('users/{user}', [UserController::class, 'show'])
        ->middleware('permission:user_profile_read')
        ->name('users.show');

    Route::get('users/{user}/edit', [UserController::class, 'edit'])
        ->middleware('permission:user_profile_write')
        ->name('users.edit');

    Route::put('users/{user}', [UserController::class, 'update'])
        ->middleware('permission:user_profile_write')
        ->name('users.update');

    Route::delete('users/{user}', [UserController::class, 'destroy'])
        ->middleware('permission:user_profile_write')
        ->name('users.destroy');

    // Blogs routes for non-admin users
    Route::get('blogs', [BlogController::class, 'index'])
        ->middleware('permission:blog_read')
        ->name('blogs.index');

    Route::get('blogs/create', [BlogController::class, 'create'])
        ->middleware('permission:blog_write')
        ->name('blogs.create');

    Route::post('blogs', [BlogController::class, 'store'])
        ->middleware('permission:blog_write')
        ->name('blogs.store');

    Route::get('blogs/{blog}', [BlogController::class, 'show'])
        ->middleware('permission:blog_read')
        ->name('blogs.show');

    Route::get('blogs/{blog}/edit', [BlogController::class, 'edit'])
        ->middleware('permission:blog_write')
        ->name('blogs.edit');

    Route::put('blogs/{blog}', [BlogController::class, 'update'])
        ->middleware('permission:blog_write')
        ->name('blogs.update');

    Route::delete('blogs/{blog}', [BlogController::class, 'destroy'])
        ->middleware('permission:blog_write')
        ->name('blogs.destroy');
});
