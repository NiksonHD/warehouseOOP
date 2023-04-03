<?php

session_start();

spl_autoload_register(function ($className) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);

    include_once __DIR__ . '/' . $className . '.php';
});

$dbInfo = parse_ini_file("C:/xampp/htdocs/warehouse_app/Config/db.ini");
$pdo = new PDO($dbInfo['dsn'], $dbInfo['user'], $dbInfo['pass']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$querie = new sqlQueries($pdo);


$onstockFile = file('C:\xampp\htdocs\warehouse_app\on_stock.csv');
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

 