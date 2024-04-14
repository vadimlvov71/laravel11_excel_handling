<?php
namespace App\DataFixing;

use Illuminate\Support\Facades\Storage;

class ImportFileFixing
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
    public static function getValuesBeReplaced(): array
    {
        //$content = json_encode(["Test" => "Заменить", "Test" => "Электроинструменты"]);
        //$orders = Storage::put('fixes.json',  $content);
        $values_be_replaced = Storage::json('fixes.json');
        return $values_be_replaced;
    }
    /**
     * @param array $item
     * @param array $values_be_replaced
     * 
     * @return void
     */
    public static function replaceWrongValue(array &$item, array &$values_be_replaced): void
    {
        $item[0] = $values_be_replaced[$item[0]];
    }
    /**
     * There is a situation when a subric is empty
     * @param array $item
     * 
     * @return void
     */
    public static function  whenIncompleteCount(array &$item): void
    {
        $temp = [];
        $y = 0;
        $temp[0] = $item[0];
        for ($i = 1; $i <= 9; $i++) {
            $temp[$i] = $item[$y];
            $y++;
        }
        $item = $temp;
    }
    public static function  emptyNameBeFilled(array &$item): void
    {
        $pieces = explode(" ", $item[6]);
        $first_part = implode(" ", array_splice($pieces, 0, 2));

        $item[4] = $first_part;
    }
}
