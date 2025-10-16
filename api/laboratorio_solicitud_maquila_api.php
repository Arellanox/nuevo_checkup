<?php
include "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/ExcelReport_class.php";
include_once "../clases/ExcelFileManager_class.php";
include_once "../clases/Pdf.php";

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
// $observaciones = $_POST['obsercaciones']; -> Miscelaneus

switch ($api) {
    case 1:
        // Registrar estudio a maquilar y lista de estudios a maquilar
        $response = $master->insertByProcedure('sp_laboratorio_estudios_maquila_g', [
            $turno_id, $servicio_id, $id_laboratorio_maquila, json_encode($lista_estudios), $usuario_id
        ]);
        break;
    case 2: // Recuperar información del estudio pendiente a maquilar
        $maquilas = $master->getByProcedure('sp_laboratorio_estudios_maquila_b', [
            $id_maquila, $mostrar_ocultos, NULL, NULL, $fecha_inicio, $fecha_fin, NULL
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

        $master->updateByProcedure('sp_laboratorio_limpiar_maquila', [$ids, $usuario_id]);
        break;
    case 4: // Eliminar estudio a maquilar
        $response = $master->deleteByProcedure('sp_laboratorio_estudios_maquila_e', [
            $id_maquila, $usuario_id
        ]);
        break;
    case 5: // Generar reporte de estudios a maquilar para diagnostica
        /*
         * EL IDENTIFICADOR NOS PERMITE RASTREAR LA ASOCIACION DE UN PDF Y SUS MAQUILAS, OJO ESTE VALOR SE MANDA COMO
         * REPORTADOR POR LO CUAL DEBE SER REASINADO EN REPORTADOR A 0, ES REQUISITO ENVIAR ESTE VALOR YA QUE SE SUBIRA
         * EN CADA MAQUILA COMO ASOCIACION
         * */
        $identificador = bin2hex(random_bytes(16));
        $url = $master->reportador($master, $turno_id, -8, 'solicitud_maquila_diagnostica', 'url', $identificador);
        $master->insertByProcedure('sp_maquila_reporte_g', [$url, 9, $turno_id, date('Y-m-d H:i:s'), $identificador]);
        $response = ['url' => $url];
        break;
    case 6: // Generar reporte de estudios a maquilar general
        /*
         * EL IDENTIFICADOR NOS PERMITE RASTREAR LA ASOCIACION DE UN PDF Y SUS MAQUILAS, OJO ESTE VALOR SE MANDA COMO
         * REPORTADOR POR LO CUAL DEBE SER REASINADO EN REPORTADOR A 0, ES REQUISITO ENVIAR ESTE VALOR YA QUE SE SUBIRA
         * EN CADA MAQUILA COMO ASOCIACION
         * */
        $identificador = bin2hex(random_bytes(16));
        $url = $master->reportador($master, $turno_id, -8, 'solicitud_maquila_general', 'url', $identificador);
        $master->insertByProcedure('sp_maquila_reporte_g', [$url, 5, $turno_id, date('Y-m-d H:i:s'), $identificador]);
        $response = ['url' => $url];
        break;
    case 13: // Generar reporte de estudios a maquilar para biogenica
        /*
         * EL IDENTIFICADOR NOS PERMITE RASTREAR LA ASOCIACION DE UN PDF Y SUS MAQUILAS, OJO ESTE VALOR SE MANDA COMO
         * REPORTADOR POR LO CUAL DEBE SER REASINADO EN REPORTADOR A 0, ES REQUISITO ENVIAR ESTE VALOR YA QUE SE SUBIRA
         * EN CADA MAQUILA COMO ASOCIACION
         * */
        $identificador = bin2hex(random_bytes(16));
        $url = $master->reportador($master, $turno_id, -8, 'solicitud_maquila_biogenica', 'url', $identificador);
        $master->insertByProcedure('sp_maquila_reporte_g', [$url, 7, $turno_id, date('Y-m-d H:i:s'), $identificador]);
        $response = ['url' => $url];
        break;
    case 14: // Generar reporte de estudios a maquilar para ortin
        /*
         * EL IDENTIFICADOR NOS PERMITE RASTREAR LA ASOCIACION DE UN PDF Y SUS MAQUILAS, OJO ESTE VALOR SE MANDA COMO
         * REPORTADOR POR LO CUAL DEBE SER REASINADO EN REPORTADOR A 0, ES REQUISITO ENVIAR ESTE VALOR YA QUE SE SUBIRA
         * EN CADA MAQUILA COMO ASOCIACION
         * */
        $identificador = bin2hex(random_bytes(16));
        $url = $master->reportador($master, $turno_id, -8, 'solicitud_maquila_ortin', 'url', $identificador);
        $master->insertByProcedure('sp_maquila_reporte_g', [$url, 8, $turno_id, date('Y-m-d H:i:s'), $identificador]);
        $response = ['url' => $url];
        break;
    case 7: // Recuperar grupo de estudios a maquilar de un servicio
        $response = $master->getByProcedure('sp_obtener_estudios_de_servicio_b', [
            $id_grupo_servicio, $id_laboratorio_maquila ?? null
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
    case 12: // Recuperar grupo de estudios a maquilar segun el paciente
        // $master->setLog(json_encode([$id_grupo_servicio, null]), "ASD");

        $response = $master->getByProcedure('sp_obtener_estudios_de_servicio_b', [
            $id_grupo_servicio, null
        ]);
        break;
    case 15: // Recupera todos los reportes que tenemos generados por fechas
        $response = $master->getByProcedure('sp_maquila_reporte_b', [
            $id_laboratorio_maquila, $fecha_inicio, $fecha_fin
        ]);
        break;
    case 16: //Generamos un reporte de ventas de maquilas por pacientes
        $pacientes = $master->getByProcedure('sp_reporte_maquilas_pacientes', [
            $fecha_inicio == '' ? null : $fecha_inicio,
            $fecha_fin == '' ?  null : $fecha_fin,
            (($id_laboratorio_maquila == '' || $id_laboratorio_maquila == 'null') ? null : $id_laboratorio_maquila)
        ]);

        $master->setLog(json_encode([$fecha_fin, $fecha_inicio, $id_laboratorio_maquila]), 'Mensaje');

        $resultado = [];

        foreach ($pacientes as $paciente) {
            $servicios = $master->getByProcedure('sp_reporte_maquilas_servicios', [
                $paciente['ID_PACIENTE'],
                $paciente['ID_LABORATORIO']
            ]);

            $serviciosDetallados = [];
            $totalPaciente = 0;

            foreach ($servicios as $servicio) {
                // LISTA_ESTUDIOS es un JSON con ids de estudios
                $listaEstudios = json_decode($servicio['LISTA_ESTUDIOS'], true) ?? [];

                $estudiosFiltrados = [];
                $subtotal = 0;

                foreach ($listaEstudios  as $idEstudio) {
                    $estudios = $master->getByProcedure('sp_reporte_maquilas_estudios', [
                        $idEstudio,
                        $paciente['ID_LABORATORIO']
                    ]);

                    foreach ($estudios as $estudio) {
                        $precio = $estudio['PRECIO_GRUPO'] ?? $estudio['PRECIO'] ?? 0;
                        $subtotal += $precio;

                        $estudiosFiltrados[] = [
                            'id' => $estudio['ID_SERVICIO'],
                            'descripcion' => $estudio['ESTUDIO'],
                            'laboratorio' => $estudio['ID_LABORATORIO'],
                            'clave' => $estudio['CLAVE'],
                            'precio' => $precio,
                            'grupo' => $estudio['GRUPO_ID_ALIAS'],
                        ];
                    }
                }

                $totalPaciente += $subtotal; // ← Acumula el subtotal de este servicio

                $serviciosDetallados[] = [
                    'id_solicitud' => $servicio['ID_SOLICITUD'],
                    'id_servicio' => $servicio['ID_SERVICIO'],
                    'descripcion' => $servicio['SERVICIO'],
                    'prefolio' => $servicio['PREFOLIO'],
                    'fecha' => $servicio['FECHA_REGISTRO'],
                    'subtotal' => $subtotal,
                    'estudios' => $estudiosFiltrados,
                ];
            }

            $resultado[] = [
                'id_paciente' => $paciente['ID_PACIENTE'],
                'paciente' => $paciente['PACIENTE'],
                'prefolio' => $paciente['PREFOLIO'],
                'laboratorio' => [
                    'id' => $paciente['ID_LABORATORIO'],
                    'nombre' => $paciente['LABORATORIO']
                ],
                'total_general' => $totalPaciente,
                'total_servicios' => $paciente['TOTAL_SERVICIOS'],
                'medico_tratante' => $paciente['MEDICO_TRATANTE'],
                'fecha' => $paciente['FECHA_REGISTRO'],
                'servicios' => $serviciosDetallados
            ];
        }

        $response = $resultado;
        break;
    case 17: // Obtener datos de reportes asociados
        $response = $master->getByProcedure('sp_obtener_reporte_asociaciones', [null]);
        break;
    case 18: // Genera el pdf del reporte asociaciones
        $URL = $master->reportador($master, $turno_id, -13, 'reporte_servicios_asociados');
        $response = ['url' => $URL];
        break;
    case 19: // Genera el Excel del reporte asociaciones
        $response = $master->getByProcedure('sp_obtener_reporte_asociaciones', [null]);

        $columnas = [
            'COUNT' => '#',
            'DESCRIPCION' => 'Servicio',
            'ABREVIATURA' => 'Abreviatura',
            'COSTO' => 'Costo',
            'PRECIO_VENTA' => 'Precio Venta',
            'PRECIO_DIAGNOSTICA' => 'Diagnostica',
            'PRECIO_BIOGENICA' => 'Biogenica',
            'PRECIO_ORTHIN' => 'Orthin'
        ];

        $columnasMoneda = [
            'COSTO',
            'PRECIO_VENTA',
            'PRECIO_DIAGNOSTICA',
            'PRECIO_BIOGENICA',
            'PRECIO_ORTHIN'
        ];

        $reporte = new ExcelReport(
            'DIAGNOSTICO BIOMOLECULAR SA DE CV',
            'ESTUDIOS DE MAQUILA',
            $columnas,
            $response,
            $columnasMoneda
        );

        $reporte->generar();

        # Se requiere esperficar una ruta o desencadena un error
        $nombreArchivo = 'reporte_servicios_asociados_' . $_SESSION['id'] . ".xlsx";
        $rutaFisica = '../reportes/excel/reporte_asociados/' . $nombreArchivo;

        try {
            ExcelFileManagerClass::guardar($reporte->getSpreadsheet(), $rutaFisica);

            $urlDescarga = $host . 'reportes/excel/reporte_asociados/' . $nombreArchivo;
            $response = ['url' => $urlDescarga];
        } catch (\PhpOffice\PhpSpreadsheet\Writer\Exception $e) {
            $response = ['msj' => $e->getMessage()];
            $master->mis->setLog($e->getMessage(), 'Error de Generación de reporte: ');
            return;
        }
        break;
    default:
        $response = "API no definida";
        break;
}

echo $master->returnApi($response);

