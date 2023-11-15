<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include "../clases/correo_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();
$api = $_POST['api'];

# variables para lista de trabajo.
$fecha = $_POST['fecha_busqueda'];

# variables para certificado slb
$turno_id = $_POST['turno_id'];


switch($api){
    case 1:
        # lista de trabajo para certificados.
        # pacientes que tengan cargado entre sus estudios una historia clinica.
        $response = $master->getByProcedure("sp_lista_de_trabajo_certificados", [$fecha, 1, null, null, null]);
        break;
    default:
        $response = "API no definida.";
    break;

}

echo $master->returnApi($response);
?>