<?php
    use App\Http\Controllers\ProvinceCitiesController;
    use App\Http\Controllers\SaleController;
    use App\Http\Controllers\TicketController;
    use Illuminate\Support\Facades\Route;

    Route::prefix("tickets")->group(function(){
        Route::post("sendTicket", [TicketController::class, "store"]);
        Route::get("fetchTickets", [TicketController::class, "fetch"]);
        Route::patch("updateStatus", [TicketController::class, "updateStatus"]);
    });

    Route::prefix("officers")->group(function(){
        Route::post("register", [SaleController::class, "register"]);
        Route::get("saleRequests", [SaleController::class, 'fetchData']);
        Route::patch("updateStatus", [SaleController::class, "updateStatus"]);
        Route::delete("saleRefer", [SaleController::class, "refer"]);
    });

    Route::prefix("regions")->group(function(){
        Route::post("register", [ProvinceCitiesController::class, "register"]);
        Route::get("fetchProvinces", [ProvinceCitiesController::class, "fetchProvince"]);
        Route::patch("updateProvinces", [ProvinceCitiesController::class, "updateProvince"]);
        Route::delete("deleteProvinces", [ProvinceCitiesController::class, "deleteProvince"]);
    });

