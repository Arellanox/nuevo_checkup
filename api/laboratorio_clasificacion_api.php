<?php 
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
    $tokenVerification->logout();
    exit;
}


# Revisa el metodo por el que recibe la variable api.
# En caso de que no se envie nada, toma la api 2 por default.
$api = isset($_POST['api']) ?  $_POST['api'] : (isset($_GET['api']) ? $_GET['api'] : 2);


#buscar
$id = $_POST['id'];

#insertar
$id_clasificacion = $_POST['id_clasificacion'];
$descripcion = $_POST['descripcion'];

$parametros = array(
    $id_clasificacion,
    $descripcion
);
$master = new Master();
switch ($api) {
    case 1:
        #insert
        $values = $master->mis->getFormValues($_POST);
        echo $master->mis->returnApi($master->insertByProcedure('sp_laboratorio_clasificacion_examen_g',$values));
        
        break;
    case 2:
        #getall
        echo $master->mis->returnApi($master->getByProcedure('sp_laboratorio_clasificacion_examen_b',array($id)));
        break;
    case 3:
        #update
        $values = $master->mis->getFormValues($_POST);
        echo $master->mis->returnApi($master->updateByProcedure('sp_laboratorio_clasificacion_examen_g',$values));
        break;
    case 4:
        #eliminar
        echo $master->mis->returnApi($master->deleteByProcedure('sp_laboratorio_clasificacion_examen_e',array($id)));
        break;    
    default:
        echo json_encode('OPCION DEFAULT. API '.$api);
        break;
}

?>