<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("melkinou_tech_info", function(Blueprint $table){
            $table->id();
            $table->string("building_age");
            $table->string("license_status");
            $table->string("land_property");
            $table->string("floor_no"); // number of floors
            $table->string("floor_room_no"); // number of rooms in one floor
            $table->string("land_direction");
            $table->string("cash_budget");
            $table->integer("tr_code");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("melkinou_tech_info");
    }
};
