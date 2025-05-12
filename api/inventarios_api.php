<?php
include_once "../clases/master_class.php";
include_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

if(empty($_SESSION['id'])){
    $tokenVerification->logout();
}

$master = new Master();
$api = $_POST['api'];

# catalogo de articulos
$id_articulo = $_POST['id_articulo'];
$no_art = $_POST['no_art'];
$clave_art = $_POST['clave_art'];
$nombre_comercial = $_POST['nombre_comercial'];
// la imagnes es un files
$estatus = $_POST['estatus'];

switch($estatus){
    case "on":
        $estatus = 1;
        break;
}



$red_frio = $_POST['red_frio'];
$unidad_venta = $_POST['unidad_venta'];
$unidad_minima = $_POST['unidad_minima'];
$contenido = $_POST['contenido'];

// las siguientes variables probablemente no se utilicen 
$reactivo = $_POST['reactivo'];
$insumo = $_POST['insumo'];

$maneja_caducidad = $_POST['maneja_caducidad'];
$costo_mas_alto = $_POST['costo_mas_alto'];
$tipo_articulo = $_POST['tipo_articulo'];
$area_id = $_POST["area_id"];
$rendimiento_estimado = $_POST['rendimiento_estimado'];
$rendimiento_paciente = $_POST['rendimiento_paciente'];

$host = $master->selectHost($_SERVER['SERVER_NAME']);

switch($api){
    case 1:
        # agregar nuevo articulo al catalogo

        // subir la imagen del catalogo
        # nombre de articulo.
        $nombreImagen = "img_$no_art";#uniqid("img_");
        $nombreInserto = "inserto_$no_art";#uniqid("inserto_");
        $nombreProcedimiento = "procedimiento_$no_art";# uniqid("procedimiento_");

        $dir = '../reportes/catalogo_articulos/';
        # crear la carpeta
        $r = $master->createDir($dir);

        if(!$r){
            $response = "Imposible crear directorio de la imagen.";
            break;
        }
        // imagen
        # si la carga del archivo es apropiado se sube al servidor
        if(isset($_FILES["img_producto"]) && !empty($_FILES['img_producto']['name'])){

            $img = $master->guardarFiles($_FILES, 'img_producto', $dir, $nombreImagen);
            $imagen = str_replace('../', $host, $img[0]['url']);
            $imagen = $master->setToNull([$imagen])[0];
        }
        
        //inserto 
        if(isset($_FILES["inserto"]) && !empty($_FILES['inserto']['name'])){
            $inserto = $master->guardarFiles($_FILES,'inserto', $dir, $nombreInserto);
            $insertoUrl = str_replace('../', $host, $inserto[0]['url']);
            $insertoUrl = $master->setToNull([$insertoUrl])[0];
        }

        //procedimiento
        if(isset($_FILES["procedimiento"]) &&  !empty($_FILES['procedimiento']['name'])){
            $procedimiento = $master->guardarFiles($_FILES, 'procedimiento', $dir, $nombreProcedimiento);
            $procedimientoUrl = str_replace('../', $host, $procedimiento[0]['url']);
            $procedimientoUrl = $master->setToNull([$procedimientoUrl])[0];
        }


        $response = $master->insertByProcedure("sp_inventarios_cat_articulos_g", [
            $id_articulo,
            $no_art,
            $clave_art,
            $nombre_comercial,
            $imagen,
            $estatus,
            $red_frio,
            $unidad_venta,
            $unidad_minima,
            $contenido,
            $reactivo,
            $insumo,
            $maneja_caducidad,
            $costo_mas_alto,
            $tipo_articulo,
            $_SESSION['id'],
            $area_id,
            $rendimiento_estimado,
            $insertoUrl,
            $procedimientoUrl,
            $rendimiento_paciente
        ]);
        break;
    case 2:
        # recuperar los tipos de articulos del catalogo
        $response = $master->getByProcedure("sp_inventarios_tipo_articulos_b", []);
        break;
    case 3:
        # recuperar los articulos del catalogo
        $response = $master->getByProcedure('sp_inventarios_cat_articulos_b', [
            $estatus,
            $red_frio,
            $tipo_articulo,
            $maneja_caducidad
        ]);
        break;
    case 4:
        # eliminar un articulo
        $response = $master->deleteByProcedure("sp_inventarios_cat_articulos_e",[$id_articulo, $_SESSION['id']]);
        break;
    
    default:
        $response = "API no definida.";
}


echo $master->returnApi($response);