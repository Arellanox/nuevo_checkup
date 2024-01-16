<?php
include_once "../clases/master_class.php";
require_once "../clases/token_auth.php";


$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$api = $_POST['api'];
$master = new Master();

#variables sistema
$host = $master->selectHost($_SERVER['SERVER_NAME']);

#variables promociones, insert
$id_promocion = $_POST['id_promocion'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$usuario_id = $_POST['usuario_id'];
$pausado = $_POST['pausado'];

#variables de busqueda.
$vigente = $_POST['vigente'];

switch($api){
    case 1:
        #insertar o actualizar promociones

        # tratar archivos de las promociones.
        #crear directorio
        $fecha = str_replace("-","", $fecha_inicio);
        $uniqid = uniqid("promo");

        $dir = '../archivos/promociones/'.$fecha;
        $dirExists = $master->createDir($dir);

        if($dirExists){
            # si se logra crear el direcotorio correctamente o ya existe
            # subimos los archivos
            $archivos = $master->guardarFiles($_FILES,'archivos',$dir,$uniqid);
            $nuevaRutaArchivos = array();

            foreach($archivos as $archivo){
                $archivo['url'] = str_replace('../',$host,$archivo['url']);
                array_push($nuevaRutaArchivos, $archivo);
            }

            # si quieren actualizar solo los campos y no los archivos
            # nuleamos la variable para evitar que el sp sobreescriba un json vacio.
            $nuevaRutaJson = empty($nuevaRutaArchivos) ? null : json_encode($nuevaRutaArchivos);

            # insertamos el registro
            $response = $master -> insertByProcedure("sp_promociones_g", [
                $id_promocion,
                $titulo,
                $descripcion,
                $fecha_inicio,
                $fecha_fin,
                $usuario_id,
                $nuevaRutaJson,
                $pausado
            ]);
        } else {
            # si no existe el directorio, enviamos el error correspondiente
            $response = 'Imposible crear directorio para las promociones.';
        }
        break;
    case 2:
        # buscar las promociones
        $resultset = $master->getByProcedure("sp_promociones_b", [
            $id_promocion,
            $fecha_inicio,
            $fecha_fin,
            $pausado,
            $usuario_id,
            $vigente
        ]);

        # preparar los archivos para el intercambio.
        $response = array();
        foreach($resultset as $set){
            $set = $master->decodeJsonRecursively($set);
            array_push($response, $set);
        }
        break;

    case 3:
        # eliminar promociones
        $response = $master->deleteByProcedure('sp_promociones_e', [$id_promocion]);
        break;

    default:
        $response = "Api no definida.";
        break;
}

echo $master->returnApi($response);

