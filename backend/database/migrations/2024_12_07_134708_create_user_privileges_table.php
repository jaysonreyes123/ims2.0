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
        Schema::create('user_privileges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('incidents')->default(true);
            $table->boolean('resources')->default(true);
            $table->boolean('preplans')->default(true);
            $table->boolean('contacts')->default(true);
            $table->boolean('agencies')->default(true);
            $table->boolean('responders')->default(true);
            $table->boolean('incident_map')->default(true);
            $table->boolean('heat_map')->default(true);
            $table->boolean('call_logs')->default(true);
            $table->boolean('users')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_privileges');
    }
};
