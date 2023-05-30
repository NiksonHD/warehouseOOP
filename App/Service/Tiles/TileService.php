<?php

namespace App\Service\Tiles;

class TileService implements TileServiceInterface
{

    /**
     *
     * @var \App\Repository\Tiles\TileRepositoryInterface
     */
    private $repository;

    public function __construct(\App\Repository\Tiles\TileRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getTileAdressById(string $id)
    {

        return $this->repository->findTileAdressById($id);
    }

    public function getTileInfoByInput(string $input)
    {

        if ($input === '') {
            throw new \Exception('Невалидни данни ! -> '.$input);
        }
        if ($this->repository->findTileInfoBySap($input) && strlen($input) == 1) {
            return $this->repository->findTileInfoBySap($input);
        }
        if (strlen($input) == 3 || strlen($input) == 4) {
            if (!$tile = $this->repository->findSapByCell($input)) {
                throw new \Exception('Невалидни данни или <br> празна клетка! -> '.$input, 1);
            }

            return $this->repository->findTileInfoBySap($tile->getSap());
        }
        if ($this->repository->findTileInfoBySap($input) && strlen($input) == 6) {
            return $this->repository->findTileInfoBySap($input);
        }
        if ($this->repository->findTileInfoByEan($input) && strlen($input) == 13) {
            return $this->repository->findTileInfoByEan($input);
        }
        throw new \Exception('Невалидни данни! ->  '.$input, 1);
    }

    public function getTilesStringByCell(string $input)
    {
        return $this->repository->findTilesStringByCell($input);
    }

    public function changeArticleAdress($cell, $article)
    {
        return $this->repository->editArticleAdress($cell, $article);
    }

    public function getCellId($cell)
    {
        if (!$cellsDTO = $this->repository->findCellId($cell)) {
            throw new \Exception('Невалидни данни! ->  '.$cell, 2);
        }

        return $cellsDTO->getId();
    }

    public function deleteCellArticleMap($cellId)
    {
        return $this->repository->removeCellArticleMap($cellId);
    }

    public function getAllDaily()
    {
        return $this->repository->findAllDaily();
    }

    public function insertDaily($input)
    {
        if ($this->repository->findTileInfoBySap($input) && strlen($input) == 6) {
            $tile = $this->repository->findTileInfoBySap($input);
            $ip = ($_SERVER["REMOTE_ADDR"]);

            return $this->repository->editDaily($tile->getId(), $ip);
        }
        if ($this->repository->findTileInfoByEan($input) && strlen($input) == 13) {
            $tile = $this->repository->findTileInfoByEan($input);
            $ip = ($_SERVER["REMOTE_ADDR"]);

            return $this->repository->editDaily($tile->getId(), $ip);
        }
    }

    public function deleteCellMap($cellId)
    {

    }

    public function checkAccess($ip)
    {
        return $this->repository->checkAccess($ip);
    }

    public function getArticlesCell($cell)
    {
        if (!$cellDTO = $this->repository->findCellId($cell)) {
            throw new \Exception('Невалидни данни или <br> празна клетка! -> '.$cell, 1);
        }
        $articles = $this->repository->findTilesStringByCell($cellDTO->getId());
        $tiles = [];
        foreach ($articles as $article) {
            $tiles [] = $article['sap'];
        }
        if (empty($tiles)) {
            throw new \Exception('Невалидни данни или <br> празна клетка! -> '.$cell, 1);
        }

        return $tiles;
    }

    public function deleteAllArticlesMap($cellId, $articleId)
    {
        $article = $this->getTileInfoById($articleId);
        $result = $this->repository->deleteAllArticleMap($cellId, $articleId);
        if ($result == 0) {
            throw new \Exception(
                'В клетката не съществува артикул: <br>'.$article->getSap().' '.$article->getName(), 1
            );
        }
    }

    public function getTileInfoById($articleId)
    {
        return $this->repository->findTileInfoById($articleId);
    }

    public function getLastMapChanges($date)
    {

        return $changes = $this->repository->findLastChanges($date);


    }

    public function delete5HoursDaily($date)
    {
        return $this->repository->delete5HoursBackDaily($date);

    }

    public function registerIp($ip)
    {
        return $this->repository->insertIp($ip);
    }

    public function getTileInfoBySap($sap)
    {
        if ($this->repository->findTileInfoBySap($sap)) {
            return $this->repository->findTileInfoBySap($sap);
        } else {
            $this->repository->insertArticleInfo($sap);

            return $this->repository->findTileInfoBySap($sap);
        }
    }

    public function getAllDailyByIp()
    {
        $ip = ($_SERVER["REMOTE_ADDR"]);

        return $this->repository->getAllDailyByIp($ip);
    }

}
