<?php
include "../interfaces/iMetodos.php";
include "../clases/usuarios_class.php";
include "../clases/cargos_class.php";
include "../clases/tipos_usuarios_class.php";

$usuario = new Usuarios();

$api = $_POST['api'];

switch ($api) {
    case 1:
        $array_slice = array_slice($_POST,0,9);
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
                $i++;
                $completedUser[] = $user;
            }
            echo json_encode($completedUser);
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;

    case 3:
        $response  = $usuario->getById(1);
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
        $form = $usuario->master->mis->getFormValues($values);
        $response = $usuario->update($form);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 5:
        $response = $usuario->delete(1);
        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 6:
        // Iniciar sesión
        $response = $usuario->startSession("Arellanox","arditas");

        if(is_array($response)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;

    default:
        # code...
        break;
}
?>
