<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
require_once "../clases/preregistro_correo_token_class.php";
include_once "../clases/correo_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

#api
$api = $_POST['api'];

#buscar
$id_preregistro = $_POST['id_preregistro'];
$correo = $_POST['correo'];
$token_correo = $_POST['token'];
$turno_id = $_POST['id_turno'];
$response = "";

$master = new Master();
switch ($api) {
    case 1:
        #verifico que sea un correo válido, luego intento generar el token en la base de datos y luego intento enviarlo junto a la url por mail
        if (!(filter_var($correo, FILTER_VALIDATE_EMAIL))) {
            $response = "Dirección de correo inválida";
        } else {
            $tokenPregistro = new TokenPreregistro();
            $token = $tokenPregistro->generarTokenPreregistro($correo);
            if ($token != '') {
                $motivo = "Token para registro de cita en linea";
                // echo $motivo;
                $mensaje = '<!DOCTYPE html>
                <html lang="en">
                
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                </head>
                
                <body>
                    <div>
                        <div style="display:flex; justify-content:center;">
                            <img src="https://www.bimo-lab.com/archivos/sistema/LogoConFondoAppAndroid.png" />
                            <img style="max-height:100px;" src="https://cdn19.picsart.com/9896529016.png">
                        </div>
                        <br />
                        <br />
                        <div style="max-width:35%; min-width:500px; margin:auto;">
                            <div style="background-color:lightgray; border-radius:5px 5px 0px 0px; padding: 5px; display:block;">
                                <p style="text-align:center; padding:0; margin:0;">Gracias por contactartar con BIMO armas biológicas,
                                    puede hacer su preregistro desde el siguiente link </p>
                            </div>
                            <div
                                style="border-width: 0 1px 1px 1px; border-color:lightgray; border-style:solid; padding:5px; display:flex; justify-content:center; border-radius: 0px 0px 5px 5px">
                                <a href="https://bimo-lab.com/nuevo_checkup/vista/registro/index.php?codigo='.$token.'" style="text-decoration:none;">Registro en linea</a>
                            </div>
                
                        </div>
                
                    </div>
                </body>
                
                </html>';
                // Para enviar un correo HTML, debe establecerse la cabecera Content-type
                $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                // $respuestaCorreo = mail($correo, $motivo, $mensaje,$cabeceras);
                // //   echo $respuestaCorreo;
                // if ($respuestaCorreo) {
                //     $response = 1;
                // } else {
                //     $response = "Ocurrio un problema al intentar enviar el correo";
                // }

                $correo_obj = new Correo();
                $respuesta_mail = $correo_obj->sendLinkByEmail($correo, $token);

                if ($respuesta_mail) {
                    $response = 1;
                } else {
                    $response = "Ocurrio un problema al intentar enviar el correo";
                }
            } else {
                $response = "No se ha podido generar el token. " . $token;
            }
        }
        break;
    case 2:
        #verifica si el token aún es válido por fecha, verifica si el token no ha sido ya concluido y verifica que siga ACTIVO
        $response = $master->getByProcedure("sp_preregistro_token_valido_b", [$token_correo]);
        break;

    case 3:
        #Actualizo a concluido el token para que ya no se pueda utilizar y guardo el turno que generó
        $response = $master->getByProcedure("sp_preregistro_token_g", [$id_preregistro, null, $turno_id]);
        break;
    default:
        $response = "api no reconocida";
        break;
}

echo $master->returnApi($response);
