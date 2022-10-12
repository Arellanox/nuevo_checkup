<?php
include "../interfaces/iMetodos.php";
require_once "../clases/token_auth.php";
include "../clases/clientes_class.php";
include "../clases/contactos_class.php";
include_once "../clases/master_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
    $tokenVerification->logout();
    exit;
}

$master = new Master();

$client = new Clientes();
//$form = $client->mis->getFormValues($_POST);
$api = $_POST['api'];//$form['api'];
$id=$_POST['id'];
switch($api){
    //insertar un nuevo cliente
    case 1:
        $array_slice = array_slice($_POST, 0, 14);
        $values = $master->mis->getFormValues($array_slice);
        // $newClient = array("Quimax","QUIMAX",null,"ZXCV","ZXCV",null,round(456,2),20,887766,null,null,null,null);
        $return = $client->insert($values);

        if($return>=1){
            echo json_encode(array("response"=>array("code"=>1,"msj"=>"¡Cliente agregado!")));
        }else{
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$return)));
        }
        break;
    //recuperar la lista de los clientes activos
    case 2:
        $response = $master->getByProcedure("sp_clientes_b",array(null));

        if(is_array($response)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        }else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
       /*  $return = $client->getAll();
        $newSet = array();

        if(is_array($return)){
            foreach($return as $cliente){
                $contact = new Contactos();
                $contactos = $contact->getByCliente($cliente['ID_CLIENTE']);
                $cliente['CONTACTOS'] = $contactos;
                $cliente[] = $contactos;
                $newSet[] = $cliente;
            }
            echo json_encode(array("response"=>array("code"=>1,"data"=>$newSet)));
        }else{
           echo json_encode(array("response"=>array("code"=>0,"msj"=>$return)));
        } */
        break;
    //recuperar los datos de un cliente especifico
    case 3:
        $return = $client->getById(3);
        $newSet = array();

        if(is_array($return)){
            foreach($return as $cliente){
                $contact = new Contactos();
                $contactos = $contact->getByCliente($cliente['ID_CLIENTE']);
                $cliente['CONTACTOS'] = $contactos;
                $cliente[] = $contactos;
                $newSet[] = $cliente;
            }
            echo json_encode(array("response"=>array("code"=>1,"data"=>$newSet)));
        }else{
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$return)));
        }
        break;
    //actualiza la informacion de un cliente
    case 4:
        $form = $client->mis->getFormValues($_POST);
        $return = $client->update($values);

        if($return>=1){
            echo json_encode(array("response"=>array("code"=>1,"msj"=>"Información del cliente actualizada.")));
        }else{
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$return)));
        }
        break;
    case 5:
        $return = $client->delete(3);
        if($return>0){
            echo json_encode(array("response"=>array("code"=>1,"msj"=>"Cliente eliminado.")));
        }else{
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$return)));
        }
        break;
    case 6:
        //Obtener cliente por codigo
        $response = $client->getByCodigo($_POST['id']);
        if(is_array($response)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        }else{
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }

    break;
    case 10:
        $master = new Master();
        $return = $master->getByProcedure("sp_clientes_b",[]);
        $newSet = array();

        if(is_array($return)){
            foreach($return as $cliente){
                $contact = new Contactos();
                $contactos = $contact->getByCliente($cliente['ID_CLIENTE']);
                $cliente['CONTACTOS'] = $contactos;
                $cliente[] = $contactos;
                $newSet[] = $cliente;
            }
            echo json_encode(array("response"=>array("code"=>1,"data"=>$newSet)));
        }else{
           echo json_encode(array("response"=>array("code"=>0,"msj"=>$return)));
        }
        break;
}

?>
