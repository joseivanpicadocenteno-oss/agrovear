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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('objective');
            $table->string('frequent_use');
            $table->string('filter_species');
            $table->unsignedInteger('min_age_filter');
            $table->unsignedInteger('max_age_filter');
            $table->decimal('min_weight_filter', 8, 2);
            $table->integer('recommended_duration_days');
            $table->boolean('suitable_for_gestation')->default(true);
            $table->boolean('suitable_for_location')->default(true);

            $table->foreignId('farm_id')
            ->constrained()
            ->cascadeOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
