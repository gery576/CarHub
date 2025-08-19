<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;

Route::get('/', [CarController::class,'index'])->name('cars.index');
Route::get('/auto/{id}', [CarController::class,'show'])->name('cars.show');

Route::get('/feltoltes', [CarController::class, 'create'])->middleware('auth')->name('cars.create');
Route::post('/feltoltes', [CarController::class, 'store'])->middleware('auth')->name('cars.store');

Route::get('/reg', [UserController::class,'RegForm']);
Route::post('/reg', [UserController::class,'RegButton']);
Route::get('/login', [UserController::class,'Login'])->name('login');
Route::post('/login', [UserController::class,'LoginButton']);
Route::get('/logout', [UserController::class,'Logout']);
Route::get('/users', [UserController::class, 'ListUsers'])->name('users.index');
Route::get('/users/{id}/edit', [UserController::class, 'EditUser'])->name('users.edit');
Route::post('/users/{id}', [UserController::class, 'UpdateUser'])->name('users.update');
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');
Route::get('/profil', [UserController::class, 'Profile'])->name('profile.show')->middleware('auth');
Route::post('/profil', [UserController::class, 'update'])->name('profile.update')->middleware('auth');
