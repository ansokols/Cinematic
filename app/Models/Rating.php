<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'ratings';
    protected $fillable = [
        'type',
        'name',
        'like',
        'dislike'
    ];

    protected $hidden = [
        'remember_token'
    ];
}
