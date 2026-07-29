<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Concentrado Bovino Premium',
            'type' => 'Alimento',
            'unit_measurement' => 50,
            'current_stock' => 100,
            'min_stock' => 20,
            'unit_cost' => 850.00,
            'historical_average_price' => 830.00,
            'last_purchase_date' => now(),
            'regular_supplier' => 'AgroVet Nicaragua',
            'batch' => 'LT-001',
            'expiration_date' => now()->addYear(),
            'farm_id' => 1,
        ]);
    }
}
