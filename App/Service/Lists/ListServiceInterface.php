<?php


namespace App\Service\Lists;




interface ListServiceInterface {

        
    public function insertList($listDTO);
    
    public function findOne($id);
    
    public function findAll($date);
    
    
}
