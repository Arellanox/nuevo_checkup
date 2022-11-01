<?php 
include_once "../master_class.php";

$master = new Master();
$api = $_POST['api'];


switch ($api) {
    case 1:
        # buscar catalogo de uso de cfdi
        $response = $master->getByProcedure('sp_cfdi_b',[$id]);
        break;
    
    default:
        # code...
        break;
}
echo $master->returnApi($response);
?>