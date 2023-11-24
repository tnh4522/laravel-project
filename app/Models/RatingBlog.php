<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingBlog extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'rating';
    protected $fillable = [
        'id_user',
        'id_blog',
        'rating',
    ];
}
