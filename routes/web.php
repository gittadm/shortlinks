<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LinkController::class, 'create']);
Route::post('/', [LinkController::class, 'store'])->name('links.store');
Route::get('/{key}', [LinkController::class, 'redirectToLink']);
