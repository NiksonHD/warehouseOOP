<?php

namespace App\Repository\Tiles;

interface TileRepositoryInterface {

    public function findTileAdressById(string $id);

    public function findTileInfoByEan(string $ean);

    public function findTileInfoBySap(string $sapNum);

    public function findTilesStringByCell(string $cell);

    public function editArticleAdress($cell, $article);

    public function findCellId($cell);

    public function findSapByCell($cell);

    public function removeCellArticleMap($cellId);

    public function findAllDaily();

    public function editDaily($article_id);

    public function checkAccess($ip);

    public function editList($listDTO);

    public function findOneList($id);

    public function getAllLists($date);

    public function deleteAllArticleMap($cellId, $articleId);
    
    public function findTileInfoById($id);
    
    public function findLastChanges($date);
    
    public function delete5HoursBackDaily($date);
    
    public function insertIp($ip);
    
    public function insertArticleInfo($sap);
}
