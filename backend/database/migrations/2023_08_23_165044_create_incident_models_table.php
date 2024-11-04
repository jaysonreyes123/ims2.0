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
        Schema::create('incident_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("sensor_id");
            $table->foreign("sensor_id")->references("id")->on("sensors")->onDelete('cascade');

            $table->unsignedBigInteger("warning_id");
            $table->foreign("warning_id")->references("id")->on("warnings")->onDelete("cascade");

            $table->tinyInteger('status')->default(1);
            $table->decimal("value",60,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_models');
    }
};
