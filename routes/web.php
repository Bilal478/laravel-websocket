<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\DropdownController;

Route::get('/', [DropdownController::class, 'index']);
Route::post('/select-option', [DropdownController::class, 'selectOption']);

// Route::get('/', function () {
//     return view('welcome');
// });

