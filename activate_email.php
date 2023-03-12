<?php


require_once './common.php';
/** @var App\Http\Email\EmailHttpHandler $emailHttpHandler */

$emailHttpHandler->activate($emailService, $_POST);