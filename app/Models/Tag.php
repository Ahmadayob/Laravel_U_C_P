<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'id';
    protected $keyType = 'string'; // UUID Universally Unique Identifier  
    public $incrementing = false;
    protected $table = 'tags';

    protected $fillable = ['title']; // fields that can be updated

    protected $guarded = ['id']; // fields that cannot be updated

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

}
