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
        Schema::create('incident_media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('incident_id');
            $table->foreign('incident_id')->references('id')->on('incidents')->onDelete('cascade');
            $table->string('filename');
            $table->string('extension');
            $table->string('filetype');
            $table->string("path");

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
        Schema::dropIfExists('incident_media');
    }
};
