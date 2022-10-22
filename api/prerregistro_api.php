<?php
include_once "../clases/master_class.php";

$master = new Master();
$api = $_POST['api'];

#datos de pacientes
$curp = $_POST['curp'];

# Datos de turnos
$idTurno = $_POST['idTurno'];
$pacienteId = $_POST['pacienteId'];
$paqueteId = $_POST['paqueteId'];
$prefolio = $_POST['prefolio'];
$folio = $_POST['folio'];
$fechaAgenda = $_POST['fechaAgenda'];
$fechaRecepcion = $_POST['fechaRecepcion'];
$turno = $_POST['turno'];
$habilitado = $_POST['habilitado'];
$identificacion = $_POST['identificacion'];
$total = $_POST['total'];
$completado = $_POST['completado'];



#datos de antecedentes
$antecedentes = $_POST['antecedentes'];
print_r($antecedentes);

switch($api){
    case 1:
        #buscar el paciente por medio de la curp
        $paciente = $master->getByProcedure('sp_pacientes_b',array(null,$curp));

        if(!count($paciente)>0){
            echo "CURP no reconocida";
            exit;
        }
        $pacienteId = $paciente[0]['ID_PACIENTE'];

        # preparamos el array para que consuma el procedure
        $preTurno = array(
            $idTurno,
            $pacienteId,
            $paqueteId,
            $prefolio,
            $folio,
            $fechaAgenda,
            $fechaRecepcion,
            $turno,
            $habilitado,
            $identificacion,
            $total,
            $completado
        );

        #insertar antecedentes
        $lastId = $master->insertByProcedure('sp_turnos_g',$preTurno);

        if(is_numeric($lastId)){
           #si el turno se inserto correctamente, se procede a insertar los antecedentes a ese turno
           foreach($antecedentes as $ante){
                if(count($ante)==3){
                    # si el arreglo tiene 3
                    # quiere decir que tiene id antecedente, id respuesta, y observaciones
                    $ant = array(
                        null, #id_consultortio_antecedente
                        $lastId, #turno_id,
                        $ante[0], #antecedente_subtipo_id
                        $ante[1], #antecedente_respuesta_id
                        $ante[2] #notas
                    );
                    $response = $master->insertByProcedure('sp_consultorio_antecedentes_g',$ant);
                } else {
                    #si el arreglo tiene 2 elementos
                    # quiere decir que tiene id, antecedente y observaciones [sin el id de respuesta]
                    if (is_numeric($ante[1])){
                        $ant = array(
                            null, #id_consultortio_antecedente
                            $lastId, #turno_id,
                            $ante[0], #antecedente_subtipo_id
                            $ante[1], # antecedentes_respuesta_id
                            null #notas
                        );
                    } else {
                        $ant = array(
                            null, #id_consultortio_antecedente
                            $lastId, #turno_id,
                            $ante[0], #antecedente_subtipo_id
                            null, # antecedentes_respuesta_id
                            $ante[1] #notas
                        );
                    }

                    $response = $master->insertByProcedure('sp_consultorio_antecedentes_g',$ant);
                }
           }
        } else {
            # si no se puede insertar el turno, termina el ejecucion
            echo "No hemos podido agendar su visita.";
        }

        echo json_encode(array('response'=>array('code'=>1,'data'=>'Se cargaron sus antecedentes.')));
        exit;

        break;
    case 2:
        # recuperar de los ultimos antecedentes registrardos de un paciente por medio de la curp
        #buscar el paciente por medio de la curp
        $paciente = $master->getByProcedure('sp_pacientes_b',array(null,$curp));

        if(!count($paciente)>0){
            echo "CURP no reconocida";
            exit;
        }
        $pacienteId = $paciente[0]['ID_PACIENTE'];




        break;
    default:
        echo "La selección actual no esta disponible. (API).";
    break;
}
?>
