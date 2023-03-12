<?php

session_start();

spl_autoload_register(function ($className) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);

    include_once __DIR__ . '/' . $className . '.php';
});
// $dbInfo = parse_ini_file("/data/data/com.termux/files/home/storage/movies/warehouse_app/Update db scripts/db.ini");
//$dbInfo = parse_ini_file("C:/xampp/htdocs/warehouse_app/Update_db_scripts/db.ini");
$dbInfo = parse_ini_file("/home/nikson/localhost/warehouseOOP/Config/db.ini");

$pdo = new PDO($dbInfo['dsn'], $dbInfo['user'], $dbInfo['pass']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$querie = new sqlQueries($pdo);

$map = [];
//$mapFile = file('C:/xampp/htdocs/warehouse_app/whdata.csv');
$cells = $querie->getAllCells();

$mapData = $querie->getMapArticles();
foreach ($cells as $cell) {
    $map [$cell['cell']] = [];
}
foreach ($mapData as $data) {
    foreach ($data as $keyData => $d) {
        if (key_exists($d, $map)) {
            $map[$d][0] .= ' ' . $data['sap'];
            $map[$d][0] = trim($map[$d][0]);
            $map[$d][1] = $data['create_date'];
        }
    }
}



$output = fopen("map-whdata.csv", "w");

fputcsv($output, array('tile_cell', 'sap_num'), "\t");
foreach ($map as $key => $article) {
    $array = [$key, $article[0], $article[1]];
    fputcsv($output, $array, "\t");
}
fclose($output);


