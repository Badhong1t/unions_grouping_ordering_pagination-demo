<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\queryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/query', [queryController::class, 'index']);

