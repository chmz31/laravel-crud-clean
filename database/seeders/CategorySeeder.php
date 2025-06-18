<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Categorías principales
        $haircare = Category::create([
            'name' => 'Cuidado Capilar',
            'parent_id' => null
        ]);

        $skincare = Category::create([
            'name' => 'Cuidado Facial',
            'parent_id' => null
        ]);

        $delivery = Category::create([
            'name' => 'Servicios Especiales',
            'type' => 'Delivery',
            'parent_id' => null
        ]);

        // Subcategorías bajo Cuidado Capilar
        Category::create([
            'name' => 'Champús',
            'parent_id' => $haircare->id
        ]);

        Category::create([
            'name' => 'Mascarillas Capilares',
            'parent_id' => $haircare->id
        ]);

        // Subcategorías bajo Cuidado Facial
        Category::create([
            'name' => 'Cremas faciales',
            'parent_id' => $skincare->id
        ]);

        Category::create([
            'name' => 'Sérums',
            'parent_id' => $skincare->id
        ]);

        // Subcategorías bajo Servicios Especiales
        Category::create([
            'name' => 'Packs Regalo',
            'type' => 'Delivery',
            'parent_id' => $delivery->id
        ]);

        Category::create([
            'name' => 'Envío Exprés',
            'type' => 'Delivery',
            'parent_id' => $delivery->id
        ]);
    }
}
