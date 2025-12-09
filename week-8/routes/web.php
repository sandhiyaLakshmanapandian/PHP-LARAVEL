<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');



Auth::routes();

Route::middleware('auth')->group(function () {


    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index')->middleware('can:users.index');
        Route::get('create', [UserController::class, 'create'])->name('create')->middleware('can:users.create');
        Route::post('/', [UserController::class, 'store'])->name('store')->middleware('can:users.store');
        Route::get('{user}', [UserController::class, 'show'])->name('show')->middleware('can:users.show');
        Route::get('{user}/edit', [UserController::class, 'edit'])->name('edit')->middleware('can:users.edit');
        Route::put('{user}', [UserController::class, 'update'])->name('update')->middleware('can:users.update');
        Route::delete('{user}', [UserController::class, 'destroy'])->name('destroy')->middleware('can:users.destroy');
    });

    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index')->middleware('can:roles.index');
        Route::get('create', [RoleController::class, 'create'])->name('create')->middleware('can:roles.create');
        Route::post('/', [RoleController::class, 'store'])->name('store')->middleware('can:roles.store');
        Route::get('{role}', [RoleController::class, 'show'])->name('show')->middleware('can:roles.show');
        Route::get('{role}/edit', [RoleController::class, 'edit'])->name('edit')->middleware('can:roles.edit');
        Route::put('{role}', [RoleController::class, 'update'])->name('update')->middleware('can:roles.update');
        Route::delete('{role}', [RoleController::class, 'destroy'])->name('destroy')->middleware('can:roles.destroy');
    });

    Route::prefix('blogs')->name('blogs.')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('index')->middleware('can:blogs.index');
        Route::get('create', [BlogController::class, 'create'])->name('create')->middleware('can:blogs.create');
        Route::post('/', [BlogController::class, 'store'])->name('store')->middleware('can:blogs.store');
        Route::get('{blog}', [BlogController::class, 'show'])->name('show')->middleware('can:blogs.show');
        Route::get('{blog}/edit', [BlogController::class, 'edit'])->name('edit')->middleware('can:blogs.edit');
        Route::put('{blog}', [BlogController::class, 'update'])->name('update')->middleware('can:blogs.update');
        Route::delete('{blog}', [BlogController::class, 'destroy'])->name('destroy')->middleware('can:blogs.destroy');
    });

});

          Route::get('{blog}', [BlogController::class, 'show'])->name('show')->middleware('blogs.show');