<?php
include_once "../clases/master_class.php";
include_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

if (empty($_SESSION['id'])) {
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

switch ($estatus) {
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
$fecha_caducidad = $_POST['fecha_caducidad'];
$costo_mas_alto = $_POST['costo_mas_alto'];
$costo_ultima_entrada = $_POST['costo_ultima_entrada'];
$fecha_ultima_entrada = $_POST['fecha_ultima_entrada'];
$tipo_articulo = $_POST['tipo_articulo'];
$area_id = $_POST["area_id"];
$rendimiento_estimado = $_POST['rendimiento_estimado'];
$rendimiento_paciente = $_POST['rendimiento_paciente'];

// no se si se utilizan
$id_cat_entradas = $_POST['id_cat_entradas'];
$cantidad = $_POST['cantidad'];
$id_movimiento = $_POST['id_movimiento'];
$motivo_salida = $_POST['motivo_salida'];
$numero_lote = $_POST['numero_lote'];
$fecha_lote = $_POST['fecha_lote'];
$codigo_barras = $_POST['codigo_barras'];
$id_cat_movimientos = $_POST['id_cat_movimientos'];
$id_marcas = $_POST['id_marcas'];
$id_tipo = isset($_POST['id_tipo']) ? $_POST['id_tipo'] : null;
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
$activo = isset($_POST['activo']) ? $_POST['activo'] : 1;
$tipo_movimiento = isset($_POST['tipo_movimiento']) ? $_POST['tipo_movimiento'] : 'salida';

$id_proveedores = isset($_POST['id_proveedores']) ? $_POST['id_proveedores'] : null;
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$contacto = isset($_POST['contacto']) ? $_POST['contacto'] : '';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

$host = $master->selectHost($_SERVER['SERVER_NAME']);

switch ($api) {
    case 1:
        # agregar nuevo articulo al catalogo

        // subir la imagen del catalogo
        # nombre de articulo.
        //comentar para evitar que se repita el nombre de la imagen
        $nombreImagen = uniqid("img_");
        $nombreInserto = uniqid("inserto_");
        $nombreProcedimiento = uniqid("procedimiento_");

        $dir = '../reportes/catalogo_articulos/';
        # crear la carpeta
        $r = $master->createDir($dir);

        if (!$r) {
            $response = "Imposible crear directorio de la imagen.";
            break;
        }
        // imagen
        # si la carga del archivo es apropiado se sube al servidor
        if (isset($_FILES["img_producto"]) && !empty($_FILES['img_producto']['name'])) {

            $img = $master->guardarFiles($_FILES, 'img_producto', $dir, $nombreImagen);
            $imagen = str_replace('../', $host, $img[0]['url']);
            $imagen = $master->setToNull([$imagen])[0];
        }

        //inserto 
        if (isset($_FILES["inserto"]) && !empty($_FILES['inserto']['name'])) {
            $inserto = $master->guardarFiles($_FILES, 'inserto', $dir, $nombreInserto);
            $insertoUrl = str_replace('../', $host, $inserto[0]['url']);
            $insertoUrl = $master->setToNull([$insertoUrl])[0];
        }

        //procedimiento
        if (isset($_FILES["procedimiento"]) &&  !empty($_FILES['procedimiento']['name'])) {
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
            $fecha_caducidad,
            $costo_mas_alto,
            $costo_ultima_entrada,
            $fecha_ultima_entrada,
            $tipo_articulo,
            $_SESSION['id'],
            $area_id,
            $rendimiento_estimado,
            $insertoUrl,
            $procedimientoUrl,
            $rendimiento_paciente,
            $cantidad,
            $id_proveedores,
            $id_marcas,
            $numero_lote,
            $fecha_lote,
            $codigo_barras
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
            $maneja_caducidad,
            $area_id
        ]);
        break;
    case 4:
        # recuperar los articulos de entrada
        // Por defecto, muestra entradas (1) si no se envía nada
        $id_movimiento = isset($_POST['id_movimiento']) ? $_POST['id_movimiento'] : 1;
        $response = $master->getByProcedure("sp_inventarios_entrada_articulos_b", [$id_movimiento]);
        break;
    case 5:
        # eliminar un articulo
        $response = $master->deleteByProcedure("sp_inventarios_cat_articulos_e", [$id_articulo, $_SESSION['id']]);
        break;
    case 6:

        // subir la imagen del catalogo
        # nombre de articulo., la imagen no tiene id unico
        $nombreImagen = uniqid("img_$no_art");

        $dir = '../reportes/catalogo_movimientos/';
        # crear la carpeta
        $r = $master->createDir($dir);

        if (!$r) {
            $response = "Imposible crear directorio de la imagen.";
            break;
        }

        // Inicializar variable imagen_documento
        $imagen_documento = null;

        // imagen
        # si la carga del archivo es apropiado se sube al servidor
        if (isset($_FILES["img_factura"]) && !empty($_FILES['img_factura']['name']) && !empty($_FILES['img_factura']['name'][0])) {

            // Verificar errores de subida de archivos
            $uploadError = $_FILES['img_factura']['error'][0];
            $tmpName = $_FILES['img_factura']['tmp_name'][0];
            $fileSize = $_FILES['img_factura']['size'][0];

            if ($uploadError !== UPLOAD_ERR_OK) {
                $errorMessages = [
                    UPLOAD_ERR_INI_SIZE => 'El archivo excede upload_max_filesize en php.ini',
                    UPLOAD_ERR_FORM_SIZE => 'El archivo excede MAX_FILE_SIZE del formulario HTML',
                    UPLOAD_ERR_PARTIAL => 'El archivo se subió parcialmente',
                    UPLOAD_ERR_NO_FILE => 'No se subió ningún archivo',
                    UPLOAD_ERR_NO_TMP_DIR => 'Falta la carpeta temporal',
                    UPLOAD_ERR_CANT_WRITE => 'Error al escribir el archivo al disco',
                    UPLOAD_ERR_EXTENSION => 'Subida de archivo detenida por extensión'
                ];
                
                $errorMsg = isset($errorMessages[$uploadError]) ? $errorMessages[$uploadError] : 'Error desconocido';
                $response = "Error al subir archivo: $errorMsg. Verifique el tamaño del archivo.";
                break;
            }

            if (empty($tmpName) || $fileSize == 0) {
                $response = "Error: El archivo no se subió correctamente. Verifique el tamaño del archivo.";
                break;
            }

            $img = $master->guardarFiles($_FILES, 'img_factura', $dir, $nombreImagen);
            
            if (!empty($img) && is_array($img) && isset($img[0]['url'])) {
                $imagen_documento = str_replace('../', $host, $img[0]['url']);
                $imagen_documento = $master->setToNull([$imagen_documento])[0];
            } else {
                $response = "Error al procesar el archivo. Intente nuevamente.";
                break;
            }
        } else {
            $response = "No se recibió archivo de factura o está vacío";
        }

        # ingresar datos faltantates a la tabla de entradas
        $response = $master->insertByProcedure("sp_inventarios_cat_entradas_g", [
            $id_articulo,
            $id_cat_movimientos,
            $imagen_documento,
            //$nombre_comercial,
            $cantidad,
            $fecha_ultima_entrada,
            $costo_ultima_entrada,
            //$costo_mas_alto,
            $id_proveedores,
            $id_movimiento,
            $motivo_salida,
            $_SESSION['id']
        ]);
        break;
    case 7:
        // Recuperar los datos de un solo articulo
        $id_movimiento = isset($_POST['id_movimiento']) ? intval($_POST['id_movimiento']) : 1;
        if ($id_movimiento == 1) {
            // Entradas
            $response = $master->getByProcedure("sp_inventarios_entrada_articulos_detalle", [$id_articulo]);
        } else {
            // Salidas
            $response = $master->getByProcedure("sp_inventarios_salida_articulos_detalle", [$id_articulo]);
        }
        break;
    case 8:
        // Lógica para devolver las transacciones
        $response = $master->getByProcedure("sp_inventarios_cat_transacciones_b", [$id_articulo]);
        break;
    case 9:
        # recuperar marcas activas
        $response = $master->getByProcedure("sp_inventarios_cat_marcas_b", []);
        break;
    case 10:
        $response = $master->insertByProcedure("sp_inventarios_cat_tipos_g", [
            $id_tipo,
            $descripcion,
            $activo
        ]);
        break;
    case 11:
        $response = $master->insertByProcedure("sp_inventarios_cat_marcas_g", [
            $id_marcas,
            $descripcion,
            $activo
        ]);
        break;
    case 12:
        // para mostrar las unidades de medida
        $response = $master->getByProcedure("sp_inventarios_cat_unidades_b", []);
        break;

    case 13:
        // Para insertar/actualizar unidades
        $id_unidades = isset($_POST['id_unidades']) ? $_POST['id_unidades'] : null;
        $response = $master->insertByProcedure("sp_inventarios_cat_unidades_g", [
            $id_unidades,
            $descripcion,
            $activo
        ]);
        break;
    case 14:
        // Para insertar/actualizar motivos
        $response = $master->insertByProcedure("sp_inventarios_cat_motivos_g", [
            $id_unidades,
            $descripcion,
            $activo,
            $tipo_movimiento
        ]);
        break;
    case 15:
        // Para mostrar motivos filtrados por tipo
        $tipo_movimiento = isset($_POST['tipo_movimiento']) ? $_POST['tipo_movimiento'] : null;

        if ($tipo_movimiento) {
            // Si se especifica tipo, filtrar en la consulta
            $response = $master->getByProcedure("sp_inventarios_cat_motivos_filtrado", [$tipo_movimiento]);
        } else {
            // Si no se especifica tipo, devolver todos
            $response = $master->getByProcedure("sp_inventarios_cat_motivos_b", []);
        }
        break;
    case 16:
        // Para mostrar los proveedores
        $response = $master->getByProcedure("sp_inventarios_cat_proveedores_b", []);
        break;
    case 17:
        // Para insertar/actualizar proveedores
        $response = $master->insertByProcedure("sp_inventarios_cat_proveedores_g", [
            $id_proveedores,
            $nombre,
            $contacto,
            $telefono,
            $email,
            $activo
        ]);
        break;
    case 18:
        $response = $master->getByProcedure("sp_areas_b", [null, null]);
        break;
    default:
        $response = "API no definida.";
}


echo $master->returnApi($response);
