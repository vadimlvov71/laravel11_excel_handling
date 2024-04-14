<?php

namespace App\Helpers;

class ResultMessageHelper
{
    public static array $message_result = [];
    public int $count_rubrics = 0;
    public int $count_sub_rubrics = 0;
    public int $count_items = 0;
    public int $count_categories = 0;
    public int $count_manufacturers = 0;
    public int $count_one_empty = 0;
    public int $count_two_empty = 0;
    public int $count_wrong_rubric_name = 0;
    public int $count_empty_sub_rubric = 0;
    
    public array $result_array = [];
    public function __construct($type, $name_rubric, $result)
    {
        /*
        $key = array_key_first($result);
        echo $key."<br>";
        $this->result_array[] = "zzzz";
        if($type = "rubric"){
            if ($key === "insert") {
                $this->result_array[] = self::$message_result["success"][]["insert"]["count_rubric"] = ++$this->count_rubrics; 
            } else{
                $this->result_array[] = self::$message_result["error"][]["insert"]["rubrics_exists"] = $name_rubric;
            }
        }
        */
    }
    public function setMessage($type, $name, $result)
    {
        $key = array_key_first($result);
        if ($type == "rubric") {
            if ($key === "insert") {
                $this->result_array["success"]["insert"]["count_rubric"] = ++$this->count_rubrics; 
            } else{
                $this->result_array["error"]["insert"][$name] = "rubrics_exists";
            }
        } else if ($type == "sub_rubric") {
            if ($key === "insert") {
                $this->result_array["success"]["insert"]["count_sub_rubric"] = ++$this->count_sub_rubrics; 
            } else{
                $this->result_array["error"]["insert"][$name] = "sub_rubric_exists";
            }
        } else if ($type == "category") {
            if ($key === "insert") {
                $this->result_array["success"]["insert"]["count_category"] = ++$this->count_categories; 
            } else{
                $this->result_array["error"]["insert"][$name] = "category_exists";
            }
        } else if ($type == "manufacturer") {
            if ($key === "insert") {
                $this->result_array["success"]["insert"]["count_manufacturers"] = ++$this->count_manufacturers; 
            } else{
                $this->result_array["error"]["insert"][$name] = "manufactur_exists";
            }
        } else if ($type == "item") {
            if ($key === "insert") {
                $this->result_array["success"]["insert"]["count_items"] = ++$this->count_items; 
            } else{
                $this->result_array["error"]["insert"][$name] = "items_exists";
            }
        } else if ($type == "one") {
                $this->result_array["success"]["fix_one_empty"]["count_one_empty"] = ++$this->count_one_empty; 
        } else if ($type == "two") {
                $this->result_array["success"]["fix_two_empty"]["count_two_empty"] = ++$this->count_two_empty; 
        } else if ($type == "wrong_rubric_name") {
                $this->result_array["success"]["wrong_rubric_name"]["count_replace_rubric_name"] = ++$this->count_wrong_rubric_name; 
                $this->result_array["wrong_rubric_name"][$result['name']] = "replaced by " . $name; 
        } else if ($type == "empty_sub_rubric") {
                $this->result_array["success"]["empty_sub_rubric"]["count_empty_sub_rubric"] = ++$this->count_empty_sub_rubric; 
                $this->result_array["empty_sub_rubric"][$name] = "added by rubric: "; 
        }
    }
    public function __invoke()
    {
        echo "7777<pre>";
        print_r($this->result_array);
        echo "</pre>";
        //return  "aa";
       //return self::$message_result;
    }
    public function getMessage()
    {
        echo "<pre>";
        print_r($this->result_array);
        echo "</pre>";
    }
    /*
    public function setResultMessage()
    {

    }
    */
    
    public function __toString(): string 
    {

        echo "<pre>";
                print_r($this->result_array);
                echo "</pre>";
        return  "aaaa";
    }
    
}