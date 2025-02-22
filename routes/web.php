<?php

use App\Http\Controllers\UserController;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-container', function (Request $request) {
    return $request->input('key');
});

Route::get('/test-provider', function () {
    $userService = app(UserServices::class);
    return $userService->listUsers();
});

Route::get('/test-users', [UserController::class, 'index']);

Route::get('/test-facade', function () {
    $userService = app(UserServices::class);
    return response()->json($userService->listUsers());
});
