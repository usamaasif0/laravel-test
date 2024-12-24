<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/signup', [AuthController::class, 'sign_up']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/login', function () {
    return response()->json(['message' => 'Unauthenticated.'], 401);
})->name('login');


Route::group(['middleware' => ["auth:sanctum"]], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Route::resource('tasks', TaskController::class);
    Route::group(['middleware' => ["my_tasks"]], function () {
        Route::put('tasks/{id}', [TaskController::class, 'update']);
    });

    Route::get('tasks', [TaskController::class, 'index']);
    Route::post('tasks', [TaskController::class, 'store']);
    Route::get('tasks/{id}', [TaskController::class, 'show']);
    Route::delete('tasks/{id}', [TaskController::class, 'destroy']);
});
