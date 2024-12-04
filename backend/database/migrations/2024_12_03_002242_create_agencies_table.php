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
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('agency_name')->nullable();
            $table->string('contact_no_1')->nullable();
            $table->string('contact_no_2')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_person')->nullable();
            
            
            $table->unsignedBigInteger('assigned_to_picklist')->nullable();
            $table->foreign('assigned_to_picklist')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('agencies');
    }
};
