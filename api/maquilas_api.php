<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();
$api = $_POST['api'];

$id_paciente = $_POST['id_paciente'];
$nombre = $_POST['nombre'];
$paterno = $_POST['paterno'];
$materno = $_POST['materno'];
$curp = $_POST['curp'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$edad = $_POST['edad'];
$genero = $_POST['genero'];
$area_encuentra = $_POST['area_encuentra'];
$siho_cuenta = $_POST['siho_cuenta'];
#urgencia
$tipo = $_POST['tipo']; #ordinario, urgente
$servicios = $_POST['servicios'];
$comentarios_orden = $_POST['comentarios_orden'];
$orden_medica = $_FILES['orden_medica'];

$id_alta = $_POST['id_alta'];
$id_turno = $_POST['id_turno'];

$pacientes = $_POST['pacientes']; # array

switch($api){
    case 1:
        # Verificar que si el paciente que estan ingresando ya existe.
        $pacientes_existentes = $master->getByProcedure("sp_pacientes_b", [null, null, null, null]);
        $paciente = strtolower($nombre.' '.$paterno.' '.$materno);


        $coincidencias = [];
        foreach($pacientes_existentes as $paciente_existente){
            $base = strtolower($paciente_existente['NOMBRE']. ' '.$paciente_existente['PATERNO']. ' ' .$paciente_existente['MATERNO']);
            $baseTokens = explode(' ', $base);
            $userTokens  = explode(' ', $paciente);

            $matches = 0;

            foreach($userTokens as $userToken) {
                foreach($baseTokens as $baseToken) {
                    if (levenshtein($userToken, $baseToken) <= 2) {
                        $matches++;
                        break;
                    }
                }
            }

            $score = $matches / count($userTokens);

            if ($score > 0.7) {
                $coincidencias[] = $paciente_existente;
            }
        }

        $response = $coincidencias;

        break;
    case 2:
        # Alta/registro paciente.

        # si existe una sesion activa.
        if(!empty($_SESSION['id'])){
            $servicios = explode(',', $servicios);

            $id_turno = $master->insertByProcedure("sp_maquilas_alta_paciente",[
                $id_paciente,
                $nombre,
                $paterno,
                $materno,
                $curp,
                $fecha_nacimiento,
                $edad,
                $genero,
                $area_encuentra,
                $siho_cuenta,
                $tipo,
                json_encode($servicios),
                $comentarios_orden,
                $_SESSION['id'],
                $orden_medica
            ]);
    
            # subimos la orden medica al turno que acabmos de generar.
            $dir = '../archivos/ordenes_medicas/'.$id_turno;
            $r = $master->createDir($dir);
            $orden = $master->guardarFiles($_FILES,'orden_medica',$dir, 'ORDEN_MEDICA_LABORATORIO_'.$id_turno);
            $url = str_replace("../", $host, $orden[0]['url']);
            
            $ordenes = $master->insertByProcedure('sp_ordenes_medicas_g', [null, $id_turno, $url, $orden[0]['tipo'], 6]);

            $response = $id_turno;


        } else {
            $response = "Su sesión ha expirado. Regrese al login.";
            if (!$tokenValido) {
                // $tokenVerification->logout();
            }

        }
        
        break;
    case 3:
        # recuperar solicitudes.
        # que no esten dentro de un lote de envio.

        $response = $master->getByProcedure("sp_maquilas_altas_pacientes_b", [$id_alta, $id_turno]);
        break;

    case 4:
        # crear lotes de envio.
        $pacientes = explode(',', $pacientes);
        $response = $master->insertByProcedure("", [

        ]);
        break;

    default:
        $response = "Api no definida.";
}


echo $master->returnApi($response);