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
        Schema::create('responders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('responder_types_picklist')->nullable();
            $table->foreign('responder_types_picklist')->references('id')->on('responder_types')->onDelete('cascade');

            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('contact_no')->nullable();

            $table->string('email_address')->nullable();
            $table->string('password')->nullable();

            $table->unsignedBigInteger('responder_statuses_picklist')->nullable();
            $table->foreign('responder_statuses_picklist')->references('id')->on('responder_statuses')->onDelete('cascade');

            $table->unsignedBigInteger('assigned_to_picklist')->nullable();
            $table->foreign('assigned_to_picklist')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('responders');
    }
};
