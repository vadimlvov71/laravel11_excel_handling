<?php

namespace App\Repositories;

use App\Models\SubRubric;
use App\Interfaces\RepositoryInterface;

class SubRubricRepository implements RepositoryInterface
{
    public function __construct(SubRubric $model)
    {
        $this->model = $model;
    }
    public function handler(&$item)
    {
        $name = $item[1];
        $rubrics_id = $item[0];
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
        $item[1] = $id;
        return $result;
    }

    public function create(array $item)
    {
        $name = $item[1];
        $rubrics_id = $item[0];

        $model = new SubRubric();
        $model->name = $name;
        $model->rubrics_id = $rubrics_id;
        $model->save();   
        return $model->id;
    }

    public function isExist(string $name)
    {
        $result = 0;
        $model = $this->model->select('id')->where('name', '=', $name)->first();
        if ($model) {
            $result = $model->id;
        }
        return $result;
    }
    
}
