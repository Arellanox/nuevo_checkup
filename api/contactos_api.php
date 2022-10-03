<?php
include "../interfaces/iMetodos.php";
include "../clases/contactos_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
    $tokenVerification->logout();
    exit;
}

$contact = new Contactos();
$api = 2;

switch ($api) {
    case 1:
        $nuevo = array(1,"CAROLINA","DE LA CRUZ",9931882501,NULL,"cahazo27@gmail.com");
        $response = $contact->insert($nuevo);
        if (is_numeric($response)) {
            echo json_encode(array("response"=>array("code"=>1,"msj"=>"¡Contacto agregado!")));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;
    
    case 2:
        $response = $contact->getAll();

        if(is_array($response)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;
    case 3:
        $response = $contact->getById(1);
        if(is_array($response)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;

    case 4:
        $response = $contact->update($values);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;
    
    case 5:
        $response = $contact->delete(1);

        if (is_numeric($response)) {
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>1,"msj"=>$response)));
        }
        
        break;
    
    default:
        # code...
        break;
}

?>