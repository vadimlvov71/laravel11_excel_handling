<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\RepositoryInterface;

class CategoryRepository implements RepositoryInterface
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }
    public function handler(&$item)
    {
        $name = $item[2];
        $sub_rubrics_id = $item[1];
        $is_exist = $this->isExist($name);
        $result = [];
        //echo "is_exist_rubric".$is_exist_rubric."<br>";
        if ($is_exist === 0) {
            $id = $this->create($item);
            $result["insert"] = $id; 
        } else{
            $result["is_exist"] = $is_exist;
            $id = $is_exist;
        }
        $item[2] = $id;
        return $result;
    }

    public function create(array $item)
    {
        $name = $item[2];
        $model = new Category();
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
