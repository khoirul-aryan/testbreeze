<?php

use App\Http\Controllers\admin\admincontroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\user\usercontroller;
use Illuminate\Support\Facades\Route;

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
});

require __DIR__ . '/auth.php';

//user routes
Route::middleware(['auth', 'usermiddleware'])->group(function () {

    Route::get('dashboard', [usercontroller::class, 'index'])->name('dashboard');
});


//admin routes
Route::middleware(['auth', 'adminmiddleware'])->group(function () {

    Route::get('/admin/dashboard', [admincontroller::class, 'index'])->name('admin.dashboard');
});
