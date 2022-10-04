<?php 
include "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
    $tokenVerification->logout();
    exit;
}

$master = new Master();

# Revisa el metodo por el que recibe la variable api.
# En caso de que no se envie nada, toma la api 2 por default.
$api = isset($_POST['api']) ?  $_POST['api'] : (isset($_GET['api']) ? $_GET['api'] : 2);

switch ($api) {
    case 1:
        #insert
        $values = $master->mis->getFormValues($_POST);
        echo $master->mis->returnApi($master->insertByProcedure('sp_laboratorio_clasificacion_examen_g',$values));
        
        break;
    case 2:
        #getall
        echo $master->mis->returnApi($master->getByProcedure('sp_laboratorio_clasificacion_examen_b',array(null)));
        break;
    case 3:
        #getbyid
        echo $master->mis->returnApi($master->getByProcedure('sp_laboratorio_clasificacion_examen_b',array($id)));
        break;
    case 4:
        #update
        $values = $master->mis->getFormValues($_POST);
        echo $master->mis->returnApi($master->updateByProcedure('sp_laboratorio_clasificacion_examen_b',$values));
        break;
    case 5:
        echo $master->mis->returnApi($master->deleteByProcedure('sp_laboratorio_clasificacion_examen_e',array($id)));
        break;    
    default:
        echo json_encode('OPCION DEFAULT. API '.$api);
        break;
}

?>