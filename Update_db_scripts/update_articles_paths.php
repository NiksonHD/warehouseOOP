<?php

session_start();

spl_autoload_register(function($className) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);

    include_once __DIR__ . '/' . $className . '.php';
});

$dbInfo = parse_ini_file("../Config/db.ini");
$pdo = new PDO($dbInfo['dsn'], $dbInfo['user'], $dbInfo['pass']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$querie = new sqlQueries($pdo);



// $onstockFile = file('/home/nikson/localhost/warehouse_app/on_stock.csv');
 $onstockFile = file('tile-paths.csv');
    for ($index = 0; $index < count($onstockFile); $index++) {
        if ($index != 0) {
            $temp = preg_split('/\t/', $onstockFile[$index]);
            $id = $temp[0];
            $sap = $temp[1];
            $path = $temp[7];
            $quantity = $temp[2];
            
//            $querie->updateQuantity($sapNum, $ean, $quantity);
//            $articleInfo = $querie->getArticleInfoBySap($sapNum);
//            if ($articleInfo['article_num'] == '') {
//                $querie->createArticleInfo($sapNum, $name, $ean, $quantity);
//            }
            $querie->updateArticlesPath($sap, $path);
        }
    }



 