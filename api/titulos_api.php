<?php
include "../clases/master_class.php";

$master = new Master();
$api = $_POST['api'];

$id_titulo = $_POST['id_titulo'];
$descripcion = $_POST['descripcion'];

switch ($api) {
    case 1:
        #insertar y actualizar
        $response = $master->insertByProcedure("sp_u_titulos_g", [$id_titulo, $descripcion]);
        break;
    case 2:
        #buscar
        $response = $master->getByProcedure("sp_u_titulos_b", [$id_titulo]);
        break;
    case 3:
        # eliminar
        $response = $master->deleteByProcedure("sp_u_titulos_e", [$id_titulo]);
        break;

    default:
        $response = "API no definida";
        break;
}

echo $response = $master->returnApi($response);
