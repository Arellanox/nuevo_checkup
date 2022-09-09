<?php
include "../interfaces/iMetodos.php";
include "../clases/usuarios_class.php";
include "../clases/cargos_class.php";
include "../clases/tipos_usuarios_class.php";

$usuario = new Usuarios();

$api = $_POST['api'];

switch ($api) {
    case 1:
        $array_slice = array_slice($_POST,0,11);
        $a = $usuario->master->mis->getFormValues($array_slice);
        // $newRecord = array(4,1,"Josue","De la Cruz","Arellano","Arellanox","arditas","Ingeniero en TI");
        $response = $usuario->insert($a);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"lastId"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 2:
        $response = $usuario->getAll();

        if(is_array($response)){
            $completedUser = array();
            $i = 1;
            foreach($response as $user){
                $cargo = new Cargos();
                $tipo = new TiposUsuarios();
                $labelCargo = $cargo->getById($user["CARGO_ID"]);
                $labelTipo = $tipo->getById($user['TIPO_ID']);

                $user[] = $labelCargo;
                $user[] = $labelTipo;
                $user['nombrecompleto'] = $user['NOMBRE']." ".$user['PATERNO']." ".$user['MATERNO'];
                $user['count'] = $i;
                $user['ACTIVO'] = $user['BLOQUEADO']?"INACTIVO":"ACTIVO";
                $i++;
                $completedUser[] = $user;
            }
            echo json_encode($completedUser);
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;

    case 3:
        $response  = $usuario->getById($_POST['id']);
        if(is_array($response)){
            $completedUser = array();

            foreach($response as $user){
                $cargo = new Cargos();
                $tipo = new TiposUsuarios();
                $labelCargo = $cargo->getById($user["CARGO_ID"]);
                $labelTipo = $tipo->getById($user['TIPO_ID']);

                $user[] = $labelCargo;
                $user[] = $labelTipo;

                $completedUser[] = $user;
            }
            echo json_encode(array("response"=>array("code"=>1,"data"=>$completedUser)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;

    case 4:
        $array_slice = array_slice($_POST,0,11);
        $a = $usuario->master->mis->getFormValues($array_slice);
        $response = $usuario->update($a);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 5:
        $response = $usuario->delete($_POST['id']);
        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 6:
        // Iniciar sesión
        $response = $usuario->startSession($_POST['user'],$_POST['pass']);

        if(is_array($response)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>'login',"msj"=>$response)));
        }
        break;
    case 7:
        //Actualizar estado del usuario
        $response = $usuario->estadoUsuario($_POST['id'], $_POST['estado']);
        if (is_numeric($response)) {
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 8:
        $response = $usuario->validarUsuario($_POST['id']);
        if ($response != 0) {
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"data"=>$response)));
        }

    default:
        # code...
        break;
}
?>
