<?php

use App\Http\Controllers\CPerson;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SUserC;
use App\Models\father;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KarshenasanController;





Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/reg", [CPerson::class, "register"]);
Route::get("/getData/{id}" , [CPerson::class, "getData"])->middleware('auth:sanctum');

Route::post("/register",[PostController::class, "register"])->middleware('auth:sanctum');
Route::get("/getdata", [PostController::class, "read"])->middleware('auth:sanctum');

Route::post('/register', [SUserC::class, 'register']);
Route::post('/login', [SUserC::class, 'login']);

Route::get('/unauthenticated', [SUserC::class, 'unauthenticated'])->name("login");

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // مدیریت کارشناسان
    Route::get('/karshenasan', [KarshenasanController::class, 'index']);
    Route::put('/karshenasan/{id}', [KarshenasanController::class, 'update']);
    Route::delete('/karshenasan/{id}', [KarshenasanController::class, 'destroy']);

    // گرفتن لیست level برای front-end
    Route::get('/levels', [KarshenasanController::class, 'getLevels']);
});