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

//$estudio_alias = $_POST['NOMBRE_ALIAS_ESTUDIO'];
//$estudio_clave = $_POST['CLAVE_ALIAS_ESTUDIO'];
//$estudio_precio= $_POST['PRECIO_ALIAS_ESTUDIO'];

$laboratorio_alias_id = $_POST['LABORATORIO_ALIAS_ID'];
$estudio_laboratorio_id = $_POST['LABORATORIO_MAQUILA_ID'];
$estudio_servicio_id = $_POST['SERVICIO_ESTUDIO_ID'];

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

                $data_estudios = $master->getByProcedure('sp_obtener_estudios_de_servicio_b', [
                    $maquila['ID_SERVICIO'], $maquila['ID_LABORATORIO']
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
        $response = $master->getByProcedure('sp_obtener_estudios_de_servicio_b', [
            $id_grupo_servicio, $id_laboratorio_maquila
        ]);
        break;
    case 9: // Registrar alias de estudios a maquilar
        $master->setLog(json_encode([$estudio_laboratorio_id, $laboratorio_alias_id, $estudio_servicio_id]), 'Detalles');

        $response = $master->insertByProcedure('sp_laboratorio_estudios_equivalencias_g', [
            $estudio_laboratorio_id,
            $laboratorio_alias_id,
            $estudio_servicio_id
        ]);
        break;
    case 10: // Recuperar todos los grupos de estudios y ordenación para su entrega por laboratorios
        $response = $master->getByProcedure('sp_obtener_todos_servicios_estudios_b', [
            $id_laboratorio_maquila
        ]);

        $servicios = [];

        foreach ($response as $row) {
            $servicioId = $row['ID_SERVICIO'];

            // Si el servicio no existe aún, lo agregamos
            if (!isset($servicios[$servicioId])) {
                $servicios[$servicioId] = [
                    'ID_SERVICIO' => $row['ID_SERVICIO'],
                    'DESCRIPCION' => $row['DESCRIPCION'],
                    'ABREVIATURA' => $row['ABREVIATURA'],
                    'AREA_ID' => $row['AREA_ID'],
                    'CLASIFICACION_ID' => $row['CLASIFICACION_ID'],
                    'ES_GRUPO' => $row['ES_GRUPO'],
                    'PRECIO_VENTA' => $row['PRECIO_VENTA'],
                    'LABORATORIO_ID' => $row['LABORATORIO_ID'],
                    'GRUPO_LAB_ESTUDIO_CLAVE' => $row['GRUPO_LAB_ESTUDIO_CLAVE'],
                    'GRUPO_LAB_ESTUDIO_NOMBRE' => $row['GRUPO_LAB_ESTUDIO_NOMBRE'],
                    'GRUPO_ID_ALIAS' => $row['GRUPO_ID_ALIAS'],
                    'GRUPO_LAB_ALIAS_LABORATORIO_ID' => $row['GRUPO_LAB_ALIAS_LABORATORIO_ID'],
                    'GRUPO_PRECIO' => $row['GRUPO_PRECIO'],
                    'ESTUDIOS' => [], // Aquí se guardarán los estudios
                ];
            }

            // Agregamos el estudio al arreglo de estudios del servicio
            $servicios[$servicioId]['ESTUDIOS'][] = [
                'ID_ESTUDIO' => $row['ID_ESTUDIO'],
                'DESCRIPCION' => $row['ESTUDIO_DESCRIPCION'],
                'ABREVIATURA' => $row['ESTUDIO_ABREVIATURA'],
                'AREA_ID' => $row['ESTUDIO_AREA_ID'],
                'CLASIFICACION_ID' => $row['ESTUDIO_CLASIFICACION_ID'],
                'ES_GRUPO' => $row['ESTUDIO_ES_GRUPO'],
                'PRECIO_VENTA' => $row['ESTUDIO_PRECIO_VENTA'],
                'LABORATORIO_ID' => $row['ESTUDIO_LABORATORIO_ID'],
                'ORDEN' => $row['ORDEN'],
                // Alias si existe
                'ALIAS' => [
                    'ID_ALIAS' => $row['ID_ALIAS'],
                    'LAB_ESTUDIO_CLAVE' => $row['LAB_ESTUDIO_CLAVE'],
                    'LAB_ESTUDIO_NOMBRE' => $row['LAB_ESTUDIO_NOMBRE'],
                    'LABORATORIO_ID' => $row['LAB_ALIAS_LABORATORIO_ID'],
                    'SERVICIO_ID' => $row['LAB_ALIAS_SERVICIO_ID'],
                    'PRECIO' => $row['LAB_ALIAS_PRECIO'],
                ]
            ];
        }

        // Opcional: reindexar servicios por posición numérica en lugar de IDs
        $servicios = array_values($servicios);
        $response = $servicios;
        break;
    case 11:
        $response = $master->getByProcedure("sp_obtener_todos_alias_estudios", [
            $id_laboratorio_maquila
        ]);
        break;
    default:
        $response = "API no definida";
        break;
}

echo $master->returnApi($response);