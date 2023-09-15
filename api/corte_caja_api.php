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
$usuario_encargado = $_POST['usuario_encargado'];


# ========================================================================
#Arrays

#Parametros para agregar
$cajas_g = array(
    $descripcion_caja,
    $usuario
);

#parametros para agregar un encargado de caja *usuario
$cajas_usuarios_g = array(
    $id_caja,
    $usuario_encargado,
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
        # Eliminar
        break;
    case 5:
        #Insertar Usuarios a las cajas
        $response = $master->insertByProcedure("sp_agregar_usuarios_cajas", $cajas_usuarios_g);
        break;

    case 5:
        # Buscar usuarios
        $response = $master->getByProcedure("sp_usuarios_b", [null, null]);
        break;

    default:
        # code...
        $response = "API no definida";
        break;
}

echo $master->returnApi($response);