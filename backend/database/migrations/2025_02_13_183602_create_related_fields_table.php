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
        Schema::create('related_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module');
            $table->foreign('module')->references('id')->on('modules')->onDelete('cascade');
            $table->unsignedBigInteger('related_module');
            $table->foreign('related_module')->references('id')->on('modules')->onDelete('cascade');
            $table->unsignedBigInteger('fieldid');
            $table->foreign('fieldid')->references('id')->on('fields')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('related_fields');
    }
};
