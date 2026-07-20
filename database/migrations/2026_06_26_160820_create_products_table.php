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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->integer('unit_measurement');
            $table->integer('current_stock');
            $table->decimal('min_stock', 10, 2);
            $table->decimal('unit_cost', 10, 2);
            $table->decimal('historical_average_price', 10, 2);
            $table->date('last_purchase_date');
            $table->string('regular_supplier');
            $table->string('batch');
            $table->date('expiration_date');

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
        Schema::dropIfExists('products');
    }
};
