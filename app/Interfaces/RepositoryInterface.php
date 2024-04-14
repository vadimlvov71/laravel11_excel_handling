<?php
namespace App\Interfaces;
 
/**
 * [structure of all Repositories]
 */
interface RepositoryInterface {
 
    public function handler(array &$item);
    
    public function create(array $item);
    
    public function isExist(string $name);
   
}
