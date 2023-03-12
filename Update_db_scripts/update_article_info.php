<?php

session_start();

spl_autoload_register(function ($className) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);

    include_once __DIR__ . '/' . $className . '.php';
});

$dbInfo = parse_ini_file("../Config/db.ini");
$pdo = new PDO($dbInfo['dsn'], $dbInfo['user'], $dbInfo['pass']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$querie = new sqlQueries($pdo);


$onstockFile = file('../on_stock.csv');
$onstockFile = mb_convert_encoding($onstockFile, 'UTF-8', 'Windows-1251');
for ($index = 0; $index < count($onstockFile); $index++) {
    if ($index != 0) {
        $temp = preg_split('/\t/', $onstockFile[$index]);
        $sapNum = $temp[0];
        $name = $temp[1];
        $ean = $temp[9];
        $quantity = $temp[2];
            $querie->updateQuantity($sapNum, $ean, $quantity);
            $articleInfo = $querie->getArticleInfoBySap($sapNum);
        if ($articleInfo['sap'] == '') {
                $querie->createArticleInfo($sapNum, $name, $ean, $quantity);
        }
    }
}



 