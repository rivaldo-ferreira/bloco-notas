<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;

Route::middleware([CheckIsNotLogged::class])->group(function () {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);
});

Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/newNote', [MainController::class, 'newNote'])->name('new');
    Route::post('/newNoteSubmit', [MainController::class, 'newNoteSubmit'])->name('newNoteSubmit');

    //edit note
    Route::get('/editNote/{id}', [MainController::class, 'editNote'])->name('edit');
    Route::get('/editNoteSubmit', [MainController::class, 'editNoteSubmit'])->name('editNoteSubmit');
    //delete note
    Route::get('/deleteNote/{id}', [MainController::class, 'deleteNote'])->name('delete');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
