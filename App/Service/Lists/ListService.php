<?php

namespace App\Service\Lists;

class ListService implements ListServiceInterface {

    /**
     *
     * @var \App\Repository\Tiles\TileRepositoryInterface
     */
    private $repository;

    public function __construct(\App\Repository\Tiles\TileRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function getTileAdressById(string $id) {

        return $this->repository->findTileAdressById($id);
    }

    public function getTileInfoByInput(string $input) {
        if ($input == '' || $input == 0) {
            throw new \Exception('Невалидни данни ! -> ' . $input);
        }
        if ($this->repository->findTileInfoBySap($input) && strlen($input) == 1) {
            return $this->repository->findTileInfoBySap($input);
        }
        if (strlen($input) == 3 || strlen($input) == 4) {
            (!$tile = $this->repository->findSapByCell($input)) ? throw new \Exception('Невалидни данни или празна клетка! ->' . $input, 1) : '';
            return $this->repository->findTileInfoBySap($tile->getSap());
        }
        if ($this->repository->findTileInfoBySap($input) && strlen($input) == 6) {
            return $this->repository->findTileInfoBySap($input);
        }
        if ($this->repository->findTileInfoByEan($input) && strlen($input) == 13) {
            return $this->repository->findTileInfoByEan($input);
        }
        throw new \Exception('Невалидни данни! ->  ' . $input, 1);
    }

    public function getTilesStringByCell(string $input) {
        return $this->repository->findTilesStringByCell($input);
    }

    public function changeArticleAdress($cell, $article) {
        return $this->repository->editArticleAdress($cell, $article);
    }

    public function getCellId($cell) {
        if (!$cellsDTO = $this->repository->findCellId($cell)) {
            throw new \Exception('Невалидни данни! ->  ' . $cell, 2);
        }
        return $cellsDTO->getId();
    }

   

   
    public function insertDaily($input) {
        if ($this->repository->findTileInfoBySap($input) && strlen($input) == 6) {
            $tile = $this->repository->findTileInfoBySap($input);
            return $this->repository->editDaily($tile->getId());
        }
        if ($this->repository->findTileInfoByEan($input) && strlen($input) == 13) {
            $tile = $this->repository->findTileInfoByEan($input);
            return $this->repository->editDaily($tile->getId());
        }
    }

    public function deleteCellMap($cellId) {
        
    }

    public function checkAccess($ip) {
        return $this->repository->checkAccess($ip);
    }

    public function insertList($articles) {
        $errors = [];
        $comment = '';
        if ($articles['comment'] != "") {
            $comment = $articles['comment'];
        } else {
            $errors['e9'] = 'Моля въведи коментар!';
        }
        array_pop($articles);
        array_pop($articles);
        $currentKey = 1;
        $listString = implode(' ', $articles);
        $listString = trim($listString);
        foreach ($articles as $key => $article) {
            if ($key === 'a' . $currentKey) {
                if ($this->repository->findTileInfoBySap($article) && strlen($article) == 6) {
                    $tiles [] = $this->repository->findTileInfoBySap($article);
                } elseif ($article !== '') {
                    $errors ['e' . $currentKey] = 'Невалиден код!';
                }
                $currentKey++;
            }
        }
        $list = new \App\Data\ListDTO();

        $list->setListString($listString);
        $list->setErrors($errors);
        $list->setComment($comment);
        if (empty($errors) && $listString != '') {
            $listId = $this->repository->editList($list);
            $list->setId($listId);
        }
        return $list;
    }

    public function findOne($id) {
        $list = $this->repository->findOneList($id);
        $listArray = explode(' ', $list->getListString());
        foreach ($listArray as $key => $item) {
            $findedCells = [];
            if (strlen($item) == 6) {
                $tile = $this->getTileInfoByInput($item);
                $cells = $this->getTileAdressById($tile->getId());
                if (key_exists($key + 1, $listArray)) {
                    $tile->setLoads($listArray[$key + 1]);
                }

                foreach ($cells as $cell) {
                    $findedCells [] = $cell;
                }
                $tile->setCells($findedCells);
                $tile->setShowPic($_SESSION["showPic"]);
                $tiles [] = $tile;
                $list->setTiles($tiles);
            }
        }
        return $list;
    }

    public function findAll($date) {
        return $this->repository->getAllLists($date);
    }

}
