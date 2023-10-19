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
$turno_id = $_POST['turno_id'];
$firma = $_POST['firma'];
$servicio_id = $_POST['servicio_id'];
$url = $_POST['url']; 
$descripcion = $_POST['descripcion'];
$servicios = $_POST['servicios']; 
$id_consentimiento = $_POST['id_consentimiento'];



$data_firma_g = $master->setToNull(array(
    $turno_id,
    $firma,
    $servicio_id,
    $url

));

$data_consentimiento_g = $master->setToNull(array(
    $url,
    $descripcion,
    $servicios,
    $id_consentimiento
));


$data_consentimiento_e = $master->setToNull(array(
    $id_consentimiento,
    $servicio_id
));






switch ($api) {
    case 1:
        #RECUPERA LA INFORMACION DEL PACIENTE Y EL CONSENTIMIENTO
        $response = $master->getByProcedure("sp_consentimiento_formato_b", [$turno_id]);

        break;
    case 2:
        #GUARDA LA FIRMA DEL COSENTIMIENTO
        $response = $master->getByProcedure("sp_consentimiento_firma_g", $data_firma_g);

        break;
    case 3:
        #GUARDA EL CONCENTIMIENTOS CON TODO Y SERVICIOS
        $response = $master->getByProcedure("sp_consentimieto_g", $data_consentimiento_g);

        break;
    case 4:
        #ELIMINA LOS SERVICIOS DE UIN CONSENTIMIENTO
        $response = $master->getByProcedure("sp_consentimiento_estudios_e" , $data_consentimiento_e);

        break;
    default:
        $response = "api no reconocida";
        break;
}

echo $master->returnApi($response);
