<?php

include_once "../clases/master_class.php";
require_once "../clases/token_auth.php";


$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    //
}

$master = new Master();
$api = $_POST['api'];

// Informacion del proveedor (principal)
$id_proveedores = $_POST['id_proveedores'];
$razon_social = $_POST['razon_social'];
$nombre_comercial = $_POST['nombre_comercial'];
$tipo_persona = $_POST['tipo_persona'];
$nombre_representante = $_POST['nombre_representante'];
$objeto_social = $_POST['objeto_social'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$sitio_web = $_POST['sitio_web'];

$paramPrincipal = $master->setToNull(array(
    $id_proveedores,
    $razon_social,
    $nombre_comercial,
    $tipo_persona,
    $nombre_representante,
    $objeto_social,
    $telefono,
    $email,
    $sitio_web
));

# datos de contactos
$id_contacto = $_POST['id_contacto'];
$nombre_contacto = $_POST['nombre_contacto'];
$tipo_contacto = $_POST['tipo_contacto'];

switch ($api) {
        //insertar informacion del proveedor principal
    case 1:
        $response = $master->insertByProcedure('sp_proveedores_general_g', $paramPrincipal);
        break;

        //Busca todos los proveedores que esten guardados
    case 2:
        $response = $master->getByProcedure('sp_proveedores_general_b', []);
        break;
    case 3:
        # busca los tipos de contactos que existen
        $response = $master->getByProcedure("sp_proveedores_tipos_contactos_b", []);
        break;
    case 4:
        # eliminar un proveedor
        $response = $master->deleteByProcedure("sp_proveedores_e", [ $id_proveedores ]);
        break;
    case 5:
        # agregar un contacto de proveedor
        $response = $master->insertByProcedure("sp_proveedores_contactos_g", [
            $id_contacto,
            $nombre_contacto,
            $id_proveedores,
            $tipo_contacto,
            $telefono,
            $email
        ]);
        break;
    case 6:
        # eliminar un contacto de proveedor
        $response = $master->deleteByProcedure("sp_proveedores_contactos_e", [ $id_contacto ]);
        break;
    default:
        $response = "API no definida";
        break;
}

echo $master->returnApi($response);
