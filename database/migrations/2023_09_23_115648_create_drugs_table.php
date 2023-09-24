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
        Schema::create('drugs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->string('concentration');
            $table->string('active_ingredient')->nullable();
            $table->string('dosage_custom')->nullable();
            $table->string('dosage_morning')->nullable();
            $table->string('dosage_midday')->nullable();
            $table->string('dosage_evening')->nullable();
            $table->string('unit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drugs');
    }
};
