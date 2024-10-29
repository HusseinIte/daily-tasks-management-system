<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

############### Entry Point Route ################################

Route::get('/', function () {
    if (Auth::check()) {
        // If user is authenticated, redirect them to the dashboard or homepage
        return Redirect::route('dashboard');  // Change '/dashboard' to your preferred route
    }
    // If user is not authenticated, redirect them to the login page
    return redirect('/login');
});

################# Auth Routes ###################################

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ##################  Task Routes ###################################

Route::prefix('tasks')->middleware('auth')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('dashboard');
    Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::get('/recycle-bin', [TaskController::class, 'recycleBinTasks'])->name('tasks.recycle');
    Route::delete('/empty-recycle-bin', [TaskController::class, 'emptyRecycleBin'])->name('tasks.emptyRecycle');
    Route::delete('/{task}', [TaskController::class, 'destroy'])->name('tasks.delete');
    Route::delete('/{taskId}/force-delete', [TaskController::class, 'forceDelete'])->name('tasks.forceDelete');
    Route::post('/{taskId}/restore', [TaskController::class, 'restore'])->name('tasks.restore');
    Route::put('/{task}/update-status', [TaskController::class, 'updateTaskStatus'])->name('tasks.updateStatus');
});
require __DIR__ . '/auth.php';
