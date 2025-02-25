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
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id');
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');

            $table->unsignedBigInteger('block_id');
            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('cascade');
            $table->string("table");
            $table->string("label");
            $table->string("name");
            $table->string("type");
            $table->string("default_value")->nullable();
            $table->integer("display_type")->default(1);
            $table->integer('sequence');
            $table->integer('readonly')->default(0);
            $table->integer('required')->default(0);
            $table->integer('column')->default(0);
            $table->integer('search')->default(0);
            $table->integer('duplicate_handling')->default(0);
            $table->integer('summary')->default(0);
            $table->integer('unique')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fields');
    }
};
