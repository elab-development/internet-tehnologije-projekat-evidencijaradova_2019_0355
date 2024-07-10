<?php

use App\Http\Controllers\Authorization\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);

Route::get('/schools', [SchoolController::class, 'index']);
Route::get('/schools/pg', [SchoolController::class, 'indexPg']);
Route::get('/schools/{id}', [SchoolController::class, 'show']);

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/pg', [CourseController::class, 'indexPg']);
Route::get('/courses/{id}', [CourseController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

    Route::resource('schools', SchoolController::class)
    ->only(['store', 'update', 'destroy']);
    Route::resource('courses', CourseController::class)
        ->only(['store', 'update', 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});