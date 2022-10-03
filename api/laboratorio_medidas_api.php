<?php 
include "../clases/master_class.php";

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

if($api!=2){
    if(is_null($_POST)){
        echo "No se recibieron parámetros";
        return;
    }
}

switch ($api) {
    case 1:
        echo $master->mis->returnApi($master->insertByProcedure('sp_laboratorio_medidas_g',$values));
        break;
    
    case 2:
        echo $master->mis->returnApi($master->getByProcedure('sp_laboratorio_medidas_b',array(null)));
        break;
    case 3:
        $values = $master->mis->getFormValues(array_slice($_POST,0,1));
        echo $master->mis->returnApi($master->getByProcedure('sp_laboratorio_medidas_b',$values));
        break;
    case 4:
        $values = $master->mis->getFormValues($_POST);
        echo $master->mis->returnApi($master->insertByProcedure('sp_laboratorio_medidas_g',$values));
        break;
    case 5:
        echo $master->mis->returnApi($master->insertByProcedure('sp_laboratorio_medidas_e',$values));
        break;
    
    default:
        # code...
        break;
}
?>