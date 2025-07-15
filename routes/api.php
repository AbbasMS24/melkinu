<?php
    use App\Http\Controllers\ProvinceCitiesController;
    use App\Http\Controllers\SaleController;
    use App\Http\Controllers\TicketController;
    use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
use App\Http\Controllers\CPerson;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SUserC;
use App\Models\father;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KarshenasanController;
=======
    Route::prefix("tickets")->group(function(){
        Route::post("sendTicket", [TicketController::class, "store"]);
        Route::get("fetchTickets", [TicketController::class, "fetch"]);
        Route::patch("updateStatus", [TicketController::class, "updateStatus"]);
    });
>>>>>>> 52f08a77737c8dd9138f906fc281d27595c79cb0

    Route::prefix("officers")->group(function(){
        Route::post("register", [SaleController::class, "register"]);
        Route::get("saleRequests", [SaleController::class, 'fetchData']);
        Route::patch("updateStatus", [SaleController::class, "updateStatus"]);
        Route::post("saleRefer", [SaleController::class, "refer"]);
    });

    Route::prefix("regions")->group(function(){
        Route::post("register", [ProvinceCitiesController::class, "register"]);
        Route::get("fetchProvinces", [ProvinceCitiesController::class, "fetchProvince"]);
        Route::patch("updateProvinces", [ProvinceCitiesController::class, "updateProvince"]);
        Route::delete("deleteProvinces", [ProvinceCitiesController::class, "deleteProvince"]);
    });

<<<<<<< HEAD


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
=======
>>>>>>> 52f08a77737c8dd9138f906fc281d27595c79cb0
