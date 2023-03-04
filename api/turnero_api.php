<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/Pdf.php";
include_once "../clases/turnero_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    # $tokenVerification->logout();
    # exit;
}

#api
$api = $_POST['api'];

$area = $_POST['area_id'];

$master = new Master();
$listaGlobal = null ;
switch ($api) {
    case 1:
        $master = new Master();
        #Recuperar info turnos a pasar
        $infoPaciente = $master->getByProcedure('sp_pantalla_turnero', [null]);
        print_r($infoPaciente);
        break;
    case 2:
        # llamar paciente
        if(empty($listaGlobal)){
            # si la listaGlobal$listaGlobal esta vacia, la llenamos
            fillSessionList($master,$area);

            if(empty($listaGlobal)){
                # si la lista sigue vacia despues de llamar el sp,
                # significa que no hay pacientes para esa area.
                $response = "Nada por aquí, nada por allá.";
            } else {
                # si la lista no esta vacia, llamamos al primer paciente aceptado.
                $response = current($listaGlobal->getPacientes());
            }
        }
        break;
    case 3:
        # saltar paciente
        if(empty($listaGlobal)){
            fillSessionList($master,$area);
            if(empty($listaGlobal)){
                $response = "Nada por aquí.";
            } else {
                $listaGlobal->setPosition($listaGlobal->getPosition()+1);
                setcookie("position",$listaGlobal->getPosition()+1);
                $response = $listaGlobal->getNextPatient();
            }
        } else {
            $listaGlobal->setPosition($listaGlobal->getPosition()+1);
            setcookie("position",$listaGlobal->getPosition()+1);
            $response = $listaGlobal->getNextPatient($listaGlobal->getPosition);
        }
        break;
    case 4:
        # pantalla turnero
        $response = $master->getByProcedure('sp_turnero_pantalla',[]);
        break;
    default:
        $response = "api no reconocida";
        break;
}

echo $master->returnApi($response);


function fillSessionList($master, $area){
    global $listaGlobal;
    $response = $master->getByProcedure('sp_turnero_lista_pacientes',[$area]);
    $listaGlobal = fillListPatient($response);
}
function fillListPatient($query){
    
    $lista = new ListaPacientes();
    
    foreach($query as $patient){
        $paciente = new Paciente();
        $paciente->setAreaId($patient['AREA_ID']);
        $paciente->setEtiquetaTurno($patient['ETIQUETA_TURNO']);
        $paciente->setPaciente($patient['PACIENTE']);
        $paciente->setTurnoId($patient['TURNO_ID']);

        $lista->pushPaciente($paciente);

    }

    return $lista;
}