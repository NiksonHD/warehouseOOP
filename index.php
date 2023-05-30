<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

use App\Http\Tiles\TileHttpHandler;
use App\Repository\UserRepository;
use App\Service\Encryption\ArgonEncryptionService;
use App\Service\UserService;



require_once './common.php';
/** @var TileHttpHandler $tileHttpHandler*/


$encryptionService = new ArgonEncryptionService();
$userRepository = new UserRepository($db);
$userService = new UserService($userRepository, $encryptionService);

$tileHttpHandler = new TileHttpHandler($template, $dataBinder);

$tileHttpHandler->find($tileService,$userService, $_POST, $_GET);
