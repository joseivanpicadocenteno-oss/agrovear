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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birth_date')->nullable();
            $table->string('breed');
            $table->string('species');
            $table->decimal('weight_kg', 8, 2);
            $table->date('last_weighing');
            $table->decimal('target_weight', 8, 2);
            $table->string('sex', 10);
            $table->string('reproductive_status');
            $table->decimal('purchase_price', 10, 2);                                                                   
            $table->decimal('estimated_price', 10, 2);
            $table->boolean('active')->default(true);

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
        Schema::dropIfExists('animals');
    }
};
