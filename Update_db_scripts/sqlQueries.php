<?php

class sqlQueries {

    /**
     * 
     * @var PDO
     */
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function selectSapNum($sapNum) {
        $result = $this->db->prepare('SELECT * FROM tile_map WHERE sap_num = :sapNum');
        $result->bindParam('sapNum', $sapNum);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function updateQuantityAndEan($sapNum, $ean, $quantity) {
        $result = $this->db->prepare(
                'UPDATE tiles
            SET ean = :ean, quantity = :quantity
            WHERE sap_num = :sap_num');
        $result->bindParam('quantity', $quantity);
        $result->bindParam('ean', $ean);
        $result->bindParam('sap_num', $sapNum);
        $result->execute();
    }

    public function updateQuantity($sapNum, $ean, $quantity) {
        $result = $this->db->prepare(
                'UPDATE articles
            SET ean = :ean, quantity = :quantity
            WHERE sap = :sap');
        $result->bindParam('quantity', $quantity);
        $result->bindParam('ean', $ean);
        $result->bindParam('sap', $sapNum);
        $result->execute();
    }

//    public function getArticleInfoBySap($sapNum) {
//        $result = $this->db->prepare('SELECT * FROM tiles WHERE sap_num = :sap_num');
//        $result->bindParam('sap_num', $sapNum);
//        $result->execute();
//        return $result->fetch(PDO::FETCH_ASSOC);
//    }

    public function getArticleInfoBySap($sap) {
        $result = $this->db->prepare('SELECT * '
                . 'FROM articles '
                . 'WHERE sap = :sap');
        $result->bindParam('sap', $sap);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

//    
//    public function createArticleInfo($sapNum, $name, $ean, $quantity) {
//        $result = $this->db->prepare(
//                'INSERT INTO tiles ( sap_num, article_name, ean,quantity)
//            VALUES (:sap_num,:article_name, :ean, :quantity)');
//        $result->bindParam('sap_num', $sapNum);
//        $result->bindParam('article_name', $name);
//        $result->bindParam('ean', $ean);
//        $result->bindParam('quantity', $quantity);
//        $result->execute();
//    }

    public function createArticleInfo($sapNum, $name, $ean, $quantity) {
        $result = $this->db->prepare(
                'INSERT INTO articles ( sap, name, ean, quantity)
            VALUES (:sap, :name, :ean, :quantity)');
        $result->bindParam('sap', $sapNum);
        $result->bindParam('name', $name);
        $result->bindParam('ean', $ean);
        $result->bindParam('quantity', $quantity);
        $result->execute();
    }

    public function createMapCells($cell, $sapNum, $updateDate) {
        $result = $this->db->prepare(
                'INSERT INTO tile_map (tile_cell, sap_num, update_date ) 
            VALUES (:tile_cell,:sap_num, :update_date)');
        $result->bindParam('tile_cell', $cell);
        $result->bindParam('sap_num', $sapNum);
        $result->bindParam('update_date', $updateDate);
        $result->execute();
    }

    public function updateMap($cellId, $articleId, $createDate) {
        $result = $this->db->prepare(
                'INSERT INTO map
                                    (article_id, cell_id, create_date)
                                    VALUES (:articleId, :cellId, :createDate)');
        $result->bindParam('articleId', $articleId);
        $result->bindParam('cellId', $cellId);
        $result->bindParam('createDate', $createDate);
        $result->execute();
        return $result->rowCount();
    }

    public function getCellIdByCell($cell) {
        $result = $this->db->prepare('SELECT id 
                               FROM cells 
                               WHERE cell = :cell
                               ');
        $result->bindParam('cell', $cell);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function getArticleIdBySap($sap) {
        $result = $this->db->prepare('SELECT id 
                               FROM articles 
                               WHERE sap = :sap
                               ');
        $result->bindParam('sap', $sap);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllCells() {
        $result = $this->db->prepare(' SELECT cells.cell
                                       FROM cells
                                   ');
        $result->execute();
        $result->fetch(mode: PDO::FETCH_BOTH);
        return $result;
    }

    public function getArticles() {
        $result = $this->db->prepare(' SELECT *
                                        FROM articles
                                   ');
        $result->execute();
        $result->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateArticlesPath($sap, $path) {
        $result = $this->db->prepare(
                'UPDATE articles
            SET pic_path = :path
            WHERE sap = :sap');
        $result->bindParam('sap', $sap);
        $result->bindParam('path', $path);
        $result->execute();
    }

    public function getAllArticles() {
        $result = $this->db->query(' 
                    SELECT * 
                    FROM articles
                    ');
        $result->execute();
        $result->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getMapArticles() {
        $result = $this->db->prepare(' SELECT cells.cell, articles.sap, map.create_date
                                        FROM `map` 
                                        JOIN articles
                                        ON map.article_id = articles.id
                                        JOIN cells
                                        ON map.cell_id = cells.id
                                   ');
        $result->execute();
        $result->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function emptyMap() {
        $return = $this->db->query(' 
                                TRUNCATE map'
                )->execute();
    }

}
