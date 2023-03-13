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

$turno_id = $_POST['turno_id'];
$area_fisica_id = $_POST['area_fisica_id'];

$master = new Master();

$listaGlobal;
switch ($api) {
    case 1:
        # Liberar paciente.

        // $infoPaciente = $master->getByProcedure('sp_pantalla_turnero', [null]);
        // print_r($infoPaciente);

        $response = $master->updateByProcedure("sp_turnero_liberar_paciente", [$turno_id, $area_fisica_id]);
        $_SESSION['turnero'] = null;
        break;
    case 2:
        # llamar paciente

        # si la listaGlobal$listaGlobal esta vacia, la llenamos
        $response = llamarPaciente($master, $area_fisica_id);

        break;
    case 3:
        # saltar paciente

        # Actualizamos la lista por si existe algun cambio
        fillSessionList($master, $area_fisica_id);

        if (empty($listaGlobal)) {
            # si la lista esta vacia puede significar 2 cosas:
            # 1. Que no haya pacientes para esa area el dia actual.
            # 2. Que aun los pacientes no hayan pasado a toma de muestras o somatometria.
            # Si sucede lo anterior, enviamos un mensaje coqueto.
            $response = $master->decodeJson(['{"mensaje":"Nada por aquí."}']);
        } else {
            # si no esta vacia.
            # verificamos que el turnero en session este iniciado
            if (empty($_SESSION['turnero']) || !isset($_SESSION['turnero'])) {
                # si esta vacio o no existe el turnero en session no podemos saltar paciente, necesitamos llamarlo.
                $response = llamarPaciente($master, $area_fisica_id);
            } else {
                # si ya existe el turnero, debemos verificar
                # si el paciente que estamos saltando es el correcto.
                $x = $master->deleteByProcedure("sp_turnero_saltar_paciente", [$_SESSION['turnero']['turno'], $area_fisica_id]);

                if ($x > 0) {
                    #refresamos la listea para regresar al paciente que acabamos de saltar
                    fillSessionList($master, $area_fisica_id);
                    # buscar la posicion del turno que acabas de borrar
                    $position = 0;
                    foreach ($listaGlobal->getPacientes() as $pat) {

                        if ($pat->getTurnoId() == $_SESSION['turnero']['turno']) {
                            $listaGlobal->setPosition($position);
                            break;
                        }
                        $position++;
                    }

                    $listaGlobal->setPosition($listaGlobal->getPosition() + 1);

                    # llamamos al paciente que sigue
                    $response = $listaGlobal->getNextPatient();
                    # Reservamos el turno para el area correspondiente.
                    $sp = $master->insertByProcedure("sp_turnero_llamar_paciente", [$response->getTurnoId(), $area_fisica_id]);

                    # y finalmente actualizamos los datos por si hay que saltarlo de nuevo.
                    $_SESSION['turnero']['turno'] = $response->getTurnoId();
                }


                // if(current($listaGlobal->getPacientes())->getTurnoId()==$_SESSION['turnero']['turno']){
                //     # como el turno en la session coincide con la actualizacion de la lista,
                //     # incrementamos la posicion un lugar.
                //     $listaGlobal->setPosition($listaGlobal->getPosition() + 1);

                //     # llamamos al paciente que sigue
                //     $response = $listaGlobal->getNextPatient();

                //     # y finalmente actualizamos los datos por si hay que saltarlo de nuevo.
                //     $_SESSION['turnero']['turno'] = $response->getTurnoId();
                // } else {
                //     # en caso de que no sea el mismo
                //     # significa que fue llamado por otra area.

                // }
            }
        }

        break;
    case 4:
        # pantalla turnero
        // echo $_SESSION['pacientes_llamados'];
        $response1 = $master->getByNext('sp_turnero_pantalla', [isset($_SESSION['pacientes_llamados']) ? $_SESSION['pacientes_llamados'] : 0]);

        // $object = array();

        // foreach ($response1[0] as $item) {
        //     $object[]['TURNO'] = $item;
        // }

        $response = $response1[0];

        $_SESSION['pacientes_llamados'] = $response1[1][0]["PACIENTES_LLAMADOS"];
        break;
    case 5:
        # Muestra el sitio actual en el que se encuentra el paciente.
        # En sala de espera, o el nombre del area.

        $response = $master->getByProcedure("sp_turnero_paciente_area_actual", []);
        break;
    default:
        $response = "api no reconocida";
        break;
}

echo $master->returnApi($response);

function llamarPaciente($master, $area_fisica_id)
{
    global $listaGlobal;
    fillSessionList($master, $area_fisica_id);

    if (empty($listaGlobal)) {
        # si la lista sigue vacia despues de llamar el sp,
        # significa que no hay pacientes para esa area.
        $response = "Nada por aquí, nada por allá.";
    } else {
        # si la lista no esta vacia, llamamos al primer paciente aceptado.
        $object = current($listaGlobal->getPacientes());
        // echo $object->getTurnoId();
        sleep(1);
        $response = $master->insertByProcedure("sp_turnero_llamar_paciente", [$object->getTurnoId(), $area_fisica_id]);

        if (isset($response[0]['MSJ'])) {
            if ($master->str_ends_with($response[0]['MSJ'], "}")) {
                $response = $master->decodeJson([$response]);
                #$response = isset($response[0]['mensaje']) ? $response : $response[0];
            } else {
                $response = $response[0]['MSJ'];
            }
        }


        $_SESSION['turnero'] = array("turno" => $object->getTurnoId());
    }
    return $response;
}

function fillSessionList($master, $area)
{
    global $listaGlobal;
    $response = $master->getByProcedure('sp_turnero_lista_pacientes', [$area]);
    $listaGlobal = fillListPatient($response);
}
function fillListPatient($query)
{

    $lista = new ListaPacientes();

    foreach ($query as $patient) {
        $paciente = new Paciente();
        $paciente->setAreaId($patient['AREA_ID']);
        $paciente->setEtiquetaTurno($patient['ETIQUETA_TURNO']);
        $paciente->setPaciente($patient['PACIENTE']);
        $paciente->setTurnoId($patient['TURNO_ID']);

        $lista->pushPaciente($paciente);
    }

    return $lista;
}
