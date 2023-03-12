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
// $onstockFile = file('tile-paths.csv');


    $saps = $querie->getAllArticles();
    $count = 0;
    foreach ($saps as $sap){
        
    $sapNum = $sap['sap'];
    $path = $sap['pic_path'];
    $path = str_replace(PHP_EOL, '', $path);

    if ($path == ''){
        $count++;
        
        var_dump($sapNum,$path);
    }
//    var_dump($count, $path);
    
    
//    $data = file_get_contents("https://praktiker.bg/p/$sapNum");
//    $regex = '/\<img\ssrc="\/medias\/sys_master\/\S+/';
//    // preg_match($regex, $data, $match);
//    $srcPart = strstr($data, "/medias");
//    $srcPart = explode('"', $srcPart)[0];
//    sleep('4');
//    $querie->updateArticlesPath($sapNum, $srcPart);
    }
    echo $count;

    
    



 