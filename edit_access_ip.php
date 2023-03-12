<?php

use App\Http\Cpanel\CpanelHttpHandler;
use App\Http\Tiles\TileHttpHandler;
use App\Repository\Cpanel\CpanelRepository;
use App\Repository\UserRepository;
use App\Service\Cpanel\CpanelService;
use App\Service\Encryption\ArgonEncryptionService;
use App\Service\UserService;



require_once './common.php';
/** @var TileHttpHandler $tileHttpHandler*/
$encryptionService = new ArgonEncryptionService();
$userRepository = new UserRepository($db);
$userService = new UserService($userRepository, $encryptionService);

$cPanelRepository = new CpanelRepository($db, $dataBinder);
$cPanelService = new CpanelService($cPanelRepository);

$cPanelHttpHandler = new CpanelHttpHandler($template, $dataBinder);
$cPanelHttpHandler->editIpSettings($cPanelService,$userService, $_GET, $_POST);

