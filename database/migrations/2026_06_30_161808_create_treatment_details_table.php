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
        Schema::create('treatment_details', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity_used', 8, 2);
            $table->string('frequency');
            $table->text('instructions');

            $table->foreignId('treatment_id')
            ->constrained('treatments')
            ->cascadeOnDelete();

            $table->foreignId('product_id')
            ->constrained('products')
            ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatment_details');
    }
};
