<?php 
include "../clases/master_class.php";

$master = new Master();

# Revisa el metodo por el que recibe la variable api.
# En caso de que no se envie nada, toma la api 2 por default.
$api = isset($_POST['api']) ?  $_POST['api'] : (isset($_GET['api']) ? $_GET['api'] : 2);


switch ($api) {
    case 1:
        $values = $master->mis->getFormValues(array_slice($_POST,0,3));
        echo $master->mis->returnApi($master->insertByProcedure('sp_catalogo_g',$values));
        break;
    case 2:
        echo $master->mis->returnApi($master->getByProcedure('sp_catalogo_b',array(null)));
        break;
    case 3:
        $values = $master->mis->getFormValues(array_slice($_POST,0,1));
        echo $master->mis->returnApi($master->getByProcedure('sp_catalogo_b',$values));
        break;
    case 4:
        $values = $master->mis->getFormValues(array_slice($_POST,0,4));
        echo $master->mis->returnApi($master->updateByProcedure('sp_catalogo_g',$values));
        break;
    case 5:
        $values = $master->mis->getFormValues(array_slice($_POST,0,1));
        echo $master->mis->returnApi($master->deleteByProcedure('sp_catalogo_e',$values));
        break;
    
    default:
        echo "What the hell are you trying to do?";
        break;
}
?>