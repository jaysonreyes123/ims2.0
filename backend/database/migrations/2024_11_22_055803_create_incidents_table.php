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
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string('incident_no')->nullable();

            $table->unsignedBigInteger('incident_types_picklist')->nullable();
            $table->foreign('incident_types_picklist')->references('id')->on('incident_types')->onDelete('cascade');

            $table->time('time_of_incident')->nullable();
            $table->date('date_of_incident')->nullable();

            $table->unsignedBigInteger('incident_statuses_picklist')->nullable();
            $table->foreign('incident_statuses_picklist')->references('id')->on('incident_statuses')->onDelete('cascade');

            $table->unsignedBigInteger('incident_priorities_picklist')->nullable();
            $table->foreign('incident_priorities_picklist')->references('id')->on('incident_priorities')->onDelete('cascade');
            
            $table->text('remarks')->nullable();

            $table->string('location')->nullable();
            $table->string('street_name')->nullable();
            $table->string('nearest_landmark')->nullable();
            $table->string('coordinates')->nullable();

            $table->string('caller_firstname')->nullable();
            $table->string('caller_lastname')->nullable();
            $table->string('caller_contact')->nullable();

            $table->string('response_team')->nullable();
            $table->string('assigned_by')->nullable();
            $table->json('assigned_team')->nullable();

            $table->tinyInteger('deleted')->default(0);
            $table->string('source')->default('crm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
