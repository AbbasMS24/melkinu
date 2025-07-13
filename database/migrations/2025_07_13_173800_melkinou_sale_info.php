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
        Schema::create("melkinou_sale_info", function(Blueprint $table){
            $table->id();
            $table->string("sale_reason");
            $table->string("commission_price");
            $table->string("visiting_time");
            $table->string("sale_duration_suggestion");
            $table->string("sale_duration");
            $table->string("customer_no"); // number of customers who visited the land
            $table->string("not_saling_reason");
            $table->string("id_no");
            $table->string("place_exp");
            $table->string("national_card");
            $table->integer("tr_code");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("melkinou_sale_info");
    }
};
