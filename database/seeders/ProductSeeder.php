<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Subcategorías de Productos
        $champu = Category::where('name', 'Champús')->first();
        $crema = Category::where('name', 'Cremas faciales')->first();
        $serum = Category::where('name', 'Sérums')->first();

        Product::create([
            'name' => 'Champú Fortalecedor Repair+',
            'description' => 'Champú con biotina y colágeno para cabellos frágiles.',
            'price' => 15.99,
            'type' => 'Productos',
            'category_id' => $champu->id
        ]);

        Product::create([
            'name' => 'Crema Hidratante Noche Intensa',
            'description' => 'Tratamiento nocturno profundo con ácido hialurónico.',
            'price' => 22.50,
            'type' => 'Productos',
            'category_id' => $crema->id
        ]);

        Product::create([
            'name' => 'Sérum Antioxidante Vitamin C+',
            'description' => 'Ilumina, unifica y combate los signos de fatiga.',
            'price' => 27.00,
            'type' => 'Productos',
            'category_id' => $serum->id
        ]);

        // Productos tipo Delivery
        $sets = Category::where('name', 'Packs Regalo')->first();
        $express = Category::where('name', 'Envío Exprés')->first();

        Product::create([
            'name' => 'Pack de Regalo Piel Radiante',
            'description' => 'Incluye sérum, crema hidratante y tónico facial.',
            'price' => 49.90,
            'type' => 'Delivery',
            'category_id' => $sets->id
        ]);

        Product::create([
            'name' => 'Servicio de Entrega 24h Premium',
            'description' => 'Recibe tu pedido en menos de 24 horas.',
            'price' => 4.99,
            'type' => 'Delivery',
            'category_id' => $express->id
        ]);
    }
}
