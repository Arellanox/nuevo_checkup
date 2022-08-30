<?php
include "../interfaces/iMetodos.php";
include "../clases/segmentos_class.php";

// CAMBIAR LOS PARAMETROS DE LAS FUNCIONES PORQUE ESTAN FIJOS Y NO DINAMICOS
// Creamos un objeto de segmentos para trabajar con él.
$segmento = new Segmentos();

$api = 5;

switch($api){
    // Insertar segmentos
    case 1:
        $form = $segmento->master->mis->getFormValues($_POST);
        $result = $segmento->insert($form);
        if(is_numeric($result)){
            echo json_encode(array("response"=>array("code"=>1,"msj"=>"Se ha registrado el segmento correctamente.")));
        }else{
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$result)));
        }
        break;
    // recuperar todos los segmentos activos
    case 2:
        $segmentos = $segmento->getAll();
        
        if(is_array($segmentos)){
            echo json_encode(array("response"=>array("code"=>1,"segmentos"=>$segmentos)));
        }else{
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$segmentos)));
        }
        break;
    // Seleccionar solamente un registro de la tabla segmentos
    case 3:
        //$form = $segmento->master->mis->getFormValues($_POST);
        $seg = $segmento->getById(3);
        if(is_array($seg)){
            echo json_encode(array("response"=>array("code"=>1,"segmento"=>$seg)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$seg)));
        }
        break;
    // Actualizar la información de un segmento
    case 4:
        // El id debe ser el último elemento del arreglo POST
        // $form = $segmento->master->mis->getFormValues($_POST);
        $seg = $segmento->update($form);
        
        if(is_numeric($seg)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$seg)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$seg)));
        }
        break;
    case 5:
        //$deletingId = $_POST['id'];
        $deleted = $segmento->delete(3);
        
        if(is_numeric($deleted)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$deleted)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$deleted)));
        }
        break;
}
?>