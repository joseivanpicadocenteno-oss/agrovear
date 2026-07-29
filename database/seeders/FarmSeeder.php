<?php

namespace Database\Seeders;

use App\Models\Farm;
use Illuminate\Database\Seeder;

class FarmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Farm::create([
            'name' => 'Granja El Progreso',
            'department' => 'Estelí',
            'municipality' => 'Condega',
            'address' => 'Km 5 carretera norte',
            'phone' => '88889999',
            'description' => 'Granja principal de Agrovear',
            'active' => true,
            'user_id' => 1,
        ]);
    }
}