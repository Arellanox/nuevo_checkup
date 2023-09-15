<?php

require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/Pdf.php";
//include_once "../clases/correo_class.php";
$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}
$master = new Master();

#OBTENEMOS LA API POR MEDIO DEL POST
$api = $_POST['api'];

#OBTENEMOS EL USUARIO EN SESSION
$usuario = $_SESSION['id'];

#OBTENCION DE DATOS
$id_caja = $_POST['id_caja'];
$descripcion_caja = $_POST['descripcion_caja'];
$usuario_encargado = isset($_POST['usuario_encargado']) ? $_POST['usuario_encargado'] : null;
$id_cajas_usuarios = $_POST['id_cajas_usuarios'];


# ========================================================================
#Arrays

#Parametros para agregar 
$cajas_g = array(
    $descripcion_caja,
    $usuario
);

#Parametros para elimiar cajas
$cajas_e = array(
    $id_caja,
    $usuario
);

#parametros para agregar un encargado de caja *usuario
$cajas_usuarios_g = array(
    $id_caja,
    $usuario,
    $usuario_encargado
);

#parametros para buscar usuarios encargados de las cajas
$cajas_usuarios_b = array(
    $id_caja,
    $usuario_encargado
);

#parametros para eliminar usuarios encargados de las cajas
$cajas_usuarios_e = array(
    $id_cajas_usuarios,
    $usuario
);


# ========================================================================


switch ($api) {
    case 1:
        # Insertar una nueva caja
        $response = $master->insertByProcedure("sp_cajas_g", $cajas_g);
        break;
    case 2:
        # Buscar cajas
        $response = $master->getByProcedure("sp_cajas_b", [$id_caja]);
        break;
    case 3:
        # Actualizar
        break;
    case 4:
        # Eliminar caja
        $response = $master->insertByProcedure("sp_cajas_e", $cajas_e);
        break;
    case 5:
        #Insertar Usuarios a las cajas
        $response = $master->insertByProcedure("sp_agregar_usuarios_cajas_g", $cajas_usuarios_g);
        break;
    case 6:
        # Buscar usuarios encargados de las cajas
        $response = $master->getByProcedure("sp_agregar_usuarios_cajas_b", [$cajas_usuarios_b]);
        break;
    case 7:
        #eliminar usuarios encargados de caja
        $response = $master->insertByProcedure("sp_usuarios_cajas_e", $cajas_usuarios_e);
        break;
    default:
        # code...
        $response = "API no definida";
        break;
}

echo $master->returnApi($response);