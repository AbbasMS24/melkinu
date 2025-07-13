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
        Schema::create("melkinou_land_info", function(Blueprint $table){
            $table->id();
            $table->string("officer");
            $table->string("sale_type");
            $table->string("land_type");
            $table->string("street");
            $table->string("alley");
            $table->string("house_number");
            $table->string("room_number");
            $table->integer("meter");
            $table->string("bed_roo_no");
            $table->string("region");
            $table->string("price");
            $table->integer("tr_code");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("melkinou_land_info");
    }
};
