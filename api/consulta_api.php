<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include "../clases/correo_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) { //Preregistro necesita recuperar antecedentes
    // $tokenVerification->logout();
    // exit;
}

#api
$api = $_POST['api'];


#buscar
$id_paciente = $_POST['id_paciente'];
$curp = $_POST['curp'];

#insertar   
$id_consulta = $_POST['id_consulta'];
$turno_id = $_POST['turno_id'];
$fecha_consulta = $_POST['fecha_consulta'];
$motivo_consulta = $_POST['motivo_consulta'];
$notas_padecimiento = $_POST['notas_padecimiento'];
$consulta_subsecuente = $_POST['consulta_subsecuente'];
$diagnostico = $_POST['diagnostico'];
$registrado_por = $_SESSION['id'];


$parametros = array(
    $id_consulta,
    $turno_id,
    $fecha_consulta,
    $motivo_consulta,
    $notas_padecimiento,
    $consulta_subsecuente,
    $diagnostico,
    $registrado_por
);

#nutricion
$id_nutricion = $_POST['id_nutricion'];
#$turnos_id = $_POST['turnos_id'];
$peso_perdido = $_POST['peso_perdido'];
$grasa = $_POST['grasa'];
$cintura = $_POST['cintura'];
$agua = $_POST['agua'];
$musculo = $_POST['musculo'];
$abdomen = $_POST['abdomen'];

$nutricionParams = array(
    $id_nutricion,
    $turno_id,
    $peso_perdido,
    $grasa,
    $cintura,
    $agua,
    $musculo,
    $abdomen
);


# exploracion clinica
$id_exploracion_clinica = $_POST['id_exploracion_clinica'];
$exploracion_tipo_id = $_POST['exploracion_tipo_id'];
$exploracion = $_POST['exploracion'];


# recetas
$id_receta = $_POST['id_receta'];
#el ide del turno esta arriba
$nombre_generico = $_POST['nombre_generico'];
$forma_farmaceutica = $_POST['forma_farmaceutica'];
$dosis = $_POST['dosis'];
$presentacion = $_POST['presentacion'];
$frecuencia = $_POST['frecuencia'];
$via_de_administracion = $_POST['via_de_administracion'];
$duracion_del_tratamiento = $_POST['duracion_del_tratamiento'];
$indicaciones_para_el_uso = $_POST['indicaciones_para_el_uso'];

$recetaParams = array(
    $id_receta,
    $turno_id,
    $nombre_generico,
    $forma_farmaceutica,
    $dosis,
    $presentacion,
    $frecuencia,
    $via_de_administracion,
    $duracion_del_tratamiento,
    $indicaciones_para_el_uso
);


# datos para el odontograma
$id_odontograma = $_POST['id_odontograma'];
$id_pieza_dental = $_POST['id_pieza_dental'];
$cara_id = $_POST['cara_id'];
$tratamiento_id = $_POST['tratamiento_id'];
$diagnostico = $_POST['diagnostico'];
$comentario = $_POST['comentario'];

$odonto_array = array(
    $id_odontograma,
    $turno_id,
    $id_pieza_dental,
    $cara_id,
    $tratamiento_id,
    $diagnostico,
    $comentario
);

$master = new Master();

