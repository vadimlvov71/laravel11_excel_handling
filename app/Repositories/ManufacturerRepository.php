<?php

namespace App\Repositories;

use App\Models\Manufacturer;
use App\Interfaces\RepositoryInterface;

class ManufacturerRepository
{
    public function __construct(Manufacturer $model)
    {
        $this->model = $model;
    }
    public function handler(&$item)
    {
        $name = $item[3];

        $is_exist = $this->isExist($name);
        $result = [];
        if ($is_exist === 0) {
            $id = $this->create($item);
            $result["insert"] = $id; 
        } else{
            $result["is_exist"] = $is_exist;
            $id = $is_exist;
        }
        $item[3] = $id;

        return $result;
    }

    public function create(array $item)
    {
        $name = $item[3];
        $model = new Manufacturer();
        $model->name = $name;
        $model->save(); 

        return $model->id;
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
