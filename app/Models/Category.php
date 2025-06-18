<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'parent_id'
    ];

    // Subcategorías (relación con sus hijos)
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Categoría padre (relación con su padre)
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Productos relacionados
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
