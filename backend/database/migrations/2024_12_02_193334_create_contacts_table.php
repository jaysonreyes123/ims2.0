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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('mobile')->nullable();
            $table->string('landline')->nullable();
            $table->string('email')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('created_by')->nullable();

            $table->unsignedBigInteger('caller_types_picklist')->nullable();
            $table->foreign('caller_types_picklist')->references('id')->on('caller_types')->onDelete('cascade');

            $table->string('street_name')->nullable();

            $table->unsignedBigInteger('barangays_picklist')->nullable();
            $table->foreign('barangays_picklist')->references('id')->on('barangays')->onDelete('cascade');

            $table->unsignedBigInteger('municipalities_picklist')->nullable();
            $table->foreign('municipalities_picklist')->references('id')->on('municipalities')->onDelete('cascade');

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
        Schema::dropIfExists('contacts');
    }
};
