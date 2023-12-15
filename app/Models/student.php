<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class student extends Model
{
    use HasFactory; 
    use SoftDeletes;

    protected $table = "student"; 
    protected $fillable = [
        'name', 
        'address', 
        'email'
    ];

    protected $hidden = [];
}
