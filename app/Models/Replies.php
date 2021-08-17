<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'post_body', 
        'user_id', 
        'topic_id'
    ];
}
