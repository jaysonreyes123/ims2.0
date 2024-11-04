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
        Schema::create('sensor_data', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->unsignedBigInteger('sensor_id');            
            $table->foreign('sensor_id')->references('id')->on('sensors')->onDelete('cascade'); 
            $table->decimal('value',60, 2); 
            $table->dateTime('timestamp')->index('timestamp'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_data');
    }
};
