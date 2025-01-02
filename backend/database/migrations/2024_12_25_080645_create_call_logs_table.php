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
        Schema::create('call_logs', function (Blueprint $table) {
            $table->id();

            $table->string('date_and_time')->nullable();
            $table->string('time_answered')->nullable();
            $table->string('time_end')->nullable();
            $table->string('duration')->nullable();
            $table->string('from_no')->nullable();
            $table->string('to_no')->nullable();
            $table->string('call_id')->nullable();

            $table->unsignedBigInteger('assigned_to_picklist')->nullable();
            $table->foreign('assigned_to_picklist')->references('id')->on('users')->onDelete('cascade');

            $table->integer('deleted')->default(0);
            $table->string('source')->default('crm');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_logs');
    }
};