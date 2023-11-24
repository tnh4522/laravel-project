<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'histories';
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'total',
    ];
}
