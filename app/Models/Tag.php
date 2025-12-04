<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
     protected $table = 'tag';

    protected $fillable = ['title']; // fields that can be updated

    protected $guarded = ['id']; // fields that cannot be updated

}
