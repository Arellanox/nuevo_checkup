<?php
include_once '../clases/master_class.php';
include_once '../clases/token_auth.php';
include_once '../clases/correo_bot_class.php';

$master = new Master();

$api = $_POST['api'];

//Datos a enviar
$nombre_completo = $_POST['nombre_completo'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$telefono = $_POST['telefono'];
$orden_medica = $_POST['orden_medica'];

$token = array(
    'ordenMedica' => $orden_medica,
    'nombrePaciente' => $nombre_completo,
    'telefono' => $telefono,
    'fechaNacimiento' => $fecha_nacimiento,
);

$correoBot = new CorreoBot($token);


switch ($api) {
    case 1:
        // Envia los datos al correo
        // $response = $master->insertByProcedure('sp_valores_referencia_g', $insert_datos);
        if($correoBot->MandarCorreo()){
            $response = 1;
        }else{
            $response = 'No se puedo enviar el correo';
        }

        break;


    default:
        $response = "API no definida";
        break;
}

echo $master->returnApi($response);
