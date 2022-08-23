<?php
include "../clases/clientes_class.php";
//include "../clases/miscelaneus.php";

$client = new Clientes();
$form = $client->mis->getFormValues($_POST);
$api = 5;//$form['api'];

switch($api){
    //insertar un nuevo cliente
    case 1:
        $form = $client->mis->getFormValues($_POST);
        $return = $client->insert($form['segmento'],$form['nombre_comercial'],$form['razon_social'],
                                    $form['nombre_sistema'],$form['rfc'],$form['curp'],$form['direccion_fiscal'],
                                    $form['direccion_entrega_servicios'],$form['direccion'],$form['abreviatura']);
        
        if($return>=1){
            echo json_encode(array("response"=>array("code"=>1,"msj"=>"¡Cliente agregado!")));
        }else{
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$return)));
        }
        break;
    //recuperar la lista de los clientes activos
    case 2:
        $return = $client->getAll();

        if(is_array($return)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$return)));
        }else{
           echo json_encode(array("response"=>array("code"=>0,"msj"=>$return)));
        }
        break;
    //recuperar los datos de un cliente especifico
    case 3:
        $form = $client->mis->getFormValues($_POST);
        $return = $client->getById($form['id']);

        if(is_array($return)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$return)));
        }else{
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$return)));
        }
        break;
    //actualiza la informacion de un cliente
    case 4:
        $form = $client->mis->getFormValues($_POST);
        $return = $client->update($form['id'],$form['segmento'],$form['nombre_comercial'],$form['razon_social'],
                                    $form['nombre_sistema'],$form['rfc'],$form['curp'],$form['direccion_fiscal'],
                                    $form['direccion_entrega_servicios'],$form['direccion'],$form['abreviatura']);
        
        if($return>=1){
            echo json_encode(array("response"=>array("code"=>1,"msj"=>"Información del cliente actualizada.")));
        }else{
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$return)));
        }
        break;
    case 5:
        $form = $client->mis->getFormValues($_POST);
        $return = $client->delete($form['id']);
        if($return>0){
            echo json_encode(array("response"=>array("code"=>1,"msj"=>"Cliente eliminado.")));
        }else{
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$return)));
        }
        break;
}

?>