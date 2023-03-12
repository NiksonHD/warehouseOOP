<?php

session_start();

spl_autoload_register(function ($className) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);

    include_once __DIR__ . '/' . $className . '.php';
});
$dbInfo = parse_ini_file("/home/nikson/localhost/warehouseOOP/Config/db.ini");

$pdo = new PDO($dbInfo['dsn'], $dbInfo['user'], $dbInfo['pass']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$querie = new sqlQueries($pdo);

// $mapFile = file('/data/data/com.termux/files/home/downloads/whdata.csv');
$mapFile = file('../whdata.csv');
$parseMap = [];
$querie->emptyMap();

for ($index = 0; $index < count($mapFile); $index++) {

    $temp = preg_split('/\t/', $mapFile[$index]);
    $cell = str_replace('"', '', $temp[0]);
    $sapNums = str_replace('"', '', $temp[1]);
    $sapNums = explode(' ', $sapNums);
    $updateDate = str_replace('"', '', $temp[2]);
    foreach ($sapNums as $sap) {
        if ($sap != '') {
            $cellId = $querie->getCellIdByCell($cell)['id'];
            $articleId = $querie->getArticleIdBySap($sap)['id'];
            if ($articleId != '') {
                var_dump($sap, $updateDate);

                $querie->updateMap($cellId, $articleId, $updateDate);
            }
        }
    }
    // $querie->createMapCells($cell, $sapNums, $updateDate);
}


