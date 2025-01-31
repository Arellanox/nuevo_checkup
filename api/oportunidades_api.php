<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

$master = new Master();
$api = $_POST['api'];

$id_oportunidad = $_POST['id_oportunidad'];
$id_empresa = $_POST['id_empresa'];
$descripcion_empresa = $_POST['nombreEmpresa'];
$tipo_empresa = $_POST['tipoEmpresa'];

switch($api){
    case 1:
        # registrar una empresa.
        $response = $master->insertByProcedure('sp_oportunidades_empresas_g', [
            $id_empresa, 
            $descripcion_empresa, 
            $tipo_empresa, 
            $_SESSION['id']]);
        break;
    case 2:
        # buscar oportunidades
        $response = $master->getByProcedure('sp_oportunidades_b', [$id_oportunidad, $id_empresa, null, $_SESSION['id']]);
        break;
    case 3:
        # buscar empresas
        $response = $master->getByProcedure('sp_oportunidades_empresas_b', [$id_empresa,null]);
        break;

    case 4:
        #eliminar empresas
        $response = $master->deleteByProcedure("sp_oportunidades_empresas_e", [$id_empresa, $_SESSION['id']]);
        break;
    default:
        $response = "Api no definida";
        break;
}


echo $master->returnApi($response);