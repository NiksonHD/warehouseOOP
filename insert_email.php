<?php


require_once './common.php';
/** @var App\Http\Fiscal\EmailHttpHandler $emailHttpHandler */

$emailHttpHandler->edit($emailService, $_POST);