<?php
include "../interfaces/iMetodos.php";
require_once "../clases/token_auth.php";
include "../clases/usuarios_class.php";
include "../clases/cargos_class.php";
include "../clases/tipos_usuarios_class.php";
include_once "../clases/master_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
    $tokenVerification->logout();
    exit;
}

$usuario = new Usuarios();
$master = new Master();

$api = isset($_POST['api']) ? $_POST['api'] : $_GET['api'];

switch ($api) {
    case 1:
        $array_slice = array_slice($_POST, 0, 11);
        $a = $usuario->master->mis->getFormValues($array_slice);
        // $newRecord = array(4,1,"Josue","De la Cruz","Arellano","Arellanox","arditas","Ingeniero en TI");
        $response = $usuario->insert($a);

        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "lastId" => $response)));
        } else {
            echo json_encode(array("response" => array("code" => 2, "msj" => $response)));
        }
        break;
    case 2:
        $response = $usuario->getAll();

        if (is_array($response)) {
            $completedUser = array();
            $i = 1;
            foreach ($response as $user) {
                $cargo = new Cargos();
                $tipo = new TiposUsuarios();
                $labelCargo = $cargo->getById($user["CARGO_ID"]);
                $labelTipo = $tipo->getById($user['TIPO_ID']);

                $user[] = $labelCargo;
                $user[] = $labelTipo;
                $user['nombrecompleto'] = $user['NOMBRE'] . " " . $user['PATERNO'] . " " . $user['MATERNO'];
                $user['count'] = $i;
                $user['ACTIVO'] = $user['BLOQUEADO'] ? "INACTIVO" : "ACTIVO";
                $i++;
                $completedUser[] = $user;
            }
            echo json_encode($completedUser);
        } else {
            echo json_encode(array("response" => array("code" => 2, "msj" => $response)));
        }
        break;

    case 3:
        $response  = $usuario->getById($_POST['id']);
        if (is_array($response)) {
            $completedUser = array();

            foreach ($response as $user) {
                $cargo = new Cargos();
                $tipo = new TiposUsuarios();
                $labelCargo = $cargo->getById($user["CARGO_ID"]);
                $labelTipo = $tipo->getById($user['TIPO_ID']);

                $user[] = $labelCargo;
                $user[] = $labelTipo;

                $completedUser[] = $user;
            }
            echo json_encode(array("response" => array("code" => 1, "data" => $completedUser)));
        } else {
            echo json_encode(array("response" => array("code" => 2, "msj" => $response)));
        }
        break;

    case 4:
        $array_slice = array_slice($_POST, 0, 11);
        $a = $usuario->master->mis->getFormValues($array_slice);
        $response = $usuario->update($a);

        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response)));
        } else {
            echo json_encode(array("response" => array("code" => 2, "msj" => $response)));
        }
        break;
    case 5:
        $response = $usuario->delete($_POST['id']);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response)));
        } else {
            echo json_encode(array("response" => array("code" => 2, "msj" => $response)));
        }
        break;
    case 6:
        // Iniciar sesión
        $response = $usuario->startSession($_POST['user'], $_POST['pass']);

        if (is_array($response)) {
            echo json_encode(array("response" => array("code" => 1, "data" => $response)));
        } else {
            echo json_encode(array("response" => array("code" => 'login', "msj" => $response)));
        }
        break;
    case 7:
        //Actualizar estado del usuario
        $response = $usuario->estadoUsuario($_POST['id'], $_POST['estado']);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "data" => $response)));
        } else {
            echo json_encode(array("response" => array("code" => 2, "msj" => $response)));
        }
        break;
    case 8:
        $response = $usuario->validarUsuario($_POST['id']);
        if ($response != 0) {
            echo json_encode(array("response" => array("code" => 1, "data" => $response)));
        } else {
            echo json_encode(array("response" => array("code" => 2, "data" => $response)));
        }

    case 9:
        # confirmar con contrasenia los resultados de laboratorio
        $activo = 1;
        $bloqueado = 0;
        $user = $_SESSION['user'];
        $parametros = [$user,$activo,$bloqueado]; 
        $result = $master->getByProcedure("sp_usuarios_login_b",$parametros); 
        $password = $_GET['password'];

        if(count($result)>0){
            if(password_verify($password,$result[0]['CONTRASENIA'])){
                echo json_encode(array("status"=>1));
            } else {
                echo json_encode(array("status"=>0));
            }
        } else {
            echo json_encode(array("status"=>'No se encuentra el usuario.'));
        }
        

        
        break;

    default:
        # code...
        break;
}
