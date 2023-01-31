<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

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


$parametros = array(
    $id_consulta,
    $turno_id,
    $fecha_consulta,
    $motivo_consulta,
    $notas_padecimiento,
    $consulta_subsecuente,
    $diagnostico
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
        $antecedentes = array();
        $idTipo = 1;
        $count = 0;
        $tipoArray = array();

        foreach ($response as $ante) {
            if ($ante['ID_TIPO'] == $idTipo) {
                $subtipoArray = array(
                    $ante['ID_RESPUESTA'],
                    $ante['NOTAS'],
                    $ante['ID_SUBTIPO']
                );

                $tipoArray[] = $subtipoArray;
            } else {
                $idTipo = $ante['ID_TIPO'];
                $antecedentes[] = $tipoArray;
                $tipoArray  = array();

                $subtipoArray = array(
                    $ante['ID_RESPUESTA'],
                    $ante['NOTAS'],
                    $ante['ID_SUBTIPO']
                );

                $tipoArray[] = $subtipoArray;
            }
        }

        $antecedentes[] = $tipoArray;
        echo json_encode($antecedentes);
        exit;

    case 11:
        # terminar consulta
        $response = $master->updateByProcedure('sp_consultorio_terminar_consulta', [$id_consulta]);
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
        break;
    case 16:
        # actualizar los antecedentes del turno
        $antecedentes = array_slice($_POST, 0, count($_POST) - 2);

        foreach ($antecedentes as $current) {
            $response = $master->updateByProcedure('sp_consultorio_antecedentes_a', [$turno_id, $current[0], $current[1], $current[2]]);
        }

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
        
        exit;
        break;
    default:
        $response = "api no reconocida";
        break;
}

echo $master->returnApi($response);
