<?php
session_start();
include "../interfaces/iMetodos.php";
include "../clases/usuarios_class.php";
$usuario = new Usuarios();
$api = $_POST['api'];

switch ($api) {
    case 1:
        $response = $usuario->startSession($_POST['user'], $_POST['pass']);
        if (is_array($response)) {
            $token = generarToken($_SESSION['id']);
            if (! is_null($token)) {
                echo json_encode(array("response" => array("code" => 1, "data" => $response, "token" => $token)));
            } else {
                echo json_encode(array("response" => array("code" => 'login', "msj" => "token no generado")));
            }
        } else {
            echo json_encode(array("response" => array("code" => 'login', "msj" => $response)));
        }
        break;
}



function generarToken($id_usuario)
{
    $tokenArray = array("id_usuario" => $id_usuario, "token" => uniqid());
    $token = hash("sha1", implode("_", $tokenArray), false);

    if (guardarUserToken($token, $id_usuario)) {
        setcookie("token", $token);
        $_SESSION['token'] = $token;
        return $token;
    } else {
        return null;
    }
}

function guardarUserToken($token, $id_usuario)
{
    $master = new Master();
    $parametros = [$token, $id_usuario];
    $response = $master->updateByProcedure("sp_usuarios_token_g", $parametros);

    if (is_numeric($response)) {
        return true;
    } else {
        return false;
    }
}
