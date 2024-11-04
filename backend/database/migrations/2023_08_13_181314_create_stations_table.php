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
        Schema::create('stations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('code')->nullable();

            $table->string('name')->nullable();

            
            $table->decimal('river_bed',5,1)->nullable();
            $table->decimal('water_surface',5,1)->nullable();

            $table->text('coordinates')->nullable();
            $table->text('location')->nullable();    
            
            $table->unsignedBigInteger('created_by')->nullable();            
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('updated_by')->nullable();            
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');

            $table->smallInteger('status')->default(1);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stations');
    }
};
