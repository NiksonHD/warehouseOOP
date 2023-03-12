<?php

namespace App\Http\Lists;

use App\Http;
use App\Service\Lists\ListServiceInterface;

class ListHttpHandler extends Http\HttpHandlerAbstract{

   
    public function edit(ListServiceInterface $listService, $formData, $getData){
        $articles = ["a1"=> "" ,"q1"=> "" ,"a2"=> "" ,"q2"=> "" ,"a3"=> "" ,"q3"=> "" ,"a4"=> "" ,"q4"=> "", "a5" => "" ,"q5" => "" ,"a6"=> "" ,"q6"=> "" ,"a7"=> "" ,"q7" => "" ,"a8"=> "" ,"q8"=> "", "comment"=> ""];
        if (isset($formData['search'])) {
            $articles = $formData;
            $list = $listService->insertList($articles);
            if(!empty($list->getErrors()) || $list->getListString() == ''){
            $this->render('lists/edit_list', [$articles,$list->getErrors()], null);
            } else {
                $listId = $list->getId();
                $this->redirect("list.php?listId=$listId");    
            }
        } else {
            if (isset($getData['listId'])) {
                $id = $getData['listId'];
                $this->showOne($listService,$id);
                
            } else {
                $this->render('lists/edit_list', [$articles,[]], null);
            }
        }
        
        
    }
    
    public function showOne($listService, $id){

      $list = $listService->findOne($id);
      $this->render('lists/one_list', [$list], null);
    }
    
    public function showAll($listService, $formData, $getData){
        $currentDate = date('Y-m-d');
        $lists = $listService->findAll($currentDate);
    $this->render('lists/all_lists', [$currentDate,$lists], null);
        
    }
}
