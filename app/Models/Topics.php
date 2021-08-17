<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'title', 
        'post_body', 
        'user_id'
    ];
}
