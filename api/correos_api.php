<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/Pdf.php";
include "../clases/correo_class.php";


$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    # $tokenVerification->logout();
    # exit;
}

$master = new Master();
$api = $_POST['api'];

$id_correo = $_POST['id_correo'];
$turno_id = $_POST['turno_id'];
$area_id = $_POST['area_id'];
$correo_origen = $_POST['correo_origen'];
$correo_destino = $_POST['correo_destino'];
$notas = $_POST['notas'];
$enviado = $_POST['enviado'];
$fecha = $_POST['fecha'];

switch($api){
    case 1:
        break;
    case 2:
        # buscar informacion de la tabla de correos.
        $response = $master->getByProcedure("sp_correos_b", [$turno_id, $fecha, $enviado, $area_id]);
        break;
}