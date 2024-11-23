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
        Schema::create('sensor_status', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sensor_id');
            $table->foreign("sensor_id")->references("id")->on('sensors')->onDelete('cascade');
            $table->bigInteger('count')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_status');
    }
};
