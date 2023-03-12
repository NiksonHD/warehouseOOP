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
