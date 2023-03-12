<?php

session_start();

spl_autoload_register(function ($className) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);

    include_once __DIR__ . '/' . $className . '.php';
});

$dbInfo = parse_ini_file("../Config/db.ini");
$pdo = new PDO($dbInfo['dsn'], $dbInfo['user'], $dbInfo['pass']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$querie = new sqlQueries($pdo);

// $onstockFile = file('/home/nikson/localhost/warehouse_app/on_stock.csv');
// $onstockFile = file('tile-paths.csv');

$count = 0;
$saps = $querie->getAllArticles();
foreach ($saps as $sap) {
    if ($sap['quantity'] > 0 && strlen($sap['pic_path']) < 6) {


    $sapNum = $sap['sap'];
    $data = file_get_contents("https://praktiker.bg/p/$sapNum");
    $regex = '/\<img\ssrc="\/medias\/sys_master\/\S+/';
    $srcPart = strstr($data, "/medias");
    $srcPart = explode('"', $srcPart)[0];
    sleep('3');
    $count ++;
    $querie->updateArticlesPath($sapNum, $srcPart);
    var_dump($count);
    }
}
    
    



 