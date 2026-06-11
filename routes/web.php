<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('tasks.index');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('subjects', SubjectController::class)->except(['show']);
        Route::resource('categories', CategoryController::class)->except(['show']);

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/block', [UserController::class, 'block'])->name('users.block');
        Route::patch('/users/{user}/unblock', [UserController::class, 'unblock'])->name('users.unblock');
    });

require __DIR__.'/auth.php';