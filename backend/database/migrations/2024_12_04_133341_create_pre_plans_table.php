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
        Schema::create('pre_plans', function (Blueprint $table) {
            $table->id();
            $table->string('pre_plan_name')->nullable();
            
            $table->unsignedBigInteger('incident_types_picklist')->nullable();
            $table->foreign('incident_types_picklist')->references('id')->on('incident_types')->onDelete('cascade');

            $table->unsignedBigInteger('pre_plan_classifications_picklist')->nullable();
            $table->foreign('pre_plan_classifications_picklist')->references('id')->on('pre_plan_classifications')->onDelete('cascade');

            $table->text('initial_assessment')->nullable();
            $table->text('response_action')->nullable();
            $table->text('classification')->nullable();

            $table->string('incident_manager')->nullable();
            $table->string('incident_responder')->nullable();
            $table->string('support_staff')->nullable();

            $table->string('tools_and_equipment')->nullable();
            $table->string('personnel')->nullable();
            
            $table->integer('deleted')->default(0);
            $table->string('source')->default('crm');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_plans');
    }
};
