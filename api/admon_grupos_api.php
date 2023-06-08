<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/Pdf.php";
include "../clases/correo_class.php";

$master = new Master();

$api = $_POST['api'];

switch($api){
    case 1:
        # Agregar un grupo y su detalle.
        $response = $master->insertByProcedure("sp_", []);
        break;
    default:
        $response = "API no definida";
}


echo $master->returnApi($response);

?>