switch ($api) {
    case 0:
        # actualizar ruta de reporte de consultorio dados las id del turno.
        $prefolios = [1177,
            1180,
            1192,
            1193,
            1194,
            1197];

        foreach($prefolios as $prefolio){
            $url = $master->reportador($master, $prefolio, 1, "consultorio", 'url', 0);
            $response = $master->updateByProcedure('sp_reportes_actualizar_ruta', ["consultorio_consulta","RUTA_REPORTE",$url,$prefolio,null]);
        }
        break;
    case 1:
        $response = $master->insertByProcedure("sp_consultorio_consulta_g", $parametros);
        break;
    case 2:
        # buscar
        $response = $master->getByProcedure("sp_consultorio_consulta_b", [$id_consulta, $turno_id, $id_paciente]);
        break;
    case 3:
        # actualizar
        # actualizar las notas de padecimiento,diagnostico
        $response = $master->updateByProcedure("sp_consultorio_consulta_g", $parametros);
        break;
    case 4:
        # desactivar
        $response = $master->deleteByProcedure("sp_consultorio_consulta_e", [$id_consulta]);
        break;
    case 5:
        # guardar consulta / nutricion tabla
        $response = $master->insertByProcedure("sp_consultorio_nutricion_g", $nutricionParams);
        break;
    case 6:
        # insertar exploracion clinica
        $response = $master->insertByProcedure("sp_consultorio_exploracion_clinica_g", [$id_exploracion_clinica, $turno_id, $exploracion_tipo_id, $exploracion]);
        break;
    case 7:
        # eliminar exploracion clinica
        $response = $master->deleteByProcedure("sp_consultorio_exploracion_clinica_e", [$id_exploracion_clinica]);
        break;
    case 8:
        # insertar y/o actualizar  anamnesis-aparatos
        $anamnesis = array_slice($_POST, 0, count($_POST) - 2);
        //    print_r($payload);
        foreach ($anamnesis as $key => $value) {
            if (count($value) == 3) {
                $new = array(
                    $turno_id,
                    $value[0], # id subtipo
                    $value[1], # id respuesta
                    $value[2] #notas
                );
            } else {
                if (is_numeric($value[1])) {
                    $new = array(
                        $turno_id,
                        $value[0], # id subtipo
                        $value[1], # id respuesta
                        null #notas
                    );
                } else {
                    $new = array(
                        $turno_id,
                        $value[0], # id subtipo
                        null, # id respuesta
                        $value[1] #notas
                    );
                }
            }

            $response = $master->insertByProcedure("sp_consultorio_anamnesis_aparatos_g", $new);
        }
        break;
    case 9:
        # insetar receta
        $response = $master->insertByProcedure("sp_consultorio_recetas_g", $recetaParams);
        break;
    case 10:
        # recuperar los antecedentes del turno
        $response = $master->getByProcedure('sp_consultorio_antecedentes_b', [$turno_id, $curp]);
        // print_r(($response));
        $ordenado = ordenarCuestionario($response);
        echo json_encode($ordenado);
        exit;
    case 11:
        # terminar consulta
        $response = $master->updateByProcedure('sp_consultorio_terminar_consulta', [$id_consulta, $url, $_SESSION['id']]);
        $url = $master->reportador($master, $turno_id, 1, "consultorio", 'url', 0);

        $response = $master->updateByProcedure('sp_reportes_actualizar_ruta', ["consultorio_consulta","RUTA_REPORTE",$url,$turno_id,null]);

        //Enviamos correo
        $attachment = $master->cleanAttachFilesImage($master, $turno_id, 10, 1);

        if (!empty($attachment[0])) {
            $mail = new Correo();
            if ($mail->sendEmail('resultados', '[bimo] Resultados de consulta', [$attachment[1]], null, $attachment[0], 1, $turno_id, 1, $master)) {
                $master->setLog("Correo enviado.", "Consulta");
            }
        }

        break;
    case 12:
        # buscar las exploraciones clinicas.
        $response = $master->getByProcedure('sp_consultorio_exploracion_clinica_b', [$turno_id]);

        break;
    case 13:
        # recuperar los datos nutricionales
        $response = $master->getByProcedure('sp_consultorio_nutricion_b', [$turno_id]);
        break;
    case 14:
        # recuperar los datos de la receta
        $response = $master->getByProcedure('sp_consultorio_recetas_b', [$turno_id]);
        break;
    case 15:
        # recuperar anamnesis por aparatos
        $response = $master->getByProcedure('sp_consultorio_anamnesis_aparatos_b', [$turno_id]);
        $ordenado = ordenarCuestionario($response, 1);
        echo json_encode($ordenado);
        exit;
        break;
    case 16:
        # actualizar los antecedentes del turno
        $antecedentes = array_slice($_POST, 0, count($_POST) - 2);

        #log para las respuetas de los antecedentes de consultorio
        $r= $master->createDir('../logs/consultorio');

        $tipo = checkTipoAntecedente($antecedentes);

        $log = "../logs/consultorio/antecedentes_$tipo-$turno_id.txt";

        $data = [];

        $id_cliente = $master->insertByProcedure('sp_get_cliente',[$turno_id]);
        foreach ($antecedentes as $current) {
            # ids de las preguntas de antecedentes ginecologicos
            $idsGinecologicos = [192, 193, 194, 195, 196, 197, 200, 201, 202];
            if(in_array($current[0], $idsGinecologicos)){
                $response = $master->updateByProcedure('sp_consultorio_antecedentes_a', [$turno_id, $current[0], null, $current[1]]);

                array_push($data, [$turno_id, $current[0], null, $current[1]]);
            } else {
                $response = ($id_cliente == 51) ? $master->updateByProcedure('sp_consultorio_antecedentes_a', [
                    $turno_id,
                    $current[0],
                    isset($current[2]) ? $current[1] : null,
                    $current[2] ?? ($current[1] ?? null)
                ]) : $master->updateByProcedure('sp_consultorio_antecedentes_a', [$turno_id, $current[0], $current[1], $current[2]]);
                array_push($data, [$turno_id, $current[0], $current[1], $current[2]]);
            }
        }

        file_put_contents($log, json_encode($data));

        break;
    case 17:
        # eliminar receta
        $response = $master->deleteByProcedure('sp_consultorio_recetas_e', [$id_receta]);
        break;
    case 18:
        #insertar resultado del odontograma
        $response = $master->insertByProcedure("sp_consultorio_odontograma_g", $odonto_array);
        break;
    case 19:
        # recuperar detalles de odontograma
        $response = $master->getByProcedure("sp_consultorio_odontograma_b", [$turno_id]);
        break;
    case 20:
        # eliminar odontograma
        $response = $master->deleteByProcedure('sp_consultorio_odontograma_e', [$id_odontograma]);
        break;
    case 21:
        # recuperar reportes de paciente por el turno
        $response = $master->getByProcedure("sp_recuperar_reportes_confirmados", [$turno_id, null, null, null, 1]);
        break;
    case 22:
        $url = $master->reportador($master, $turno_id, 1, "consultorio", 'url', 0);
        echo $url;
        break;
    case 23:
        # recuperar historial de conclusiones de historia clinica.
        $response = $master->getByProcedure("sp_historial_conclusiones_historia_clinica", [$turno_id]);
        break;
    default:
        $response = "api no reconocida";
        break;
}

