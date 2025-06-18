<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts(Request $request)
    {
        $query = Product::with('category');

        // Filtro por tipo si se proporciona
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        // Filtro por múltiples categorías si se proporciona
        if ($request->has('categories')) {
            $query->whereIn('category_id', $request->categories);
        }

        $products = $query->get();

        return response()->json($products);
    }

    public function search(Request $request)
{
    $query = Product::with('category')
    ->where(function ($q) use ($request) {
        $q->where('name', 'LIKE', "%{$request->text}%")
          ->orWhere('description', 'LIKE', "%{$request->text}%");
    });

if ($request->has('type')) {
    $query->where('type', $request->type);
}

$products = $query->get();
return response()->json($products);
}


public function show($id)
{
    $product = Product::find($id);
    if (!$product) {
        $data = [
            'status' => false,
            'message' => 'Product not found'
        ];
        return response()->json($data, 404);
    }

    $data = [
        'status' => 200,
        'product' => $product,
        'message' => "Product found"
    ];

    return response()->json($data, 200);
}
}
