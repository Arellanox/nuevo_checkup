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
$id_corte = $_POST['id_corte'];
$descripcion_caja = $_POST['descripcion_caja'];
$usuario_encargado = $_POST['usuario_encargado'];
$id_cajas_usuarios = $_POST['id_cajas_usuarios'];
$subtotal = $_POST['subtotal'];
$total = $_POST['total'];


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


#Parametros para guardar un nuevo corte de caja
$data_corte_caja = $master->setToNull(array(

    $id_caja,
    $usuario,
    $subtotal,
    $total

));

# ========================================================================


switch ($api) {
    case 1:
        # Insertar una nueva caja
        $response = $master->insertByProcedure("sp_cajas_g", $cajas_g);
        break;
    case 2:
        # Mostrar las cajas asignadas a usuarios
        $response = $master->getByProcedure("sp_cajas_b", [$id_caja, $usuario]);
        break;
    case 3:
        # Finalizar el corte de caja
        $response = $master->getByProcedure("sp_corte_cajas_finalizar_g", $data_corte_caja);
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
        $response = $master->getByProcedure("sp_agregar_usuarios_cajas_b", $cajas_usuarios_b);
        break;
    case 7:
        #eliminar usuarios encargados de caja
        $response = $master->insertByProcedure("sp_usuarios_cajas_e", $cajas_usuarios_e);
        break;
    case 8:
        #recuperar todos los usuarios
        $response = $master->getByProcedure("sp_usuarios_b", [null, null]);
        break;
    case 9:
        #Mostrar la informacion de los historiales de los cortes de cajas
        $response = $master->getByProcedure("sp_recuperar_info_hostorial_caja", [$id_corte]);
        break;
    case 10:
        #Aqui finalizamos el corte de caja
        $response = $master->updateByProcedure('sp_corte_cajas_finalizar_g', [$id_corte, $usuario]);
        break;
    default:
        # code...
        $response = "API no definida";
        break;
}

echo $master->returnApi($response);
