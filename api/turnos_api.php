<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/Pdf.php";


$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    #$tokenVerification->logout();
    #exit;
}

#api
$api = $_POST['api'];

#buscar
$id = $_POST['id'];
$id_paciente = $_POST['id_paciente'];
$id_area = $_POST['id_area'];
$fecha_agenda = $_POST['fecha_busqueda'];
$confirmar = $_POST['confirmar'];

#subir resultaddos
$servicio_id = $_POST['servicio_id'];
$resultado = $_POST['resultado'];
$observaciones = $_POST['observacionesGrupos'];
$observacionesServicios = $_POST['observacionesServicios'];
$confirmado_por = $_SESSION['id'];

#insertar
$id_turno = $_POST['id_turno'];
$paciente_id = $_POST['paciente_id'];
$paquete_id = $_POST['paquete_id'];
$prefolio = $_POST['prefolio'];
$folio = $_POST['folio'];
$fecha_registro = $_POST['fecha_registro'];
$fecha_agenda = $_POST['fecha_agenda'];
$fecha_reagenda = $_POST['fecha_reagenda'];
$fecha_recepcion = $_POST['fecha_recepcion'];
$turno = $_POST['turno'];
$habilitado = $_POST['habilitado'];
$identificacion = $_POST['identificacion'];
$total = $_POST['total'];
$completado = $_POST['completado'];
$comentario_rechazo = $_POST['comentario_rechazo'];
$cliente_id = $_POST['cliente_id'];
$segmento_id = $_POST['segmento_id'];



$parametros = array(
    $id_turno,
    $paciente_id,
    $paquete_id,
    $prefolio,
    $folio,
    //$fecha_registro,
    $fecha_agenda,
    $fecha_reagenda,
    $fecha_recepcion,
    $turno,
    $habilitado,
    $identificacion,
    $total,
    $completado,
    $comentario_rechazo,
    $cliente_id,
    $segmento_id
);
$response = "";

$master = new Master();
switch ($api) {
    case 1:
        $response = $master->insertByProcedure("sp_turnos_g", $parametros);
        break;
    case 2:
        # buscar
        $response = $master->getByProcedure("sp_turnos_b", [$id,]);
        break;
    case 3:
        # actualizar
        $response = $master->updateByProcedure("sp_turnos_g", $parametros);
        break;
    case 4:
        # desactivar
        $response = $master->deleteByProcedure("sp_turnos_e", [$id]);
        break;

    case 5:
        # recuperar la lista de trabajo por area
        $area = $_POST['area_id'];
        $fecha = $_POST['fecha_busqueda'];
        $response = $master->getByProcedure('sp_lista_de_trabajo', array($fecha, $area));
        break;
    case 10:
        #historial de servicios
        $response = $master->getByProcedure("sp_historial_servicios_paciente", [$id, $id_paciente, $id_area, $fecha_agenda]);
        break;

    case 7:
        # api falsa
        // print_r($_POST);
        echo json_encode(array("response" => array("code" => 1, "data" => array())));
        exit;
        break;

    case 8:
        # cargar los resultados
        $tipo = $_POST['tipo'];
        
        if($tipo==1){
            $grupos = $master->getByProcedure("sp_cargar_grupos", [$id_turno,$id_area]);     
            $response = $master->getByProcedure('sp_cargar_estudios',[$id_turno,$id_area]);
            $array = array();
            for($i=0; $i<count($grupos);$i++){
                $nombre_grupo = $grupos[$i]['GRUPO'];
                $id_grupo = $grupos[$i]['GRUPO_ID'];
                $obs = $grupos[$i]['OBSERVACIONES'];

                $contenido_grupo = array_filter($response, function ($obj) use ($nombre_grupo) {
                    $r = $obj["GRUPO"] == $nombre_grupo;
                    return $r;
                });

                $contenido_grupo['NombreGrupo'] = $nombre_grupo;
                $contenido_grupo['ID_GRUPO'] = $id_grupo;
                $contenido_grupo['OBSERVACIONES'] = $obs;
                
                if(!empty($contenido_grupo)){
                    $array[] = $contenido_grupo;
                }
            }

            echo json_encode(array("response"=>array("code"=>1,"data"=>$array)));
            exit;

        } else {
        $response = $master->getByProcedure('sp_cargar_estudios',[$id_turno,$id_area]);
        }

        break;

    case 9:
        # subir resultados
        $setResultados = $_POST['servicios'];
        $id_turno = $_POST['id_turno'];
        
        foreach ($setResultados as $servicio_id => $resultado) {
            #determinamos si el estudio de laboratorio tiene valor absoluto.
            $valor_absoluto = isset($resultado['VALOR']) ? $resultado['VALOR'] : NULL;

            #$a = array($id_turno, $servicio_id, $resultado, $confirmar, $confirmado_por, $valor_absoluto);
            $response = $master->updateByProcedure('sp_subir_resultados', array($id_turno, $servicio_id, $resultado['RESULTADO'],$confirmar,$confirmado_por,$valor_absoluto));
        }

        // actualizamos las observaciones por los grupos en casa hijo de la tabla paciente detalle
        
        foreach($observaciones as $key =>$observacion){
            $response = $master->updateByProcedure('sp_cargar_observaciones_laboratorio',[$id_turno,$key,null,$observacion]);
        }

        foreach($observacionesServicios as $key => $observacion){
            $response = $master->updateByProcedure('sp_cargar_observaciones_laboratorio',[$id_turno,null,$key,$observacion]);
        }
        //echo json_encode(array("response" => array("code" => 1, "msj" => "Termina la carga de datos.")));

        if(isset($confirmar)){
            # generar el reporte
            #echo "confirmar";
            crearReporteLaboratorio($id_area, $id_turno);
        }
        
        break;

    case 6:
        #servicios por turno
        $response = $master->getByProcedure('sp_turnos_historial', [$id, $id_paciente]);
        $hijo = $master->getByProcedure('sp_turnos_historial_detalle', [$id, $id_paciente, $id_area]);
        for ($i = 0; $i < count($response) ; $i++) {
            $id_turno_padre = $response[$i]['ID_TURNO'];
            $servicios = array_filter($hijo, function ($obj) use ($id_turno_padre) {
                $r = $obj['ID_TURNO'] == $id_turno_padre;
                return $r;
            });
            $response[$i]['servicios'] = $servicios;
        }
        break;

    case 11:
        # Crear reporte de puertas
        crearReporteLaboratorio($id_area, $id_turno);
        break;

    default:
        $response = "api no reconocida";
        break;
}

