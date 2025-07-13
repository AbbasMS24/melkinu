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
        Schema::create('tickets_status', function (Blueprint $table) {
            $table->id();
            $table->integer('tr_code')->unique(); // حالا عدد ترتیبی بین 1000 تا 9999
            $table->tinyInteger('status')->default(1); // 1: waiting, 2: customer, 3: admin, 4: closed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets_status');
    }
};
