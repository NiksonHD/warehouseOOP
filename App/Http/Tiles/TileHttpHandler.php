<?php

namespace App\Http\Tiles;

use App\Data\CellsDTO;
use App\Data\TileDTO;
use App\Http;
use App\Service\Tiles\TileServiceInterface;
use App\Service\UserServiceInterface;
use Exception;

class TileHttpHandler extends Http\HttpHandlerAbstract {

    public function edit($tileService, $getData, $formData) {
        if ($_SESSION["access"] === false) {
            $this->redirect('index.php');
        }
        if (isset($formData['cell'])) {

            if (isset($getData['article'])) {
                $this->handleEditProcces($tileService, $getData, $formData);
                exit;
            }
            $cell = $formData['cell'];
            // $tilesInCell = $this->getArticlesInCell($cell);
            $this->redirect("edit_article.php?cell=$cell");
        } else {
            if (isset($getData['output'])) {
                $tileDTO = $tileService->getTileInfoByInput($getData['output']);
                $tileDTO->setCellFromInput($getData['cellOutput']);
                $this->render('tiles/edit_cell', [$tileDTO], null);
            } else {
                $this->render('tiles/edit_cell', ['tile'=>null], null);
            }
        }
    }

    public function edit_article($tileService, $getData, $formData) {
        if ($_SESSION["access"] === false) {
            $this->redirect('index.php');
        }
        if (isset($formData['article'])) {
            $this->handleEditProcces($tileService, $getData, $formData);
        }
//        if(isset($formData['edit_cell'])){
//            $cell = $formData['cell'];
//            $this->getArticlesInCell($cell);
//        }
        else {
            $cell = $getData['cell'];
            $cellInDigits = $this->digitsToLettersAdress($cell);
            $tiles = $tileService->getArticlesCell($cellInDigits);
            $tileDTOArray = [];
            foreach ($tiles as $t) {
                $tile = $tileService->getTileInfoByInput($t);
                $tileDTOArray [] = $tile;
            }
            $this->render('tiles/edit_article', ['cell'=>$cellInDigits, 'tile'=>$tileDTOArray], [null]);
        }
    }

    public function find(TileServiceInterface $tileService, UserServiceInterface $userService, $formData, $getData) {
        $dateBack5hours =  date('Y-m-d H:i', strtotime("-5 hours")) ;

        $tileService->delete5HoursDaily($dateBack5hours);
        $user = null;
        if($userService->isLogged()){
            $user = $userService->currentUser();
        }
        
        if (isset($formData['tileNumber'])) {
            $inputData = $formData['tileNumber'];
            $tileService->insertDaily($inputData);
            $this->handleFindProcess($tileService, $inputData);
        }
        if (isset($getData['cell'])) {
            $inputData = $getData['cell'];
            $this->handleFindProcess($tileService, $inputData);
        } if (isset($getData['sap'])) {
            $inputData = $getData['sap'];
            $this->handleFindProcess($tileService, $inputData);
        } else {
        $this->render('tiles/find', ['tile'=>null, 'user'=>$user], [null]);
        }
    }

    public function handleFindProcess(TileServiceInterface $tileService, $inputData) {

        try {
            $tileArray[] = $inputData;
            if (strlen($inputData) == 3 || strlen($inputData) == 4) {
                $cellInDigits = $this->digitsToLettersAdress($inputData);
                $tiles = $tileService->getArticlesCell($cellInDigits);
                $tileArray = $tiles;
            }
            $tileDTOArray = [];
            foreach ($tileArray as $tileNum) {

                /** @var CellsDTO $cells */
                /** @var TileDTO $tile */
                $array = [];
                $tile = $tileService->getTileInfoByInput($tileNum);
                $cells = $tileService->getTileAdressById($tile->getId());
                foreach ($cells as $cell) {
                    $array[] = $cell;
                }
                $tile->setCells($array);
                $tile->setShowPic($_SESSION["showPic"]);
                $tileDTOArray [] = $tile;
            }
            $this->render('tiles/find', ['tile'=>$tileDTOArray,'user' =>null], [null]);
        } catch (Exception $ex) {
            $this->render('tiles/find', ['tile'=>null,null], [$ex->getMessage()]);
        }
    }

