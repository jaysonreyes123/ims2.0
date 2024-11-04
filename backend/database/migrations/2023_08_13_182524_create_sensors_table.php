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
        Schema::create('sensors', function (Blueprint $table) {
            $table->bigIncrements('id'); 

            $table->unsignedBigInteger('station_id')->nullable();            
            $table->foreign('station_id')->references('id')->on('stations')->onDelete('cascade'); 

            $table->unsignedBigInteger('sensor_type')->nullable();
            $table->foreign('sensor_type')->references('id')->on('sensor_types'); 

            $table->string('status')->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensors');
    }
};
