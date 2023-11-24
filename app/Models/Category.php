<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = TRUE;
    protected $table = 'categories';
    protected $fillable = ['category'];
    public function brands()
    {
        return $this->hasMany(Brand::class, 'category_id', 'id');
    }
}
