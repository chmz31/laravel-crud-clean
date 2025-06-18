<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories(Request $request)
    {
        $type = $request->query('type', 'Productos'); // por defecto 'Productos'

        $categories = Category::where('type', $type)
            ->whereNull('parent_id')
            ->with('subcategories') // para mostrar subcategorías después si fuera necesario
            ->get();

        return response()->json($categories);
    }
}
