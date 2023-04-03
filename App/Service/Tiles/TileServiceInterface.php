<?php


namespace App\Service\Tiles;





interface TileServiceInterface {

    public function getTileAdressById(string $id);
    
    public function getTileInfoByInput(string $input);
    
    public function getTilesStringByCell(string $input);
    
    public function changeArticleAdress($cell, $article);
    
    public function getCellId($cell);
    
    public function deleteCellArticleMap($cellId);
    
    public function getAllDaily();
    
    public function insertDaily($article_id);
    
    public function deleteCellMap($cellId);
    
    public function checkAccess($ip);
    
    public function getArticlesCell($cell);
    
    
    public function deleteAllArticlesMap($cellId, $articleId);
    
    public function getTileInfoById($articleId);
    
    public function getLastMapChanges($date);
    
    public function delete5HoursDaily($date);
    
    public function registerIp($ip);
    
    public function getTileInfoBySap($sap);
    
    public function getAllDailyByIp();

}
