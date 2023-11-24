<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Blog extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'content',
        'image',
        'id_user',
        'description',
    ];
    public function author() {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
    public function rating() {
        return $this->hasMany(RatingBlog::class, 'id_blog', 'id');
    }
    public function comment() {
        return $this->hasMany(CommentBlog::class, 'id_blog', 'id');
    }
}
