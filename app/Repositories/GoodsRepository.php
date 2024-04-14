<?php

namespace App\Repositories;

use App\Models\Goods;
use App\Enums\StockStatus;
use App\Interfaces\RepositoryInterface;

class GoodsRepository implements RepositoryInterface
{
    public function __construct(Goods $model)
    {
        $this->model = $model;
    }
    public function handler(&$item)
    {
        $name = $item[4];
       // if(!empty($name)){
            $is_exist = $this->isExist($name);
        $result = [];
        if ($is_exist === 0) {
            $id = $this->create($item);
            $result["insert"] = $id; 
        } else{
            $result["is_exist"] = $is_exist;
        }
        return $result;
    }
    public function create(array $item)
    {
 
        $status = StockStatus::from($item[9]);

        $model = new Goods();
        $model->sub_rubrics_id = $item[1];
        $model->goods_categories_id = $item[2];
        $model->manufacturer_id = $item[3];
        $model->name = $item[4];
        $model->model_code = $item[5];
        $model->description = $item[6];
        $model->price = $item[7];
        $model->guarantee = $item[8];
        $model->status = $status->name; 

        $model->save(); 
             
        return true;
    }
    public function isExist(string $name)
    {
        $result = 0;
        $getModel = $this->model->select('id')->where('name', '=', $name)->first();
        if ($getModel) {
            $result = $getModel->id;
        }
        return $result;
    }
    

}
