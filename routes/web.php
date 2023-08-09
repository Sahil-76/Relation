<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RollController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); 

    // Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
// Route::get('/users', [UserController::class, 'index'])
// ->middleware(['can:isAdmin'])->name('users.index');
    Route::resource('/users', UserController::class);

    Route::resource('rolls', RollController::class);
    // ->middleware(['can:isAdmin']);

    Route::resource('permissions',PermissionController::class);
    // ->middleware(['can:isAdmin, Permission']);
});

require __DIR__ . '/auth.php';



Route::get('/home', function () {
    return view('home');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});


//this route is used to yield content
Route::get('/welcomeone', function () {
    return view('Welcomeone');
});
Route::get('/aboutone', function () {
    return view('aboutone');
});
Route::get('/post', function () {
    return view('post');
});


// admin routes
Route::get('/mydashboard', function () {
    return view('admin-layouts.dashboard');
})->middleware(['auth', 'verified'])->name('mydashboard');

