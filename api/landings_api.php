<?php

$datos = json_decode(file_get_contents('php://input'), true);

header("Access-Control-Allow-Origin: https://bimo.com.mx");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
// Asegúrate de incluir cualquier otro método o cabecera que tu API necesite
require_once "../clases/master_class.php";
require_once "../clases/correo_class.php";

$master = new Master;
$mail = new Correo();
$api = $datos['api'];
$id_area = $datos['id_area'];
$nombre = $datos['nombre'];
$email = $datos['email'];
$telefono = $datos['telefono'];
$clave = $datos['clave'];

switch($api){
    case 1:
        $response = $master->insertByProcedure('sp_landings_contactos_g', [
            $nombre,
            $email,
            $telefono,
            $id_area,
            $clave
        ]);


        # Enviar correos con los datos del nuevo lead captado.
        if (isset($id_area) && $id_area == 8){
            $mail->sendEmail(
                "landings",
                "¡Quiero una radiografía!",
                ["josue.delacruz@bimo.com.mx", "hola@bimo.com.mx"],
                $datos
            );
        } else {
            $mail->sendEmail(
                'landings_2',
                '¡Nuevo lead captado!',
                ['hola@bimo.com.mx', 'josue.delacruz@bimo.com.mx'],
                $datos
            );
        }

        
        break;

    default:
        $response = "Servicio no disponible";
}

echo $master->returnApi($response);
