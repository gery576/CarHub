<?php

Route::get('/logout', [UserController::class, 'Logout'])->name('logout');
