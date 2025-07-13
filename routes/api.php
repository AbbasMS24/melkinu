<?php

use App\Http\Controllers\CPerson;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SUserC;
use App\Models\father;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





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