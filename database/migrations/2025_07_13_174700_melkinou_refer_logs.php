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
        Schema::create("melkinou_refer_logs", function(Blueprint $table){
            $table->id();
            $table->integer("tr_code");
            $table->string("sender");
            $table->string("receptor");
            $table->string("date");
            $table->string("time");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("melkinou_refer_logs");
    }
};
