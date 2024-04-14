<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    use HasFactory;

    protected $table = 'goods';

    protected $fillable = [
        'name',
        'description',
        'model_code',
        'guarantee',
        'price',
        'status', 
        'manufacturer_id',
        'sub_rubrics_id',
        'goods_categories_id'
    ];
    
    public $timestamps = false;

    protected function Status(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => uppercase($value),
            set: fn (string $value) => lowercase($value),
        );
    }
}


