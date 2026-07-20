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
        Schema::create('feeding_records', function (Blueprint $table) {
            $table->id();
            $table->date('feeding_date');
            $table->decimal('amount_served', 8, 2);
            $table->decimal('estimated_feed_cost', 8, 2); //Calculado automáticamente a partir de la receta y sus productos.

            $table->foreignId('animal_id')
            ->constrained('animals')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId('gestation_record_id')
            ->nullable()
            ->constrained('gestation_records')
            ->nullOnDelete();

            $table->foreignId('recipe_id')
            ->constrained('recipes')
            ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feeding_records');
    }
};
