<?php 
include_once "../clases/master_class.php";

$api = $_POST['api'];

$id_modulo = $_POST['id_modulo'];
$area_id = $_POST['area_id'];
$descripcion = $_POST['descripcion'];

$params = array(
    $id_modulo,
    $area_id,
    $descripcion
);

switch($api){
    case 1:
        #insertar modulos
        $response = $master->insertByProcedure('sp_modulos_g',$params);
        break;
    case 2:
        $response = $master->getByProcedure('sp_modulos_b',[$id_modulo,$area_id]);
        break;
    case 3:
        $response = $master->updateByProcedure("sp_modulos_g",$params);
        break;
    case 4:
        $response = $master->deleteByProcedure('sp_modulos_e',[$id_modulo]);
        break;
    default:
        break;
}

echo $master->returnApi($response);
?>