    function digitsToLettersAdress($tileNumber) {
        if (strlen($tileNumber) == 3 || strlen($tileNumber) == 4) {
            $tileAdress = $tileNumber;
            $lastCharIndex = strlen($tileAdress) - 1;
            $firstChar = substr($tileAdress, 0, 1);
            $lastChar = substr($tileAdress, -1);
            if ($firstChar == '1') {
                $tileAdress[0] = 'a';
            } elseif ($firstChar == '2') {
                $tileAdress[0] = 'b';
            } elseif ($firstChar == '3') {
                $tileAdress[0] = 'c';
            } elseif ($firstChar == '4') {
                $tileAdress[0] = 'd';
            } elseif ($firstChar == '5') {
                $tileAdress[0] = 'e';
            } elseif ($firstChar == '6') {
                $tileAdress[0] = 'o';
            }
            if ($lastChar == '1') {
                $tileAdress[$lastCharIndex] = 'a';
            } elseif ($lastChar == '2') {
                $tileAdress[$lastCharIndex] = 'b';
            } elseif ($lastChar == '3') {
                $tileAdress[$lastCharIndex] = 'c';
            } elseif ($lastChar == '4') {
                $tileAdress[$lastCharIndex] = 'd';
            } elseif ($lastChar == '5') {
                $tileAdress[$lastCharIndex] = 'e';
            } elseif ($lastChar == '6') {
                $tileAdress[$lastCharIndex] = 'f';
            }
            $tileAdress = ucfirst($tileAdress);
            return $tileAdress;
        } else {
            return $tileNumber;
        }
    }

    public function handleEditProcces(TileServiceInterface $tileService, $getData, $formData) {

        try {
            /** @var TileDTO $tileDTO */
            if (isset($getData['article'])) {

                $tileDTO = $tileService->getTileInfoByInput($getData['article']);

                $cellInDigits = $this->digitsToLettersAdress($formData['cell']);
                $cellId = $tileService->getCellId($cellInDigits);
            } else {
                if ($formData['article'] === "0") {
                    $cellId = $tileService->getCellId($getData['cell']);
                    $tile = $tileService->getTileInfoByInput($getData['cell']);
                    $tileService->deleteCellArticleMap($cellId);
                    $sap = $tile->getSap();
                    $this->redirect("index.php?sap=$sap");
                }
                $tileDTO = $tileService->getTileInfoByInput($formData['article']);
                $cellInDigits = $this->digitsToLettersAdress($getData['cell']);
                $cellId = $tileService->getCellId($cellInDigits);
            }
            $tileDTO->setCellFromInput($cellId);

            $sapNum = $tileDTO->getSap();
            $tileService->deleteCellArticleMap($cellId);

            $result = $tileService->changeArticleAdress($tileDTO->getCellFromInput(), $tileDTO->getId());
            if ($result !== 1) {
                throw new Exception("Неподходящи данни за запис!");
            }
            $cell = $tileDTO->getCellFromInput();
            $this->redirect("index.php?cell=$cellInDigits");
        } catch (Exception $ex) {
            if ($ex->getCode() == 2) {
            $this->render('tiles/edit_cell', ['tile' =>null], [$ex->getMessage()]);
            } else {
                $this->render('tiles/edit_article', ['tile' =>null, 'cell' => null], [$ex->getMessage()]);
            }
        }
    }

    public function getArticlesInCell($cell) {
        $cellInDigits = $this->digitsToLettersAdress($cell);
        $tileString = $this->tileService->getTilesStringByCell($cellInDigits)["sap_num"];

        $tileString = trim($tileString);
        $tileArray = explode(' ', $tileString);

        try {
            foreach ($tileArray as $tileNum) {
                /** @var TileDTO $tile */
                $tile = $this->tileService->getTileInfoByInput($tileNum);
                $tile->setCellFromInput($cellInDigits);

                $output [] = $tile;
            }
            $this->render('tiles/edit_article', $output, [null]);
        } catch (Exception $ex) {
            $tile = new TileDTO();
            $tile->setCellFromInput($cellInDigits);
            $tile->setSapNum($ex->getMessage());
            $output [] = $tile;
            $this->render('tiles/edit_article', $output, [$ex->getMessage()]);
        }
    }

