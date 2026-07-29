<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recipe::create([
            'name' => 'Engorde Bovino Premium',
            'description' => 'Receta alimenticia para mejorar la ganancia de peso.',
            'objective' => 'Aumento de peso',
            'frequent_use' => 'Diario',
            'filter_species' => 'Bovino',
            'min_age_filter' => 6,
            'max_age_filter' => 48,
            'min_weight_filter' => 200.00,
            'recommended_duration_days' => 90,
            'suitable_for_gestation' => true,
            'suitable_for_location' => true,
            'farm_id' => 1,
        ]);
    }
}
