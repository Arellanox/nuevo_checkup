<?php
include "../interfaces/iMetodos.php";
include "../clases/usuarios_permisos_class.php";
include "../clases/usuarios_class.php";
include "../clases/permisos_class.php";

$permission = new PermisosUsuarios();
$api = 5;

switch ($api) {
    case 1:
        $newRecord = array(1,1);
        $response = $permission->insert($newRecord);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"lastId"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 2:
        $response = $permission->getAll();
        
        if(is_array($response)){
            $dataset = array();

            foreach ($response as $value) {
                $usuario = new Usuarios();
                $permiso = new Permisos();
                $usuarioLabel = $usuario->getById($value['USUARIO_ID']);
                $permisoLabel = $permiso->getById($value['PERMISO_ID']);

                $value['USUARIO'] = $usuarioLabel;
                $value[] = $usuarioLabel;
                $value['PERMISO'] = $permisoLabel;
                $value[] = $permisoLabel;

                $dataset[] = $value;
            }
            echo json_encode(array("response"=>array("code"=>1,"data"=>$dataset)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 3:
        $response = $permission->getById(1);

        if(is_array($response)){
            $dataset = array();

            foreach ($response as $value) {
                $usuario = new Usuarios();
                $permiso = new Permisos();
                $usuarioLabel = $usuario->getById($value['USUARIO_ID']);
                $permisoLabel = $permiso->getById($value['PERMISO_ID']);
                
                $value['USUARIO'] = $usuarioLabel;
                $value[] = $usuarioLabel;
                $value['PERMISO'] = $permisoLabel;
                $value[] = $permisoLabel;

                $dataset[] = $value;
            }
            echo json_encode(array("response"=>array("code"=>1,"data"=>$dataset)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 4:
        $response = $permission->update($form);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 5:
        $response = $permission->delete(1);
        
        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {

        }
        break;
    
    default:
        # code...
        break;
}
?>