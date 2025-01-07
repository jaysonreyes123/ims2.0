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
        Schema::create('resources_types', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->unsignedBigInteger('resources_categories_id')->nullable();
            $table->foreign('resources_categories_id')->references('id')->on('resources_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources_types');
    }
};