echo $master->returnApi($response);

function ordenarCuestionario($response, $anamnesis = 0)
{
    $antecedentes = array();

    if ($anamnesis == 0) {
        $idTipo = 1;
    } else {
        $idTipo = "SISTEMA CARDIOVASCULAR";
    }

    $count = 0;
    $tipoArray = array();

    foreach ($response as $key => $ante) {
        $comodin = $anamnesis == 1 ? $ante['ID_TIPO'] : $ante['TIPO'];
        if ($ante['ID_TIPO'] == $idTipo) {
            $subtipoArray = array(
                $ante['ID_RESPUESTA'],
                $ante['NOTAS'],
                $ante['ID_SUBTIPO']
            );

            $tipoArray[] = $subtipoArray;
        } else {
            if ($anamnesis == 0) {
                $antecedentes[$response[$key - 1]['TIPO']] = $tipoArray;
            } else {
                $antecedentes[$idTipo] = $tipoArray;
            }

            $idTipo = $ante['ID_TIPO'];
            $tipoArray  = array();

            $subtipoArray = array(
                $ante['ID_RESPUESTA'],
                $ante['NOTAS'],
                $ante['ID_SUBTIPO']
            );

            $tipoArray[] = $subtipoArray;
        }
    }

    if(isset($antecedentes[$comodin])){
        $antecedentes[$comodin] = array_merge($antecedentes[$comodin],$tipoArray);
    } else{
        $antecedentes[$comodin] = $tipoArray;
    }
    return $antecedentes;
}


function checkTipoAntecedente($array){

    $keys = array_keys($array);

    switch(true){
        case in_array('check-aler', $keys):
            $x =  'patologicos';
            break;
        case in_array('check-tabaq', $keys):
            $x =  'nopatologicos';
            break;
        case in_array('check-hero-padre', $keys):
            $x =  'heredofamiliares';
            break;
        case in_array('check-enfpsicopsiq', $keys):
            $x =  'psiquiatricos';
            break;
        case in_array('check-Desayuno', $keys):
            $x =  'nutricionales';
            break;
        case in_array('check-antginecologicos-ultimamenstruacion',$keys):
            $x =  'ginecologicos';
            break;
        case in_array('check-incapaAccid', $keys):
            $x =  'medio';
            break;

    }

    return $x;
}
