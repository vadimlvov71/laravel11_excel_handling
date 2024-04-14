<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubRubric extends Model
{
    use HasFactory;
    
    protected $table = 'sub_rubrics';
    protected $fillable = [
        'name',
        'rubrics_id'
    ];
    public $timestamps = false;
}
