<?php
use App\Http\Tiles\TileHttpHandler;
use App\Repository\Tiles\TileRepository;
use App\Service\Tiles\TileService;


require_once './common.php';

$tileRepository = new TileRepository($db, $dataBinder);
$tileService = new TileService($tileRepository);
$tileHttpHandler = new TileHttpHandler($template, $dataBinder);

$tileHttpHandler->edit_article($tileService, $_GET,$_POST);