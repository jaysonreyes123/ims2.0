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
        Schema::create('warnings', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->unsignedBigInteger('sensor_id');            
            $table->foreign('sensor_id')->references('id')->on('sensors')->onDelete('cascade'); 
            $table->decimal('sensor_thresholds',60, 2);  
            $table->string('status')->nullable();  
            $table->string('color')->nullable();  

            $table->boolean('is_check')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();            
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('updated_by')->nullable();            
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warnings');
    }
};
