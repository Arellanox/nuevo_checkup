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

#variables promociones
$id_promocion = $_POST['id_promocion'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$usuario_id = $_SESSION['id'];
$pausado = $_POST['pausado'];

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

            $nuevaRutaJson = json_encode($nuevaRutaArchivos);

            # insertamos el registro
            $master -> insertByProcedure("sp_promociones_g", [
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

    default:
        $response = "Api no definida.";
        break;
}

echo $master->returnApi($response);

?>