<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchers extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'user_id', 
        'topic_id'
    ];
}