echo $master->returnApi($response);


function crearReporteLaboratorio($id_area,$id_turno){
    # para crear los reportes de LABORATORIO
    $master = new Master();
    # informacion general del paciente

    #Estudios solicitados por el paciente
    $clasificaciones = $master->getByProcedure('sp_laboratorio_clasificacion_examen_b',[null, 6]);
    $response = $master->getByProcedure("sp_cargar_estudios",[$id_turno, 6]);
    $responsePac = $master->getByProcedure("sp_informacion_paciente",[$id_turno]);
    

    # pie de pagina
    $fecha_resultado = $responsePac[0]['FECHA_CARPETA'];
    $nombre_paciente = $responsePac[0]['NOMBRE'];
    $nombre = str_replace(" ","_",$nombre_paciente);

    $ruta_saved = "reportes/modulo/lab/$fecha_resultado/$id_turno/";

    # Crear el directorio si no existe
    $r = $master->createDir("../".$ruta_saved);

    $archivo = array("ruta"=>$ruta_saved,"nombre_archivo"=>$nombre."-".$responsePac[0]['TURNO'].'-'.$fecha_resultado);

    $clave = $master->getByProcedure("sp_generar_clave",[]);

    $pie_pagina = array("clave"=>$clave[0]['TOKEN'],"folio"=>$responsePac[0]['FOLIO'],"modulo"=>6);

    $arrayGlobal = array(
        'areas' =>array()
    );

    # filtramos el arreglo principal y obtenemos aquellos estudios
    # que tienen valor absoluto.
    $serv_var_abs_obj = array_filter($response,function($obj){
        $return = $obj['TIENE_VALOR_ABSOLUTO']==1;
        return $return;
    });

    $serv_var_abs = ordenar($serv_var_abs_obj, "VALORES ABSOLUTOS",$id_turno);
    $valores_absolutos = $serv_var_abs['estudios'][0]['analitos'];

    for($i=0; $i<count($clasificaciones); $i++) {
        $clasificacion_id = $clasificaciones[$i]['ID_CLASIFICACION'];
        # sacamos arrays individuales por clasificacion de examen
        $servicios = array_filter($response,function($obj) use ($clasificacion_id){
            $return = $obj['CLASIFICACION_ID'] == $clasificacion_id;
            return $return;
        });

        # como no estamos seguros que de que se encuentren todas las clasificaciones 
        # en un paciente, evaluamos que el array no este vacio.
        #print_r($servicios);

        if(!empty($servicios)){
            
            $aux = ordenar($servicios,$clasificaciones[$i]['DESCRIPCION'],$id_turno);

            $arrayGlobal['areas'][] = $aux;
            
        }
    }
    // echo "================================================================";
    // echo "<br>";


    # habra estudios que no tengan clasificacion, esos el servidor las regresa con id 0
    # como el id 0 no existe dentro de la tabla de clasificaciones, el algoritmo de arriba los ignora
    # por tanto se tiene que realizar un algoritmo similar pero con el filtro en 0.
    $servicios = array_filter($response, function($obj){
        $return = $obj['CLASIFICACION_ID'] == 0;
        return $return;
    });

    if(!empty($servicios)){
        // $aux = ordenarResultados($servicios,"OTROS ESTUDIOS");
        $aux = ordenar($servicios,"NINGUNA",$id_turno);
        // $arrayGlobal['areas'][]= $aux;
    }

    // print_r($arrayGlobal);
    // print_r($responsePac);

    //JSON para etiquetas (toma de muestra servicios)
    // $id_paciente_detalle = $_POST['id_paciente_detalle'];
    // $res_toma_muestra_serv = $master->getByProcedure('sp_toma_de_muestra_servicios_b',[$id_paciente_detalle,$id_area,$id_turno]);
    // $respuesta = array(json_encode($res_toma_muestra_serv));
    // echo json_encode($respuesta);

    //echo "antes de Generar PDF";

    $pdf = new Reporte(json_encode($arrayGlobal), json_encode($responsePac[0]), $pie_pagina, $archivo, 'resultados', 'url');
    #echo "pdf Generado";

    return $master->insertByProcedure('sp_reportes_areas_g',[null,$id_turno,6,$clave[0]['TOKEN'],$pdf->build()]);
    
}


