<?php
include "../clases/master_class.php";

$master = new Master();
$api = $_POST['api'];

$id_especialidad = $_POST['id_especialidad'];
$descripcion = $_POST['descripcion'];
$activo = isset($_POST['ACTIVO']) ? null : 1;

switch($api){
    case 1:
        #insertar especialidad
        $response = $master->insertByProcedure("sp_especialidades_g", [$id_especialidad,$descripcion]);
        break;
    case 2:
        # buscar
        $response = $master->getByProcedure("sp_especialidades_b", [$id_especialidad,$descripcion,$activo]);
        
        break;
    case 3:
        #eliminar
        $response = $master->getByProcedure("sp_especialidades_e", [$id_especialidad]);
        break;
    default:
        $response = "Api no definida.";
        break;
}

echo $response = $master->returnApi($response);

?>