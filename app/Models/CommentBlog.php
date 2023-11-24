<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentBlog extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'comments';
    protected $fillable = [
        'id_user',
        'id_blog',
        'name_user',
        'id_parent',
        'comment',
        'image_user',
    ];
    public function blog() {
        return $this->belongsTo(Blog::class, 'id_blog', 'id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    public function parent() {
        return $this->belongsTo(CommentBlog::class, 'id_parent', 'id');
    }
}
