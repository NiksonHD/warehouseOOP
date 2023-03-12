<?php

require_once 'common.php';
$encryptionService = new \App\Service\Encryption\ArgonEncryptionService();
$userRepository = new \App\Repository\UserRepository($db);
$userService = new App\Service\UserService($userRepository, $encryptionService);
$userHttpHandler = new App\Http\UserHttpHandler($template, $dataBinder);
$userHttpHandler->register($userService, $_POST);
