<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use App\Models\Goods;

class GoodsImport implements ToModel, WithChunkReading
{
    /**
    * @param Collection $collection
    */
    use RemembersRowNumber;
    public function model(array $row)
    {
        //$currentRowNumber => $this->getRowNumber();
        /*echo "<pre>";
        print_r($row);
        echo "</pre>";
        echo "currentRowNumber".$currentRowNumber."<br>";*/
        //exit;
       /*return new Goods([
        'rubrics_id' => $row[1],
        'sub_rubrics_id' => $row[2],
        'goods_categories_id' => $row[3],
        'manufacturer_id' => $row[4],
        'name' => $row[5],
        'model_code' => $row[6],
        'description' => $row[7],
        'price' => $row[8],
        'guarantee' => $row[9],
        'status' => $row[10],
        ]);*/
    }
     /*-
    public function collection(Collection $rows)
    {

        $currentRowNumber => $this->getRowNumber();
        foreach ($rows as $row) 
        {
            echo "<pre>";
            print_r($row);
            /*User::create([
                'name' =>> $row[0]  =>> $row[0],
            ]);
        }
    }
    */
    
    public function chunkSize(): int
    {
        return 20;
    }
}