function ordenar($servicios, $clasificacion, $turno){
    #obtener los valores absolutos
    $absoluto_array = array();
    $in_array = 0;
    #estamos buscandor el id 1 que corresponde a la biometria hematica
    foreach($servicios as $current){
        if(in_array(1,$current) || in_array(35,$current)){
             $in_array++;
         }
     }

     #si existe la biometria hematica [id 1] o perfil reumatico [id 35], obtenemos los valores absolutos y creamos un array
    if($in_array>0){
        $bh = array_filter($servicios, function ($obj) {
            $r = $obj['GRUPO_ID'] == 1 || 35;
            return $r;
        });

        $abs = array_filter($bh, function ($obj) {
            $r = $obj['TIENE_VALOR_ABSOLUTO'] == 1;
            return $r;
        });

        foreach ($abs as $current) {
            $absoluto_array[] = array(
                "analito" => $current['DESCRIPCION_SERVICIO'],
                "valor_abosluto" => $current['VALOR_ABSOLUTO'],
                "referencia" => $current['VALOR_REFERENCIA_ABS'],
                "unidad" => $current['MEDIDA_ABS']
            );
        }
    }

    $master = new Master();
    $grupos = $master->getByProcedure('sp_cargar_grupos',[$turno,6]);
    $estudios = array();
    $analitos = array();
    for ($i = 0; $i < count($grupos); $i++){
        $nombre_grupo = $grupos[$i]['GRUPO'];
        $contenido_grupo = array_filter($servicios, function ($obj) use ($nombre_grupo) {
            $r = $obj['GRUPO'] == $nombre_grupo;
            return $r;
        });

        if(!empty($contenido_grupo)){


            
            # llenado de los analitos del grupo
            foreach($contenido_grupo as $current)
            {
                $nombre_grupo = $current['GRUPO'];
                $observacionnes_generales = $current['OBSERVACIONES'];
                $id_grupo = $current['GRUPO_ID'];
                $metodo_grupo = $current['METODOS_GRUPO'];
                $equipo_grupo = $current['EQUIPOS_GRUPO'];

                $item = array(
                    "nombre"            => $current['DESCRIPCION_SERVICIO'],
                    "unidad"            => $current['MEDIDA'],
                    "resultado"         => $current['RESULTADO'],
                    "referencia"        => $current['VALOR_DE_REFERENCIA'],
                    "observaciones"     => isset($id_grupo)? null : $current['OBSERVACIONES'],
                    "metodo"            => isset($metodo_grupo) ? null : $current['METODOS_ESTUDIO'],
                    "equipo"            => isset($equipo_grupo)? null : $current['EQUIPOS_ESTUDIO']
                );

                $analitos[] = $item;
            }

            # para los valorse absolutos
            if($id_grupo==1){
                $last_position = count($analitos)-1;
                $aux = $analitos[$last_position];
                $analitos[$last_position] = $absoluto_array;
                $analitos[] = $aux;
            }

            # llenar arreglo estudios
            $estudios[] = array(
                "estudio"        => $nombre_grupo,
                "analitos"       => $analitos,
                "metodo"         => $metodo_grupo,
                "equipo"         => $equipo_grupo,
                "observaciones"  => isset($id_grupo) ? $observacionnes_generales : null 
            );
            $analitos = array();
        }
    }

    # ARREGLO DE AREAS

    $response = array(
        "area" => $clasificacion,
        "estudios" => $estudios
    );

    return $response;
}
