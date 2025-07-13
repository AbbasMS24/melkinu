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
        Schema::create('tickets_workflow', function (Blueprint $table) {
            $table->id();
            $table->integer('tr_code');
            $table->string('sender');
            $table->string('receptor')->nullable();
            $table->date('date');
            $table->time('time');
            $table->string('title');
            $table->text('content');
            $table->string('attachment')->nullable();
            $table->string('station')->nullable();
            $table->timestamps();
        
            $table->foreign('tr_code')->references('tr_code')->on('tickets_status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets_workflow');
    }
};
