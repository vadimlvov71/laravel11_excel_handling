<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    use HasFactory;
    
    protected $table = 'rubrics';
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;
}
