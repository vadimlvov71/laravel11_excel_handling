<?php

namespace App\Repositories;

use App\Models\Rubric;
use App\Interfaces\RepositoryInterface;

class RubricRepository implements RepositoryInterface
{
    public function __construct(Rubric $model)
    {
        $this->model = $model;
    }
    public function handler(&$item)
    {
        $name = $item[0];

        $is_exist = $this->isExist($name);
        $result = [];
        if ($is_exist === 0) {
            $id = $this->create($item);
            $result["insert"] = $id; 
        } else{
            $result["is_exist"] = $is_exist;
            $id = $is_exist;
        }
        $item[0] = $id;

        return $result;
    }

    public function create(array $item)
    {
        $name = $item[0];
        $model = new Rubric();
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
