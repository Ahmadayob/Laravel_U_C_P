<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable =['author', 'content', 'post_id'];
    protected $guarded = ['id']; 

    public function post(){
        return $this->belongsTo(Post::class); 
    }
}
