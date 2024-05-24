<?php
require_once "../clases/master_class.php";
$master = new Master();
$datos = json_decode(file_get_contents('php://input'), true);



$master->setLog(file_get_contents('php://input'), "asafasd");

// if( strlen(file_get_contents('php://input')) > 11 ){

// }

echo $_SERVER['SERVER_NAME'] . ": OK!";

$response = $master->insertByProcedure('sp_pseudo_interface', [
    json_encode($datos['datos'])
]);