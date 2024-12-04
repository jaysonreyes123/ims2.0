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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('resources_name')->nullable();

            $table->unsignedBigInteger('resources_types_picklist')->nullable();
            $table->foreign('resources_types_picklist')->references('id')->on('resources_types')->onDelete('cascade');

            $table->unsignedBigInteger('resources_statuses_picklist')->nullable();
            $table->foreign('resources_statuses_picklist')->references('id')->on('resources_statuses')->onDelete('cascade');

            $table->string('coordinates')->nullable();

            $table->unsignedBigInteger('dispatchers_picklist')->nullable();
            $table->foreign('dispatchers_picklist')->references('id')->on('resources_dispatchers')->onDelete('cascade');

            $table->unsignedBigInteger('conditions_picklist')->nullable();
            $table->foreign('conditions_picklist')->references('id')->on('resources_conditions')->onDelete('cascade');

            $table->integer('quantity')->default(1);
            $table->string('contact_info')->nullable();
            $table->date('date_acquired')->nullable();
            $table->text('remarks')->nullable();
            $table->string('owner')->nullable();
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
        Schema::dropIfExists('resources');
    }
};
