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
        Schema::create('related_entries_alls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module');
            $table->foreign('module')->references('id')->on('modules')->onDelete('cascade');
            $table->unsignedBigInteger('related_module');
            $table->foreign('related_module')->references('id')->on('modules')->onDelete('cascade');
            $table->integer('module_id');
            $table->integer('related_id');
            $table->tinyInteger('relation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('related_entries_alls');
    }
};
