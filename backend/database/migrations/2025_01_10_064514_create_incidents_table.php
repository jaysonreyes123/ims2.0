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

            $table->string('incident_types')->nullable();
            $table->string('incident_statuses')->nullable();
            $table->string('incident_priorities')->nullable();

            $table->time('time_of_incident')->nullable();
            $table->date('date_of_incident')->nullable();
            
            $table->text('remarks')->nullable();

            $table->string('location')->nullable();
            $table->string('street_name')->nullable();
            $table->string('nearest_landmark')->nullable();
            $table->string('coordinates')->nullable();

            $table->string('caller_firstname')->nullable();
            $table->string('caller_lastname')->nullable();
            $table->string('caller_contact')->nullable();

            $table->string('incident_resolution')->nullable();

            $table->string('responder_team')->nullable();
            $table->string('assigned_by')->nullable();
            $table->string('assigned_team')->nullable();


            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');

            
            $table->timestamps();

            $table->tinyInteger('deleted')->default(0);
            $table->string('source')->default('crm');
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
