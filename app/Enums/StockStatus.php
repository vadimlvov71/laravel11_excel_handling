<?php

namespace App\Enums;

enum StockStatus: string
{
    case in_stock = 'есть в наличие';
    case out_of_stock = 'нет в наличии';

}