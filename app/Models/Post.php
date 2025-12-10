<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, HasUlids;
    protected $primaryKey = 'id';
    protected $keyType = 'string'; // UUID Universally Unique Identifier  
    public $incrementing = false;

    protected $table = 'posts';

    protected $fillable = ['title', 'body', 'published', 'author']; // fields that can be updated

    protected $guarded = ['id']; // fields that cannot be updated

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
