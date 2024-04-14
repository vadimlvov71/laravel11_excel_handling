<?php

namespace App\Helpers;

class ArrayHandlerHelper
{
    
   
    /**
     * @param array $item
     * @param string $step
     * 
     * @return void
     */
    public static function fixValuesOrder(array &$item, string $step): void
    {
        $keys = array_keys($item);
        //echo "keys:: ".$keys."<br>";
        $temp = [];
        foreach($item as $key => $value){
           
            if($step == '1' && $key !== 0){
                $temp[] = $value;
            } else if ($step == '2' && $key > 1) {
                $temp[] = $value;
            }
        }
        $item = $temp;
        //return $result;
    }
}