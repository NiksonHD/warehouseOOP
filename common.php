<?php

use App\Http\Cpanel\CpanelHttpHandler;
use App\Http\Email\EmailHttpHandler;
use App\Http\Fiscal\BonHttpHandler;
use App\Http\Person\PersonHttpHanler;
use App\Http\UserHttpHandler;
use App\Repository\Cpanel\CpanelRepository;
use App\Repository\Email\EmailRepository;
use App\Repository\Fiscal\FiscalRepository;
use App\Repository\Person\PersonRepository;
use App\Repository\Tiles\TileRepository;
use App\Repository\UserRepository;
use App\Service\Cpanel\CpanelService;
use App\Service\Email\EmailService;
use App\Service\Encryption\ArgonEncryptionService;
use App\Service\Fiscal\FiscalService;
use App\Service\Person\PersonService;
use App\Service\Tiles\TileService;
use App\Service\UserService;
use Core\DataBinder;
use Core\Template;
use Database\PDODatabase;

session_start();

spl_autoload_register(function ($className) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);

    include_once __DIR__ . '/' . $className . '.php';
});
$dataBinder = new DataBinder();
$template = new Template();
//to prod
//$dbInfo = parse_ini_file("../Config/db.ini");
$dbInfo = parse_ini_file("Config/db.ini");
$pdo = new PDO($dbInfo['dsn'], $dbInfo['user'], $dbInfo['pass']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db = new PDODatabase($pdo);

$_SESSION["access"] = true;
$_SESSION["showPic"] = true;

$tileRepository = new TileRepository($db, $dataBinder);
$tileService = new TileService($tileRepository);

$ip = ($_SERVER["REMOTE_ADDR"]);
$access = $tileService->checkAccess($ip);
if (!$access){
    $tileService->registerIp($ip);
}
$access = $tileService->checkAccess($ip);

(!$access->getEdit()) ? ($_SESSION["access"] = false) : ('');
(!$access->getPic()) ? ($_SESSION["showPic"] = false) : ('');




//$userRepository = new UserRepository($db);
//$cPanelRepository = new CpanelRepository($db, $dataBinder);
//$emailRepository = new EmailRepository($db);
//$fiscalRepository = new FiscalRepository($db);
//$personRepository = new PersonRepository($db);
//$emailService = new EmailService($emailRepository);
//$cPanelService = new CpanelService($cPanelRepository);
//$encryptionService = new ArgonEncryptionService();
//$personService = new PersonService($personRepository);
//$fiscalService = new FiscalService($fiscalRepository);
//$userService = new UserService($userRepository, $encryptionService);
//$fiscalHttpHandler = new BonHttpHandler($template, $dataBinder, $fiscalService, $personService);
//$personHttpHandler = new PersonHttpHanler($template, $dataBinder, $personService,$fiscalService);
//$emailHttpHandler = new EmailHttpHandler($template, $dataBinder, $emailService);
//$userHttpHandler = new UserHttpHandler($template, $dataBinder);
//$cPanelHttpHandler = new CpanelHttpHandler($template, $dataBinder);
