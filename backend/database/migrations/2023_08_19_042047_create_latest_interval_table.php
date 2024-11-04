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
        Schema::create('latest_intervals', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("station_id");
            $table->foreign("station_id")->references('id')->on('stations')->onDelete('cascade');
            $table->timestamp('timestamp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latest_intervals');
    }
};
