<?php

namespace App\Repository\Tiles;

use App\Data\CellsDTO;
use App\Data\DatabaseAbstract;
use App\Data\TileDTO;

class TileRepository extends DatabaseAbstract implements TileRepositoryInterface {

    public function findTileAdressById(string $id) {
        $result = $this->db->query("
                            SELECT cells.cell as cell, map.create_date as updateDate
                            FROM `map`
                            INNER JOIN cells
                            ON map.cell_id = cells.id
                            AND map.article_id = ?;
                            ")->execute([$id])
                ->fetchAssoc();
        foreach ($result as $row) {
            $cellAdress = $this->dataBinder->bind($row, CellsDTO::class);
            yield $cellAdress;
        }
    }

    public function findTileInfoBySap(string $sapNum) {
        return $result = $this->db->query(
                        'SELECT 
                        id,
                        sap,
                        name,
                        ean,
                        quantity,
                        pic_path as picPath,
                        update_date as updateDate
                        FROM 
                        articles 
                        WHERE sap = ?
                        ')->execute([$sapNum])
                ->fetchOne(TileDTO::class);
    }

    public function findTileInfoByEan(string $ean) {
        return $result = $this->db->query(
                        'SELECT 
                        id,
                        sap,
                        name,
                        ean,
                        quantity,
                        pic_path as picPath,
                        update_date as updateDate
                        FROM 
                        articles 
                        WHERE ean = ?
                        ')->execute([$ean])
                ->fetchOne(TileDTO::class);
    }

    public function findTilesStringByCell(string $cellId) {
        return $result = $this->db->query("SELECT cells.cell as cell, map.create_date as updateDate, articles.sap
                            FROM `map`
                            INNER JOIN cells
                            ON map.cell_id = cells.id
                            JOIN articles 
                            ON map.article_id = articles.id
                            AND map.cell_id = ?
                                            ")->execute([$cellId])
                                            ->fetchAssoc();
    }

    public function editArticleAdress($cell, $article) {
        $result = $this->db->query("INSERT INTO map
                                    (article_id, cell_id)
                                    VALUES (?, ?)
                                    ")->execute([$article, $cell]);
        return $result->rowCount();
    }

    public function findCellId($cell) {
        return $this->db->query('SELECT 
                                    id 
                                    FROM
                                    cells
                                    WHERE
                                    cell = ?'
                        )->execute([$cell])
                        ->fetchOne(CellsDTO::class);
    }

    public function findSapByCell($cell) {
        return $this->db->query('    
                                SELECT articles.sap
                                FROM `map`
                                INNER JOIN articles
                                ON map.article_id = articles.id
                                INNER JOIN cells
                                ON map.cell_id = cells.id
                                AND cells.cell = ?
                                ')->execute([$cell])
                        ->fetchOne(TileDTO::class);
    }

    public function removeCellArticleMap($cellId) {
        return $this->db->query('
                                DELETE  
                                FROM map 
                                WHERE `map`.cell_id = ?
                                ')->execute([$cellId])
                        ->rowCount();
    }

    public function findAllDaily() {
        $result = $this->db->query('SELECT daily.id, daily.article_id, create_date, sap, name
                                     FROM daily
                                     JOIN articles
                                     ON daily.article_id = articles.id
                                     ORDER BY daily.create_date DESC
                                    ')->execute()
                ->fetchAssoc();
        foreach ($result as $row) {
            $cellAdress = $this->dataBinder->bind($row, \App\Data\DailyDTO::class);
            yield $cellAdress;
        }
    }

    public function editDaily($article_id) {
        return $this->db->query('INSERT INTO daily
                                (article_id)
                                VALUES
                                (?)
                                ')->execute([$article_id])
                        ->rowCount();
    }

    public function checkAccess($ip) {
        return $this->db->query('SELECT * 
                                 FROM access
                                 WHERE ip = ?
                                ')->execute([$ip])
                        ->fetchOne(\App\Data\IpDTO::class);
    }

    public function editList($listDTO) {
        $this->db->query('INSERT INTO list
                                (list_string, comment)
                                VALUES
                                (?, ?)
                                ')->execute([$listDTO->getListString(), $listDTO->getComment()])
                ->rowCount();
        return $this->db->lastInserId();
    }

    public function findOneList($id) {
        return $this->db->query('SELECT id, list_string as listString, comment, update_date as updateDate
                          FROM list
                          WHERE id = ?
                        ')->execute([$id])
                        ->fetchOne(\App\Data\ListDTO::class);
    }

    public function getAllLists($date) {
        $date = '%' . $date . '%';
        $result = $this->db->query('SELECT id, comment, update_date as updateDate
                                FROM list
                                WHERE update_date like ? 
                                ORDER BY update_date DESC
                                ')->execute([$date])
                ->fetchAssoc();
        foreach ($result as $row) {
            $lists = $this->dataBinder->bind($row, \App\Data\ListDTO::class);
            yield $lists;
        }
    }

    public function deleteAllArticleMap($cellId, $articleId) {
        return $this->db->query('
                                DELETE  
                                FROM map 
                                WHERE `map`.cell_id = ?
                                AND map.article_id = ?
                                ')->execute([$cellId, $articleId])
                        ->rowCount();
        
        
    }

    public function findTileInfoById($id) {
        return $result = $this->db->query(
                        'SELECT 
                        id,
                        sap,
                        name,
                        ean,
                        quantity,
                        pic_path as picPath,
                        update_date as updateDate
                        FROM 
                        articles 
                        WHERE id = ?
                        ')->execute([$id])
                ->fetchOne(TileDTO::class);
    }

    public function findLastChanges($date) {
         $date = '%' . $date . '%';
        $result = $this->db->query('SELECT articles.sap, cells.cell, map.create_date as updateDate, articles.name, map.id,
                                    articles.pic_path as path
                                    FROM `map` 
                                    JOIN articles
                                    ON map.article_id = articles.id
                                    JOIN cells
                                    ON map.cell_id = cells.id
                                    AND map.create_date LIKE ?
                                    ORDER BY map.create_date DESC

                                ')->execute([$date])
                ->fetchAssoc();
        foreach ($result as $row) {
            $lists = $this->dataBinder->bind($row, \App\Data\MapDTO::class);
            yield $lists;
        }
    }

    public function delete5HoursBackDaily($date) {
         return $this->db->query('
                                DELETE FROM 
                                daily
                                WHERE create_date < ?
                                ')->execute([$date])
                                ->rowCount();
    }

    public function insertIp($ip) {
         return $this->db->query('INSERT INTO access
                                (ip)
                                VALUES
                                (?)
                                ')->execute([$ip])
                        ->rowCount();
    }

    public function insertArticleInfo($sap) {
        return $this->db->query('INSERT INTO articles
                                (sap)
                                VALUES
                                (?)
                ')->execute([$sap])
                ->rowCount();
    }

}
