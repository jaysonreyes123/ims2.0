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
        Schema::create('notification_settings', function (Blueprint $table) { 
            $table->bigIncrements('id');

            $table->unsignedBigInteger("sensor_id");
            $table->foreign("sensor_id")->references('id')->on('sensors')->onDelete('cascade');

            $table->string('name');
            $table->text('body');
            $table->json('recipient'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_settings');
    }
};
