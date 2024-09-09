<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
