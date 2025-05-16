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

$turno_id = $_POST['turno_id'];


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


#Parametros para buscar la forma y montos de pagos de los pacientes
$data_forma_pago_monto = $master->setToNull(array(
    $turno_id,
    $id_corte
));

$esFranquicia = $_SESSION['franquiciario'] ?? null;
# ========================================================================

switch ($api) {
    case 1:
        # Insertar una nueva caja
        $response = $master->insertByProcedure("sp_cajas_g", $cajas_g);
        break;
    case 2:
        # Mostrar las cajas asignadas a usuarios
        $response = $master->getByProcedure("sp_cajas_b", [
            $id_caja, $usuario, $esFranquicia
        ]);
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
        $response = $master->getByProcedure("sp_usuarios_b", [
            null, null, $esFranquicia ? $_SESSION['id_cliente'] : null
        ]);
        break;
    case 9:
        #Mostrar la informacion de los historiales de los cortes de cajas
        $response1 = $master->getByProcedure("sp_recuperar_info_hostorial_caja", [$id_corte]);
        $response2 = $master->getByProcedure("sp_corte_detalle_pagos", [$id_corte]);
        $response = [$response1, $response2];

        break;
    case 10:
        #Aqui finalizamos el corte de caja
        $response = $master->updateByProcedure('sp_corte_cajas_finalizar_g', [$id_corte, $usuario]);
        break;
    case 11:
        #Aqui busacmos la forma y monto de pago por cada paciente
        $response = $master->getByProcedure('sp_forma_pago_monto_detalle_corte_b', $data_forma_pago_monto);
        break;
    default:
        # code...
        $response = "API no definida";
        break;
}

echo $master->returnApi($response);
