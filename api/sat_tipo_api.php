<?php 
include "../clases/master_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
    $tokenVerification->logout();
    exit;
}

$master = new Master();

$api = $_POST['api'];

switch ($api) {
    case 1:
        $values = $master->mis->getFormValues(array_slice($_POST,0,1));
        echo $master->mis->returnApi($master->insertByProcedure('sp_sat_tipos_g',$values));
        break;
    case 2:
        echo $master->mis->returnApi($master->getByProcedure('sp_sat_tipos_b',array(null)));
        break;
    case 3:
        $values = $master->mis->getFormValues(array_slice($_POST,0,1));
        echo $master->mis->returnApi($master->getByProcedure('sp_sat_tipos_b',$values));
        break;
    case 4:
        $values = $master->mis->getFormValues(array_slice($_POST,0,2));
        echo $master->mis->returnApi($master->updateByProcedure('sp_sat_tipos_g',$values));
        break;
    case 5:
        $values = $master->mis->getFormValues(array_slice($_POST,0,1));
        echo $master->mis->returnApi($master->deleteByProcedure('sp_sat_tipos_e',$values));
        break;
    
    default:
        echo "Default";
        break;
}
?>