<?php

use App\Http\Cpanel\CpanelHttpHandler;
use App\Http\Tiles\TileHttpHandler;
use App\Repository\Cpanel\CpanelRepository;
use App\Service\Cpanel\CpanelService;



require_once './common.php';
/** @var TileHttpHandler $tileHttpHandler*/


$cPanelRepository = new CpanelRepository($db, $dataBinder);
$cPanelService = new CpanelService($cPanelRepository);

$cPanelHttpHandler = new CpanelHttpHandler($template, $dataBinder);
$cPanelHttpHandler->editAccessIp($cPanelService);

