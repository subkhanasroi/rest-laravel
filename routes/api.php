<?php

use App\Http\Controllers\Api\ForgotPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;

/**
 * route "/register"
 * @method "POST"
 */
Route::post('/register', RegisterController::class)->name('register');
/**
 * route "/login"
 * @method "POST"
 */
Route::post('/login', LoginController::class)->name('login');

Route::get('/users', [UserController::class, 'index']);
Route::post('/users/{id}/photo', [UserController::class, 'uploadPhoto']); 
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);


/**
 * route "/user"
 * @method "GET"
 */
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
