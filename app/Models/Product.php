<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'products';
    protected $fillable = [
        'brand_id',
        'category_id',
        'user_id',
        'web_id',
        'name',
        'price',
        'image',
        'availability',
        'condition',
        'sales',
        'description',
        'details',
        'manufacturer',
    ];
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
