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
        Schema::create("melkinou_saling_access_logs", function (Blueprint $table){
            $table->id();
            $table->integer("tr_code");
            $table->string("date");
            $table->string("time");
            $table->string("ip_address");
            $table->string("user_agent");
            $table->string("status")->default("1");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("melkinou_saling_access_logs");
    }
};
