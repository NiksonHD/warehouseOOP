<?php

use App\Http\Tiles\TileHttpHandler;



require_once './common.php';
/** @var TileHttpHandler $tileHttpHandler*/

$tileHttpHandler = new TileHttpHandler($template, $dataBinder);

$tileHttpHandler->lastChanges($tileService, $_POST, $_GET);
