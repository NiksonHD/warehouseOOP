<?php

use App\Http\Tiles\TileHttpHandler;
use App\Repository\Tiles\TileRepository;
use App\Service\Lists\ListService;


require_once './common.php';
/** @var TileHttpHandler $tileHttpHandler*/
$_SESSION["access"] = true; 
$tileRepository = new TileRepository($db, $dataBinder);
$listService = new ListService($tileRepository);
$listHttpHandler = new App\Http\Lists\ListHttpHandler($template, $dataBinder);



$listHttpHandler->showAll($listService, $_POST, $_GET);
