<?php
include "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();

//if (!$tokenValido) {
//    $tokenVerification->logout();
//    exit;
//}

$master = new Master();
$api = $_POST['api'];
$id_laboratorio_maquila = $_POST['LABORATORIO_MAQUILA_ID'];
$turno_id = $_POST['TURNO_ID'];
$servicio_id = $_POST['SERVICIO_ID'];
$usuario_id = $_SESSION['id'];
$id_maquila = $_POST['ID_MAQUILA'];
// ESTATUS => NULL: PENDIENTE, 1: APROBADO, 2: RECHAZADO
$maquila_estatus = $_POST['MAQUILA_ESTATUS'];
// 0: INACTIVO, 1: ACTIVO, 2: OCULTO, 3: ELIMINADO
$activo = $_POST['ACTIVO'];
$mostrar_ocultos = $_POST['MOSTRAR_OCULTOS'];

switch ($api) {
    case 1:
        $response = $master->insertByProcedure('sp_laboratorio_estudios_maquila_g', [
            $turno_id, $servicio_id, $id_laboratorio_maquila, $usuario_id
        ]);

        try {
            $vinculo = '#';
            $procedureName = "sp_notificaciones_generar_g";
            $mensaje =  "Solicitud de aprobación de maquilación generada por ".$_SESSION['nombre'];

            $master->insertByProcedure($procedureName, [$usuario_id, $mensaje, $vinculo, 15]);
            $master->insertByProcedure($procedureName, [$usuario_id, $mensaje, $vinculo, 2]);
            $master->insertByProcedure($procedureName, [$usuario_id, $mensaje, $vinculo, 20]);
        } catch (Exception $exception){
            $this->mis->setLog('Error al generar notificación', 'sp_notificaciones_generar_g');
        }

        break;
    case 2: // Recuperar información del estudio pendiente a maquilar
        $response = $master->getByProcedure('sp_laboratorio_estudios_maquila_b', [
            $id_maquila, $mostrar_ocultos
        ]);
        break;
    CASE 3: // Actualizar campo "activo" del estudio a maquilar
        $response = $master->updateByProcedure('sp_laboratorio_estudios_maquila_a', [
            $id_maquila, $activo
        ]);
        break;
    case 4: // Eliminar estudio a maquilar
        $response = $master->deleteByProcedure('sp_laboratorio_estudios_maquila_e', [
            $id_maquila
        ]);
        break;
    default:
        $response = "API no definida";;
        break;
}

echo $master->returnApi($response);