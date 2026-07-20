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
        Schema::create('gestation_records', function (Blueprint $table) {

            $table->id();

            $table->date('service_date');
            $table->date('estimated_birth_date')->nullable();
            $table->date('actual_birth_date')->nullable();

            $table->unsignedTinyInteger('live_births')->nullable();
            $table->unsignedTinyInteger('stillbirths')->nullable();

            $table->text('observations')->nullable();

            $table->boolean('active')->default(true);

            $table->foreignId('animal_id')
            ->constrained('animals')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gestation_records');
    }
};