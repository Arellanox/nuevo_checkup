<?php
include "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();

$master = new Master();
$api = $_POST['api'];
$id_laboratorio_maquila = $_POST['LABORATORIO_MAQUILA_ID'];
$turno_id = $_POST['TURNO_ID'];
$servicio_id = $_POST['SERVICIO_ID'];
$usuario_id = $_SESSION['id'];
$id_maquila = $_POST['ID_MAQUILA']; // ESTATUS => NULL: PENDIENTE, 1: APROBADO, 2: RECHAZADO
$maquila_estatus = $_POST['MAQUILA_ESTATUS']; // 0: INACTIVO, 1: ACTIVO, 2: OCULTO, 3: ELIMINADO
$activo = $_POST['ACTIVO'];
$mostrar_ocultos = $_POST['MOSTRAR_OCULTOS'];
$fecha_inicio = $_POST['FECHA_INICIO'];
$fecha_fin = $_POST['FECHA_FIN'];
$id_grupo_servicio = $_POST['ID_GRUPO_SERVICIO'];
$lista_estudios = $_POST['LISTA_ESTUDIOS'];

switch ($api) {
    case 1:
        // Registrar estudio a maquilar y lista de estudios a maquilar
        $response = $master->insertByProcedure('sp_laboratorio_estudios_maquila_g', [
            $turno_id, $servicio_id, $id_laboratorio_maquila, json_encode($lista_estudios), $usuario_id
        ]);
        break;
    case 2: // Recuperar información del estudio pendiente a maquilar
        $maquilas = $master->getByProcedure('sp_laboratorio_estudios_maquila_b', [
            $id_maquila, $mostrar_ocultos, NULL, NULL, $fecha_inicio, $fecha_fin
        ]);

        if (is_array($maquilas)) {
            foreach ($maquilas as $index => $maquila) {
                $data_estudios_filtrados = [];
                $decode_lista_estudios = json_decode($maquila['LISTA_ESTUDIOS'], true);
                $data_estudios = $master->getByProcedure('sp_obtener_estudios_de_servicio', [
                    $maquila['ID_SERVICIO']
                ]);

                if (is_array($decode_lista_estudios) and is_array($data_estudios)) {
                    $data_estudios_filtrados = array_filter($data_estudios, function ($estudio) use ($decode_lista_estudios) {
                        return in_array($estudio['ID_ESTUDIO'], $decode_lista_estudios);
                    });
                }

                $maquilas[$index]['DETALLES_ESTUDIOS'] = array_values($data_estudios_filtrados);
                $maquilas[$index]['LISTA_ESTUDIOS'] = $decode_lista_estudios;
            }
        }

        $response = $maquilas;
        break;
    case 3: // Actualizar campo "activo" del estudio a maquilar
        $ids = is_array($id_maquila) ? implode(',', $id_maquila) : $id_maquila;

        $response = $master->updateByProcedure('sp_laboratorio_estudios_maquila_a', [
            $ids, $maquila_estatus, $fecha_inicio, $fecha_fin, $usuario_id
        ]);
        break;
    case 4: // Eliminar estudio a maquilar
        $response = $master->deleteByProcedure('sp_laboratorio_estudios_maquila_e', [
            $id_maquila, $usuario_id
        ]);
        break;
    case 5: // Generer reporte de estudios a maquilar para diagnostica
        $url = $master->reportador($master, $turno_id, -8, 'solicitud_maquila_diagnostica');
        $response = ['url' => $url];
        break;
    case 6: // Generer reporte de estudios a maquilar general
        $url = $master->reportador($master, $turno_id, -8, 'solicitud_maquila_general');
        $response = ['url' => $url];
        break;
    case 7: // Recuperar grupo de estudios a maquilar de un servicio
        $response = $master->getByProcedure('sp_obtener_estudios_de_servicio', [
            $id_grupo_servicio
        ]);
        break;
    default:
        $response = "API no definida";;
        break;
}

echo $master->returnApi($response);