<?php

namespace Database\Seeders;

use App\Models\Animal;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Animal::create([
            'name' => 'Luna',
            'birth_date' => '2025-01-15',
            'breed' => 'Brahman',
            'species' => 'Bovino',
            'weight_kg' => 380.00,
            'last_weighing' => now(),
            'target_weight' => 550.00,
            'sex' => 'Hembra',
            'reproductive_status' => 'Gestante',
            'purchase_price' => 16000.00,
            'estimated_price' => 20000.00,
            'active' => true,
            'farm_id' => 1,
        ]);
    }
}
