<?php

use App\Http\Controllers\UserController;

Route::get('/login', [UserController::class, 'Login'])->name('login');
