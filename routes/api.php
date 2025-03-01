<?php

use App\Http\Middleware\userMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    echo 'Welcome API - Test Middlewar';
})->middleware(userMiddleware::class);
