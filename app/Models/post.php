<?php

namespace App\Models;
//use Illuminate\Database\Eloquent\Factories\HasFactory
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    // use HasFactory;

    protected $fillable = ['title', 'body', 'published']; // fields that can be updated

    protected $guarded = ['id']; // fields that cannot be updated

}
