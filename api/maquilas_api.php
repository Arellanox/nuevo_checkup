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
        $response = $master->insertByProcedure("sp_maquilas_alta_paciente",[
            $id_paciente,
            $nombre,
            $paterno,
            $materno,
            $curp,
            $fecha_nacimiento,
            $edad,
            $genero,
            json_enconde(["area_encuentra"=>$area_encuentra, "cuenta_siho"=>$siho_cuenta]),
            
        ]);
        
        break;
}


echo $master->returnApi($response);