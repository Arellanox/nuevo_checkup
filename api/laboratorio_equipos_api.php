<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

#api
$api = $_POST['api'];

#buscar
$id = $_POST['id'];

#insertar
$id_equipo = $_POST['id_equipo'];
$cve_inventario = $_POST['cve_inventario'];
$uso = $_POST['uso'];
$numero_serie = $_POST['numero_serie'];
$frecuencia_mantenimiento = $_POST['frecuencia_mantenimiento'];
$numero_pruebas = $_POST['numero_pruebas'];
$calibracion = $_POST['calibracion'];
$numero_pruebas_calibracion = $_POST['numero_pruebas_calibracion'];
$fecha_ingreso_equipo = $_POST['fecha_ingreso_equipo'];
$fecha_inicio_uso = $_POST['fecha_inicio_uso'];
$valor_del_equipo = $_POST['valor_del_equipo'];
$descripcion = $_POST['descripcion'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$foto = $_POST['foto'];
$status = $_POST['status'];

$parametros = array(
    $id_equipo,
    $cve_inventario,
    $uso,
    $numero_serie,
    $frecuencia_mantenimiento,
    $numero_pruebas,
    $calibracion,
    $numero_pruebas_calibracion,
    $fecha_ingreso_equipo,
    $fecha_inicio_uso,
    $valor_del_equipo,
    $descripcion,
    $marca,
    $modelo,
    $foto,
    $status
);

$response = "";

$master = new Master();
switch ($api) {
    case 1:
        # insertar
        $dir = $master->urlEquiposLaboratorio."$descripcion/";
        $r = $master->createDir($dir);

        if (!empty($_FILES['reportes']['name'])) {
            $next = 0;
            foreach ($_FILES['reportes']['name'] as $key => $value) {
                $extension = pathinfo($_FILES['reportes']['name'][$key], PATHINFO_EXTENSION);
                
                # obtenemos la ruta temporal del archivo
                ## $tmp_name = $_FILES['reportes']['tmp_name'][$key];
                $tmp_name = $_FILES['reportes']['tmp_name'][$key];

                $tipo_label = "INTERPRETACION";
              
                if($tipo == 2){
                    $tipo_label = "CAPTURA";
                }

                $url = "$destinatio_sql$dir_base$id_turno"."_$id_servicio"."_$tipo_label"."_$next.".$extension;

                if($tipo == 2){
                    $imagenes = array('URL'=>$url, 'EXTENSION'=>$extension);
                }

                #insertamos el registro en la tabla de resultados reportes
                $response = $master->insertByProcedure('sp_resultados_reportes_g',[$id_turno,$id_servicio,$url,$comentario,$tipo,json_encode($imagenes),$comentario_capturas]);

                if(is_numeric($response)){
                    #cambiamos de lugar el archivo
                    try {
                        move_uploaded_file($tmp_name,$dir.$id_turno."_$id_servicio"."_$tipo_label"."_$next.".$extension);
                    } catch (\Throwable $th) {
                        # si no se puede subir el archivo, desactivamos el resultado que se guardo en la base de datos
                        $e = $master->deleteByProcedure('sp_resultados_reportes_e',[$response[0]['LAST_ID']]);
                    }
                }
                $next++; 
            }
            echo $master->returnApi($response);
        } else {
            echo "No hay archivos.";
        }
        $response = $master->insertByProcedure("sp_laboratorio_equipos_g", $parametros);
        break;
    case 2:
        # buscar
        $response = $master->getByProcedure("sp_laboratorio_equipos_b", [$id]);
        break;

    case 3:
        # actualizar
        $response = $master->updateByProcedure("sp_laboratorio_equipos_g", $parametros);
        break;
    case 4:
        # desactivar
        $response = $master->deleteByProcedure("sp_laboratorio_equipos_e", [$id]);
        break;
    default:
        $response = "api no reconocida";
        break;
}

echo $master->returnApi($response);
