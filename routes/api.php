<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('tasks')->controller(TaskController::class)->group(function () {
        Route::get('/', 'list');
        Route::post('/', 'store');
        Route::get('{task}', 'fetch');
        Route::patch('{task}', 'update');
        Route::delete('{task}', 'destroy');
    });
});
