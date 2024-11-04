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
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('dashboard');
            $table->boolean('warning');
            $table->boolean('database');
            $table->boolean('monitoring');
            $table->boolean('sensor');
            $table->boolean('station');
            $table->boolean('maintenance_warning');
            $table->boolean('notification');
            $table->boolean('recipient');
            $table->boolean('user');
            $table->boolean('user_role');
            $table->boolean('system');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};