    public function enanbleDisablePics($tileService, $formData) {
        
    }

    public function showDaily(TileServiceInterface $tileService, $formData, $getData) {
        $dailySearches = $tileService->getAllDaily();
        $this->render('daily/show_all', ['tile'=>$dailySearches]);
    }

    public function menu() {
        $this->render('menu/main',[null]);
    }

    public function multiEditCell(TileServiceInterface $tileService, $formData, $getData) {
        if ($_SESSION["access"] === false) {
            $this->redirect('index.php');
        }
        if (isset($formData['cell'])) {
            $cell = $this->digitsToLettersAdress($formData['cell']);
            try {
                $cellExist = $tileService->getCellId($cell);
                $this->redirect("edit_article_multi.php?cell=$cell");
            } catch (Exception $ex) {
            $this->render('tiles/edit_cell_multi', null, [$ex->getMessage()]);
            }
        } else {
            if (isset($formData['article'])) {
                $this->render('tiles/edit_article_multi', [$cell], [null]);
            }
            $this->render('tiles/edit_cell_multi', ['tile' => null], null);
        }
    }

    public function multiEditArticle(TileServiceInterface $tileService, $formData, $getData) {
        if ($_SESSION["access"] === false) {
            $this->redirect('index.php');
        }
        if (isset($getData['cell'])) {
            $cell = $getData['cell'];
        }
        if (isset($formData['article'])) {
            try {
                $tile = $tileService->getTileInfoByInput($formData['article']);
                $cellId = $tileService->getCellId($cell);
                $articleId = $tile->getId();
                $tileService->changeArticleAdress($cellId, $articleId);
                $this->render('tiles/edit_article_multi', [$cell, [$tile]], [null]);
            } catch (Exception $ex) {
                $this->render('tiles/edit_article_multi', [$cell], [$ex->getMessage()]);
            }
        }
        $this->render('tiles/edit_article_multi', [$cell], [null]);
    }

    public function multiDeleteCell(TileServiceInterface $tileService, $formData, $getData) {
        if ($_SESSION["access"] === false) {
            $this->redirect('index.php');
        }
        if (isset($formData['cell'])) {
            $cell = $this->digitsToLettersAdress($formData['cell']);
            try {
                $cellExist = $tileService->getCellId($cell);
                $this->redirect("delete_article_multi.php?cell=$cell");
            } catch (Exception $ex) {
                $this->render('tiles/delete_cell_multi', null, [$ex->getMessage()]);
            }
        } else {
            if (isset($formData['article'])) {
                $this->render('tiles/edit_artddddicle_multi', [$cell], [null]);
            }
            $this->render('tiles/delete_cell_multi', ['tile' => null], null);
        }
    }

    public function multiDeleteArticle(TileServiceInterface $tileService, $formData, $getData) {
        if ($_SESSION["access"] === false) {
            $this->redirect('index.php');
        }
        if (isset($getData['cell'])) {
            $cell = $getData['cell'];
        }
        if (isset($formData['article'])) {
            try {
                $tile = $tileService->getTileInfoByInput($formData['article']);
                $cellId = $tileService->getCellId($cell);
                $articleId = $tile->getId();

                $tileService->deleteAllArticlesMap($cellId, $articleId);
                $this->render('tiles/delete_article_multi', ['cell' => $cell, 'tile' =>[$tile]], [null]);
            } catch (Exception $ex) {
                $this->render('tiles/delete_article_multi', ['cell' => $cell], [$ex->getMessage()]);
            }
        }
        $this->render('tiles/delete_article_multi', [$cell], [null]);
    }

    public function lastChanges($tileService, $formData, $getData) {
        $currentDate = date('Y-m-d');
        $date = $currentDate;
        if (isset($formData['input_date']) && $formData['input_date'] !== '') {
            $date = $formData['input_date'];
        }

        $changes = $tileService->getLastMapChanges($date);

        $this->render('tiles/last_changes', [$changes], null);
    }

}
