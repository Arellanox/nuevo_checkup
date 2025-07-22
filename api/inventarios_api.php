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

$id_almacen = isset($_POST['id_almacen']) && $_POST['id_almacen'] !== '' && $_POST['id_almacen'] !== 'null' ? intval($_POST['id_almacen']) : 1;

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

$id_motivo = $_POST['id_motivo'] ?? $_POST['motivo_salida'] ?? null;
$costo_unitario = $_POST['costo_unitario'] ?? null;
$fecha_entrada = $_POST['fecha_entrada'] ?? null;
$observaciones = $_POST['observaciones'] ?? null;
$numero_documento = $_POST['numero_documento'] ?? null;

$maneja_caducidad = $_POST['maneja_caducidad'];
$fecha_caducidad = $_POST['fecha_caducidad'];
$costo_mas_alto = $_POST['costo_mas_alto'];
$costo_ultima_entrada = $_POST['costo_ultima_entrada'];
$fecha_ultima_entrada = $_POST['fecha_ultima_entrada'];
$tipo_articulo = $_POST['tipo_articulo'];
$area_id = $_POST["area_id"];
$rendimiento_estimado = $_POST['rendimiento_estimado'];
$rendimiento_paciente = $_POST['rendimiento_paciente'];

$id_cat_entradas = $_POST['id_cat_entradas'];
$cantidad = $_POST['cantidad'];
$id_movimiento = $_POST['id_movimiento'];
$motivo_salida = $_POST['motivo_salida'];
$numero_lote = $_POST['numero_lote'];
$fecha_lote = $_POST['fecha_lote'];
$codigo_barras = $_POST['codigo_barras'];
$id_cat_movimientos = $_POST['id_cat_movimientos'];
$id_marcas = isset($_POST['id_marcas']) && $_POST['id_marcas'] !== '' && $_POST['id_marcas'] !== 'null' ? $_POST['id_marcas'] : null;
$id_tipo = isset($_POST['id_tipo']) && $_POST['id_tipo'] !== '' && $_POST['id_tipo'] !== 'null' ? $_POST['id_tipo'] : null;
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
$activo = isset($_POST['activo']) ? $_POST['activo'] : 1;
$tipo_movimiento = isset($_POST['tipo_movimiento']) ? $_POST['tipo_movimiento'] : 'salida';

$id_proveedores = isset($_POST['id_proveedores']) && $_POST['id_proveedores'] !== '' && $_POST['id_proveedores'] !== 'null' ? $_POST['id_proveedores'] : null;
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$contacto = isset($_POST['contacto']) ? $_POST['contacto'] : '';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

$orden_compra = isset($_POST['orden_compra']) ? $_POST['orden_compra'] : null;

$id_surtimiento = isset($_POST['id_surtimiento']) ? $_POST['id_surtimiento'] : null;

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

        // Campo de sustancia activa agregado
        $id_sustancia = isset($_POST['id_sustancia']) && $_POST['id_sustancia'] !== '' && $_POST['id_sustancia'] !== 'null' ? $_POST['id_sustancia'] : null;

        // NUEVO: Procesar múltiples proveedores desde el frontend
        $proveedores_json = isset($_POST['proveedores_json']) ? $_POST['proveedores_json'] : null;

        // Si no hay JSON, crear uno con el proveedor individual para compatibilidad
        if (empty($proveedores_json) && !empty($id_proveedores)) {
            $proveedores_json = json_encode([
                ["id" => $id_proveedores, "principal" => "1"]
            ]);
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
            $proveedores_json, // CAMBIADO: JSON en lugar de ID individual
            $id_marcas,
            $codigo_barras,
            $id_sustancia
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
        # recuperar las entradas
        $id_entrada = isset($_POST['id_entrada']) && $_POST['id_entrada'] !== '' ? intval($_POST['id_entrada']) : null;
        $id_articulo = isset($_POST['id_articulo']) && $_POST['id_articulo'] !== '' ? intval($_POST['id_articulo']) : null;
        $id_proveedor = isset($_POST['id_proveedor']) && $_POST['id_proveedor'] !== '' ? intval($_POST['id_proveedor']) : null;
        $fecha_inicio = isset($_POST['fecha_inicio']) && $_POST['fecha_inicio'] !== '' ? $_POST['fecha_inicio'] : null;
        $fecha_fin = isset($_POST['fecha_fin']) && $_POST['fecha_fin'] !== '' ? $_POST['fecha_fin'] : null;
        $activo = isset($_POST['activo']) && $_POST['activo'] !== '' ? intval($_POST['activo']) : 1;

        $response = $master->getByProcedure("sp_inventarios_entradas_b", [
            $id_entrada,
            $id_articulo,
            $id_almacen,
            $id_proveedor,
            $fecha_inicio,
            $fecha_fin,
            $activo
        ]);
        break;
    case 5:
        # eliminar un articulo
        $response = $master->deleteByProcedure("sp_inventarios_cat_articulos_e", [$id_articulo, $_SESSION['id']]);
        break;
    case 6:

        // subir la imagen del catalogo
        # nombre de articulo., la imagen no tiene id unico
        $nombreImagen = uniqid("img_$no_art");
        $nombreOrdenCompra = uniqid("orden_compra_$no_art");

        $dir = '../reportes/catalogo_movimientos/';
        # crear la carpeta
        $r = $master->createDir($dir);

        if (!$r) {
            $response = "Imposible crear directorio de la imagen.";
            break;
        }

        // Inicializar variable documento_factura
        $documento_factura = null;
        $imagen_orden_compra = null;

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
                $documento_factura = str_replace('../', $host, $img[0]['url']);
                $documento_factura = $master->setToNull([$documento_factura])[0];
            } else {
                $response = "Error al procesar el archivo. Intente nuevamente.";
                break;
            }
        } else {
            $response = "No se recibió archivo de factura o está vacío";
        }

        // if (isset($_FILES["img_orden_compra"]) && !empty($_FILES['img_orden_compra']['name']) && !empty($_FILES['img_orden_compra']['name'][0])) {

        //     // Verificar errores de subida de archivos
        //     $uploadError = $_FILES['img_orden_compra']['error'][0];
        //     $tmpName = $_FILES['img_orden_compra']['tmp_name'][0];
        //     $fileSize = $_FILES['img_orden_compra']['size'][0];

        //     if ($uploadError !== UPLOAD_ERR_OK) {
        //         $errorMessages = [
        //             UPLOAD_ERR_INI_SIZE => 'El archivo excede upload_max_filesize en php.ini',
        //             UPLOAD_ERR_FORM_SIZE => 'El archivo excede MAX_FILE_SIZE del formulario HTML',
        //             UPLOAD_ERR_PARTIAL => 'El archivo se subió parcialmente',
        //             UPLOAD_ERR_NO_FILE => 'No se subió ningún archivo',
        //             UPLOAD_ERR_NO_TMP_DIR => 'Falta la carpeta temporal',
        //             UPLOAD_ERR_CANT_WRITE => 'Error al escribir el archivo al disco',
        //             UPLOAD_ERR_EXTENSION => 'Subida de archivo detenida por extensión'
        //         ];

        //         $errorMsg = isset($errorMessages[$uploadError]) ? $errorMessages[$uploadError] : 'Error desconocido';
        //         $response = "Error al subir archivo: $errorMsg. Verifique el tamaño del archivo.";
        //         break;
        //     }

        //     if (empty($tmpName) || $fileSize == 0) {
        //         $response = "Error: El archivo no se subió correctamente. Verifique el tamaño del archivo.";
        //         break;
        //     }

        //     $img = $master->guardarFiles($_FILES, 'img_orden_compra', $dir, $nombreOrdenCompra);

        //     if (!empty($img) && is_array($img) && isset($img[0]['url'])) {
        //         $imagen_orden_compra = str_replace('../', $host, $img[0]['url']);
        //         $imagen_orden_compra = $master->setToNull([$imagen_orden_compra])[0];
        //     } else {
        //         $response = "Error al procesar el archivo. Intente nuevamente.";
        //         break;
        //     }
        // } else {
        //     $response = "No se recibió archivo de orden de compra o está vacío";
        // }

        # ingresar datos faltantates a la tabla de entradas
        $response = $master->insertByProcedure("sp_inventarios_entradas_g", [
            $id_entrada,
            $id_articulo,
            $id_almacen,
            $id_proveedores,
            $id_motivo,
            $cantidad,
            $costo_unitario,
            $costo_total,
            $numero_documento,
            $fecha_entrada,
            $fecha_compra,
            $numero_lote,
            $fecha_caducidad,
            $documento_factura,
            $orden_compra_numero,
            $orden_compra_documento,
            $observaciones,
            $_SESSION['id']
        ]);
        break;
    case 7:
        // Entradas detalles
        $response = $master->getByProcedure("sp_inventarios_entradas_detalle_b", [$id_articulo]);
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
        $id_unidades = isset($_POST['id_unidades']) && $_POST['id_unidades'] !== '' && $_POST['id_unidades'] !== 'null' ? $_POST['id_unidades'] : null;
        $response = $master->insertByProcedure("sp_inventarios_cat_unidades_g", [
            $id_unidades,
            $descripcion,
            $activo
        ]);
        break;
    case 14:
        // Para insertar/actualizar motivos
        $id_motivos = isset($_POST['id_motivos']) && $_POST['id_motivos'] !== '' && $_POST['id_motivos'] !== 'null' ? $_POST['id_motivos'] : null;
        $response = $master->insertByProcedure("sp_inventarios_cat_motivos_g", [
            $id_motivos,
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
        // Obtener áreas activas para inventarios
        $response = $master->getByProcedure("sp_inventarios_cat_areas_b", []);
        break;
    case 19:
        // Validar duplicados de artículos
        $nombre_comercial = isset($_POST['nombre_comercial']) ? $_POST['nombre_comercial'] : '';
        $unidad_venta = isset($_POST['unidad_venta']) ? $_POST['unidad_venta'] : '';
        $id_marcas = isset($_POST['id_marcas']) ? $_POST['id_marcas'] : null;
        $contenido = isset($_POST['contenido']) ? $_POST['contenido'] : '';
        $id_articulo_actual = isset($_POST['id_articulo_actual']) ? $_POST['id_articulo_actual'] : null;

        if (empty($nombre_comercial) || empty($unidad_venta) || empty($id_marcas)) {
            $response = array(
                'code' => 0,
                'message' => 'Faltan datos para validar duplicados',
                'data' => array()
            );
        } else {
            // Crear un stored procedure temporal o usar getByProcedure con uno existente
            // Por ahora, usar una validación simple basada en los datos existentes
            $result = $master->getByProcedure('sp_inventarios_cat_articulos_b', [1, null, null, null, null]);

            $duplicado_encontrado = false;
            $articulo_duplicado = null;

            if ($result && isset($result['response']) && isset($result['response']['data'])) {
                foreach ($result['response']['data'] as $articulo) {
                    // Verificar duplicados manualmente incluyendo contenido
                    if (
                        strtoupper(trim($articulo['NOMBRE_COMERCIAL'])) == strtoupper(trim($nombre_comercial)) &&
                        $articulo['UNIDAD_VENTA'] == $unidad_venta &&
                        $articulo['ID_MARCAS'] == $id_marcas &&
                        strtoupper(trim($articulo['CONTENIDO'] ?? '')) == strtoupper(trim($contenido)) &&
                        ($id_articulo_actual ? $articulo['ID_ARTICULO'] != $id_articulo_actual : true)
                    ) {

                        $duplicado_encontrado = true;
                        $articulo_duplicado = array(
                            'ID_ARTICULO' => $articulo['ID_ARTICULO'],
                            'CLAVE_ART' => $articulo['CLAVE_ART'],
                            'NOMBRE_COMERCIAL' => $articulo['NOMBRE_COMERCIAL'],
                            'UNIDAD_DESCRIPCION' => $articulo['UNIDAD_VENTA'],
                            'MARCA_DESCRIPCION' => $articulo['MARCAS'],
                            'CONTENIDO' => $articulo['CONTENIDO']
                        );
                        break;
                    }
                }
            }

            if ($duplicado_encontrado) {
                $response = array(
                    'code' => 2, // Código especial para duplicados encontrados
                    'message' => 'Ya existe un artículo con las mismas características',
                    'data' => $articulo_duplicado
                );
            } else {
                $response = array(
                    'code' => 1,
                    'message' => 'No se encontraron duplicados',
                    'data' => array()
                );
            }
        }
        break;
    case 20:
        $response = $master->getByProcedure("sp_inventarios_cat_proveedores_inactivos_b", []);
        break;
    case 21:
        $response = $master->getByProcedure("sp_inventarios_cat_marcas_inactivos_b", []);
        break;
    case 22:
        $response = $master->getByProcedure("sp_inventarios_cat_unidades_inactivos_b", []);
        break;
    case 23:
        $response = $master->getByProcedure("sp_inventarios_tipo_articulos_inactivos_b", []);
        break;
    case 24:
        $response = $master->getByProcedure("sp_inventarios_cat_motivos_inactivos_b", []);
        break;
    case 30:
        // Obtener sustancias activas para el select del formulario
        $response = $master->getByProcedure("sp_inventarios_cat_sustancias_activas", [
            null, // id_sustancia
            null, // nombre
            null, // tipo
            null, // descripcion
            1, // estatus (solo activas)
            $_SESSION['id'], // usuario_id
            'GET' // accion
        ]);
        break;
    case 25:
        //buscar requisiciones
        $response = $master->getByProcedure("sp_inventarios_cat_requisiciones_b ", []);
        break;
    case 26:
        //insertar/actualizar requisiciones
        $id_requisicion = isset($_POST['id_requisicion']) && $_POST['id_requisicion'] !== '' && $_POST['id_requisicion'] !== 'null' ? $_POST['id_requisicion'] : null;
        $area_solicitante_id = isset($_POST['area_solicitante_id']) ? intval($_POST['area_solicitante_id']) : null;
        $fecha_limite = isset($_POST['fecha_limite']) ? $_POST['fecha_limite'] : null;
        $prioridad = isset($_POST['prioridad']) ? $_POST['prioridad'] : null;
        $justificacion = isset($_POST['justificacion']) ? $_POST['justificacion'] : null;
        $estatus = isset($_POST['estatus']) ? $_POST['estatus'] : 'borrador';

        // Validar parámetros obligatorios
        if ($area_solicitante_id <= 0 || empty($fecha_limite) || empty($prioridad) || empty($justificacion)) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: Faltan parámetros obligatorios (área, fecha límite, prioridad o justificación)',
                'data' => array()
            );
            break;
        }

        // Validar sesión de usuario
        if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: No se ha identificado el usuario en la sesión',
                'data' => array()
            );
            break;
        }

        // Log de debugging
        error_log("API 26 - Parámetros recibidos: " . json_encode([
            'id_requisicion' => $id_requisicion,
            'area_solicitante_id' => $area_solicitante_id,
            'usuario_solicitante_id' => $_SESSION['id'],
            'fecha_limite' => $fecha_limite,
            'prioridad' => $prioridad,
            'justificacion' => $justificacion,
            'estatus' => $estatus
        ]));

        try {
            error_log("API 26 - Llamando SP con parámetros: " . json_encode([
                $id_requisicion,
                $area_solicitante_id,
                $_SESSION['id'],
                $fecha_limite,
                $prioridad,
                $justificacion,
                $estatus
            ]));

            $response = $master->insertByProcedure("sp_inventarios_cat_requisiciones_g", [
                $id_requisicion,
                $area_solicitante_id,
                $_SESSION['id'], // usuario_solicitante_id
                $fecha_limite,
                $prioridad,
                $justificacion,
                $estatus
            ]);

            error_log("API 26 - Respuesta del SP: " . json_encode($response));
            error_log("API 26 - Tipo de respuesta: " . gettype($response));
            if (is_array($response) && isset($response['response'])) {
                error_log("API 26 - Datos internos: " . json_encode($response['response']['data']));
            }
        } catch (Exception $e) {
            error_log("API 26 - Error en SP: " . $e->getMessage());
            $response = array(
                'code' => 0,
                'message' => 'ERROR: ' . $e->getMessage(),
                'data' => array()
            );
        }
        break;

    case 27:
        //gestionar detalles de requisiciones
        $requisicion_id = isset($_POST['requisicion_id']) ? $_POST['requisicion_id'] : null;
        $articulo_id = isset($_POST['articulo_id']) ? $_POST['articulo_id'] : null;
        $cantidad_solicitada = isset($_POST['cantidad_solicitada']) ? $_POST['cantidad_solicitada'] : null;
        $precio_estimado = isset($_POST['precio_estimado']) && $_POST['precio_estimado'] !== '' && $_POST['precio_estimado'] !== 'null' ? $_POST['precio_estimado'] : null;
        $operacion = isset($_POST['operacion']) ? $_POST['operacion'] : null;
        $id_detalle = isset($_POST['id_detalle']) && $_POST['id_detalle'] !== '' && $_POST['id_detalle'] !== 'null' ? $_POST['id_detalle'] : null;
        $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : null;

        // Log de debugging
        error_log("API 27 - Parámetros recibidos: " . json_encode([
            'requisicion_id' => $requisicion_id,
            'articulo_id' => $articulo_id,
            'cantidad_solicitada' => $cantidad_solicitada,
            'precio_estimado' => $precio_estimado,
            'operacion' => $operacion,
            'id_detalle' => $id_detalle,
            'operacion_type' => gettype($operacion)
        ]));

        $response = $master->insertByProcedure("sp_inventarios_cat_requisiciones_detalles_g", [
            $requisicion_id,
            $articulo_id,
            $cantidad_solicitada,
            $precio_estimado,
            $operacion,
            $id_detalle,
            $observaciones
        ]);

        // Log de la respuesta
        error_log("API 27 - Respuesta del SP: " . json_encode($response));
        break;
    case 28:
        //recuperar detalles de requisiciones
        $requisicion_id = isset($_POST['requisicion_id']) ? $_POST['requisicion_id'] : null;

        // Validar parámetro obligatorio
        if ($requisicion_id === null || $requisicion_id === '') {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: ID de requisición es obligatorio',
                'data' => array()
            );
            break;
        }

        // Log de debugging
        error_log("API 28 - Recuperando detalles para requisición ID: " . $requisicion_id);

        try {
            $response = $master->getByProcedure("sp_inventarios_cat_requisiciones_detalles_select", [
                $requisicion_id
            ]);

            error_log("API 28 - Respuesta del SP: " . json_encode($response));
        } catch (Exception $e) {
            error_log("API 28 - Error en SP: " . $e->getMessage());
            $response = array(
                'code' => 0,
                'message' => 'ERROR: ' . $e->getMessage(),
                'data' => array()
            );
        }
        break;
    case 29:
        //actualizar requisiciones existentes
        $id_requisicion = isset($_POST['id_requisicion']) && $_POST['id_requisicion'] !== '' && $_POST['id_requisicion'] !== 'null' ? $_POST['id_requisicion'] : null;
        $area_solicitante_id = isset($_POST['area_solicitante_id']) ? intval($_POST['area_solicitante_id']) : null;
        $fecha_limite = isset($_POST['fecha_limite']) ? $_POST['fecha_limite'] : null;
        $prioridad = isset($_POST['prioridad']) ? $_POST['prioridad'] : null;
        $justificacion = isset($_POST['justificacion']) ? $_POST['justificacion'] : null;
        $estatus = isset($_POST['estatus']) ? $_POST['estatus'] : 'borrador';

        // Validar parámetros obligatorios
        if ($id_requisicion === null || $area_solicitante_id <= 0 || empty($fecha_limite) || empty($prioridad) || empty($justificacion)) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: Faltan parámetros obligatorios (ID requisición, área, fecha límite, prioridad o justificación)',
                'data' => array()
            );
            break;
        }

        // Validar sesión de usuario
        if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: No se ha identificado el usuario en la sesión',
                'data' => array()
            );
            break;
        }

        // Log de debugging
        error_log("API 29 - Parámetros recibidos: " . json_encode([
            'id_requisicion' => $id_requisicion,
            'area_solicitante_id' => $area_solicitante_id,
            'usuario_solicitante_id' => $_SESSION['id'],
            'fecha_limite' => $fecha_limite,
            'prioridad' => $prioridad,
            'justificacion' => $justificacion,
            'estatus' => $estatus
        ]));

        try {
            $response = $master->insertByProcedure("sp_inventarios_cat_requisiciones_g", [
                $id_requisicion, // Para UPDATE, pasar el ID existente
                $area_solicitante_id,
                $_SESSION['id'], // usuario_solicitante_id
                $fecha_limite,
                $prioridad,
                $justificacion,
                $estatus
            ]);

            error_log("API 29 - Respuesta del SP: " . json_encode($response));
        } catch (Exception $e) {
            error_log("API 29 - Error en SP: " . $e->getMessage());
            $response = array(
                'code' => 0,
                'message' => 'ERROR: ' . $e->getMessage(),
                'data' => array()
            );
        }
        break;
    case 30:
        //eliminar detalles de requisiciones
        $id_detalle = isset($_POST['id_detalle']) ? $_POST['id_detalle'] : null;
        $requisicion_id = isset($_POST['requisicion_id']) ? $_POST['requisicion_id'] : null;

        // Validar parámetros obligatorios
        if ($id_detalle === null || $requisicion_id === null) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: Faltan parámetros obligatorios (ID detalle y ID requisición)',
                'data' => array()
            );
            break;
        }

        // Validar sesión de usuario
        if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: No se ha identificado el usuario en la sesión',
                'data' => array()
            );
            break;
        }

        // Log de debugging
        error_log("API 30 - Parámetros recibidos: " . json_encode([
            'id_detalle' => $id_detalle,
            'requisicion_id' => $requisicion_id,
            'usuario_id' => $_SESSION['id']
        ]));

        try {
            $response = $master->insertByProcedure("sp_inventarios_cat_requisiciones_detalles_delete", [
                $id_detalle,
                $requisicion_id,
                $_SESSION['id']
            ]);

            error_log("API 30 - Respuesta del SP: " . json_encode($response));
        } catch (Exception $e) {
            error_log("API 30 - Error en SP: " . $e->getMessage());
            $response = array(
                'code' => 0,
                'message' => 'ERROR: ' . $e->getMessage(),
                'data' => array()
            );
        }
        break;
    case 31:
        //aprobar o rechazar requisiciones
        $id_requisicion = isset($_POST['id_requisicion']) ? $_POST['id_requisicion'] : null;
        $accion = isset($_POST['accion']) ? $_POST['accion'] : null; // 'aprobar' o 'rechazar'
        $observaciones_aprobacion = isset($_POST['observaciones_aprobacion']) ? $_POST['observaciones_aprobacion'] : null;

        // Validar parámetros obligatorios
        if ($id_requisicion === null || $accion === null) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: Faltan parámetros obligatorios (ID requisición y acción)',
                'data' => array()
            );
            break;
        }

        // Validar que la acción sea válida
        if (!in_array(strtolower($accion), ['aprobar', 'rechazar'])) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: Acción no válida. Use "aprobar" o "rechazar"',
                'data' => array()
            );
            break;
        }

        // Validar sesión de usuario
        if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: No se ha identificado el usuario en la sesión',
                'data' => array()
            );
            break;
        }

        // Log de debugging
        error_log("API 31 - Parámetros recibidos: " . json_encode([
            'id_requisicion' => $id_requisicion,
            'accion' => $accion,
            'usuario_aprobador_id' => $_SESSION['id'],
            'observaciones_aprobacion' => $observaciones_aprobacion
        ]));

        try {
            $response = $master->insertByProcedure("sp_inventarios_cat_requisiciones_aprobar", [
                $id_requisicion,
                $accion,
                $_SESSION['id'], // usuario_aprobador_id
                $observaciones_aprobacion
            ]);

            error_log("API 31 - Respuesta del SP: " . json_encode($response));
        } catch (Exception $e) {
            error_log("API 31 - Error en SP: " . $e->getMessage());
            $response = array(
                'code' => 0,
                'message' => 'ERROR: ' . $e->getMessage(),
                'data' => array()
            );
        }
        break;
    case 32:
        // Procesar surtimiento de requisición
        $requisicion_id = isset($_POST['requisicion_id']) ? intval($_POST['requisicion_id']) : null;
        $fecha_surtimiento = isset($_POST['fecha_surtimiento']) ? $_POST['fecha_surtimiento'] : null;
        $persona_recibe = isset($_POST['persona_recibe']) ? trim($_POST['persona_recibe']) : null;
        $observaciones = isset($_POST['observaciones']) ? trim($_POST['observaciones']) : null;
        $articulos_json = isset($_POST['articulos']) ? $_POST['articulos'] : null;
        $total_evidencias = isset($_POST['total_evidencias']) ? intval($_POST['total_evidencias']) : 0;

        // Validar parámetros obligatorios
        if ($requisicion_id === null || empty($fecha_surtimiento) || empty($persona_recibe) || empty($articulos_json)) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: Faltan parámetros obligatorios (requisición, fecha, persona que recibe, artículos)',
                'data' => array()
            );
            break;
        }

        // Validar sesión de usuario
        if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: No se ha identificado el usuario en la sesión',
                'data' => array()
            );
            break;
        }

        // Decodificar JSON de artículos
        $articulos = json_decode($articulos_json, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($articulos) || empty($articulos)) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: Formato de artículos no válido',
                'data' => array()
            );
            break;
        }

        // Log de debugging
        error_log("API 32 - Procesando surtimiento: " . json_encode([
            'requisicion_id' => $requisicion_id,
            'usuario_surtidor_id' => $_SESSION['id'],
            'fecha_surtimiento' => $fecha_surtimiento,
            'persona_recibe' => $persona_recibe,
            'observaciones' => $observaciones,
            'total_articulos' => count($articulos),
            'total_evidencias' => $total_evidencias
        ]));

        // Debug archivos recibidos
        if ($total_evidencias > 0) {
            error_log("API 32 - Archivos recibidos: " . print_r($_FILES, true));
        }

        try {
            // Obtener conexión manual para transacciones
            $conexion = $master->connectDb();
            $conexion->beginTransaction();

            // 1. Crear registro principal de surtimiento
            $sql_surtimiento = "INSERT INTO inventarios_cat_surtimientos 
                (requisicion_id, usuario_surtidor_id, fecha_surtimiento, persona_recibe, observaciones, estatus) 
                VALUES (?, ?, ?, ?, ?, 'parcial')";

            $stmt = $conexion->prepare($sql_surtimiento);
            $stmt->execute([
                $requisicion_id,
                $_SESSION['id'],
                $fecha_surtimiento,
                $persona_recibe,
                $observaciones
            ]);

            $surtimiento_id = $conexion->lastInsertId();

            // 2. Procesar cada artículo
            $total_articulos = 0;

            foreach ($articulos as $articulo) {
                $detalle_requisicion_id = $articulo['detalle_requisicion_id'];
                $articulo_id = $articulo['articulo_id'];
                $cantidad_entregada = floatval($articulo['cantidad_entregada']);

                if ($cantidad_entregada <= 0) continue;

                // Insertar detalle de surtimiento
                $sql_detalle = "INSERT INTO inventarios_cat_surtimientos_detalle 
                    (surtimiento_id, detalle_requisicion_id, articulo_id, cantidad_entregada) 
                    VALUES (?, ?, ?, ?)";

                $stmt_detalle = $conexion->prepare($sql_detalle);
                $stmt_detalle->execute([
                    $surtimiento_id,
                    $detalle_requisicion_id,
                    $articulo_id,
                    $cantidad_entregada
                ]);

                // Actualizar cantidad surtida en la requisición
                $sql_update = "UPDATE inventarios_cat_requisiciones_detalles 
                              SET cantidad_surtida = COALESCE(cantidad_surtida, 0) + ?,
                                  fecha_ultimo_surtimiento = NOW()
                              WHERE id_detalle = ?";

                $stmt_update = $conexion->prepare($sql_update);
                $stmt_update->execute([$cantidad_entregada, $detalle_requisicion_id]);

                $total_articulos++;
            }

            // 3. Determinar el nuevo estatus de la requisición
            $sql_check = "SELECT 
                            COUNT(*) as total,
                            SUM(CASE WHEN COALESCE(cantidad_surtida, 0) >= cantidad_aprobada THEN 1 ELSE 0 END) as completos
                          FROM inventarios_cat_requisiciones_detalles 
                          WHERE requisicion_id = ?";

            $stmt_check = $conexion->prepare($sql_check);
            $stmt_check->execute([$requisicion_id]);
            $check_result = $stmt_check->fetch(PDO::FETCH_ASSOC);

            $nuevo_estatus = 'aprobada';
            $estatus_surtimiento = 'parcial';

            if ($check_result['completos'] == $check_result['total']) {
                $nuevo_estatus = 'completada';
                $estatus_surtimiento = 'completo';
            } elseif ($check_result['completos'] > 0) {
                $nuevo_estatus = 'parcialmente_surtida';
            }

            // 4. Actualizar estatus de requisición y surtimiento
            $sql_update_req = "UPDATE inventarios_cat_requisiciones SET estatus = ? WHERE id_requisicion = ?";
            $stmt_update_req = $conexion->prepare($sql_update_req);
            $stmt_update_req->execute([$nuevo_estatus, $requisicion_id]);

            $sql_update_surt = "UPDATE inventarios_cat_surtimientos SET estatus = ? WHERE id_surtimiento = ?";
            $stmt_update_surt = $conexion->prepare($sql_update_surt);
            $stmt_update_surt->execute([$estatus_surtimiento, $surtimiento_id]);

            // 5. Procesar evidencia fotográfica si existe (usando patrón de API 6)
            $evidencias_guardadas = 0;
            if ($total_evidencias > 0) {
                $dir = '../reportes/surtimientos_evidencia/';

                // Crear directorio usando el método del master
                $r = $master->createDir($dir);
                if (!$r) {
                    error_log("API 32 - No se pudo crear directorio: " . $dir);
                } else {
                    // La función guardarFiles espera un array, así que usamos el campo con []
                    if (isset($_FILES['evidencia_fotografica']) && !empty($_FILES['evidencia_fotografica']['name'][0])) {

                        // Usar el patrón del sistema para nombres únicos
                        $nombreImagen = uniqid("surtimiento_" . $surtimiento_id . "_evidencia_");

                        // Guardar archivo usando el método del master como API 6
                        $img = $master->guardarFiles($_FILES, 'evidencia_fotografica', $dir, $nombreImagen);

                        if (!empty($img) && is_array($img) && isset($img[0]['url'])) {
                            // Procesar cada archivo guardado
                            foreach ($img as $index => $archivo) {
                                // Convertir URL usando el host como en API 6
                                $imagen = str_replace('../', $host, $archivo['url']);
                                $imagen = $master->setToNull([$imagen])[0];

                                // Insertar registro de evidencia
                                $sql_evidencia = "INSERT INTO inventarios_cat_surtimientos_evidencia 
                                    (surtimiento_id, nombre_archivo, ruta_archivo, tipo_archivo, tamaño_archivo, descripcion) 
                                    VALUES (?, ?, ?, ?, ?, ?)";

                                $stmt_evidencia = $conexion->prepare($sql_evidencia);
                                $stmt_evidencia->execute([
                                    $surtimiento_id,
                                    basename($archivo['url']),
                                    $imagen,
                                    $archivo['tipo'],
                                    0, // Tamaño no disponible en el array resultado
                                    'Evidencia de surtimiento #' . ($index + 1)
                                ]);

                                $evidencias_guardadas++;
                                error_log("API 32 - Evidencia guardada exitosamente: " . $imagen);
                            }
                        } else {
                            error_log("API 32 - Error al procesar archivos de evidencia");
                        }
                    }
                }
            }

            // Confirmar transacción
            $conexion->commit();
            $conexion = null; // Cerrar conexión

            $response = array(
                'code' => 1,
                'message' => 'Surtimiento procesado exitosamente',
                'data' => array(
                    'surtimiento_id' => $surtimiento_id,
                    'nuevo_estatus' => $nuevo_estatus,
                    'articulos_procesados' => $total_articulos,
                    'evidencias_guardadas' => $evidencias_guardadas
                )
            );

            error_log("API 32 - Surtimiento exitoso: ID " . $surtimiento_id);
        } catch (Exception $e) {
            // Rollback en caso de error
            if (isset($conexion)) {
                $conexion->rollback();
                $conexion = null;
            }
            error_log("API 32 - Error: " . $e->getMessage());
            $response = array(
                'code' => 0,
                'message' => 'ERROR: ' . $e->getMessage(),
                'data' => array()
            );
        }
        break;
    case 33:
        // Obtener evidencias de surtimientos de una requisición
        $requisicion_id = isset($_POST['requisicion_id']) ? intval($_POST['requisicion_id']) : null;

        if ($requisicion_id === null) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: Falta el ID de requisición',
                'data' => array()
            );
            break;
        }

        try {
            $sql = "SELECT e.*, s.fecha_surtimiento, s.persona_recibe 
                   FROM inventarios_cat_surtimientos_evidencia e
                   INNER JOIN inventarios_cat_surtimientos s ON e.surtimiento_id = s.id_surtimiento
                   WHERE s.requisicion_id = ?
                   ORDER BY s.fecha_surtimiento DESC, e.fecha_subida ASC";

            $conexion = $master->connectDb();
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$requisicion_id]);
            $evidencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conexion = null;

            $response = array(
                'code' => 1,
                'message' => 'Evidencias obtenidas exitosamente',
                'data' => $evidencias
            );
        } catch (Exception $e) {
            error_log("API 33 - Error: " . $e->getMessage());
            $response = array(
                'code' => 0,
                'message' => 'ERROR: ' . $e->getMessage(),
                'data' => array()
            );
        }
        break;
    case 35:
        // Obtener eventos de surtimiento para el historial
        $requisicion_id = isset($_POST['requisicion_id']) ? intval($_POST['requisicion_id']) : null;

        if ($requisicion_id === null) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: Falta el ID de requisición',
                'data' => array()
            );
            break;
        }

        try {
            $sql = "SELECT s.fecha_surtimiento, s.estatus, s.persona_recibe, s.observaciones,
                          u_surtidor.nombre as usuario_surtidor,
                          COUNT(e.id_evidencia) as total_evidencias,
                          SUM(sd.cantidad_entregada) as total_entregado
                   FROM inventarios_cat_surtimientos s
                   LEFT JOIN sistema_usuarios u_surtidor ON s.usuario_surtidor_id = u_surtidor.id
                   LEFT JOIN inventarios_cat_surtimientos_evidencia e ON s.id_surtimiento = e.surtimiento_id
                   LEFT JOIN inventarios_cat_surtimientos_detalle sd ON s.id_surtimiento = sd.surtimiento_id
                   WHERE s.requisicion_id = ?
                   GROUP BY s.id_surtimiento
                   ORDER BY s.fecha_surtimiento ASC";

            $conexion = $master->connectDb();
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$requisicion_id]);
            $surtimientos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conexion = null;

            $response = array(
                'code' => 1,
                'message' => 'Eventos de surtimiento obtenidos exitosamente',
                'data' => $surtimientos
            );
        } catch (Exception $e) {
            error_log("API 35 - Error: " . $e->getMessage());
            $response = array(
                'code' => 0,
                'message' => 'ERROR: ' . $e->getMessage(),
                'data' => array()
            );
        }
        break;
    case 36:
        // Obtener detalles de surtimiento por requisición
        $requisicion_id = isset($_POST['requisicion_id']) ? intval($_POST['requisicion_id']) : null;

        if ($requisicion_id === null) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: Falta el ID de requisición',
                'data' => array()
            );
            break;
        }

        try {
            $conexion = $master->connectDb();
            $result = $conexion->prepare("CALL sp_inventarios_obtener_detalles_surtimiento(?)");
            $result->execute([$requisicion_id]);

            // Procesar múltiples result sets
            $data = [];
            do {
                $rows = $result->fetchAll(PDO::FETCH_ASSOC);
                if ($rows) {
                    $data[] = $rows;
                }
            } while ($result->nextRowset());

            $conexion = null;

            $response = array(
                'code' => 1,
                'message' => 'Detalles de surtimiento obtenidos exitosamente',
                'data' => $data
            );
        } catch (Exception $e) {
            error_log("API 36 - Error: " . $e->getMessage());
            $response = array(
                'code' => 0,
                'message' => 'ERROR: ' . $e->getMessage(),
                'data' => array()
            );
        }
        break;
    case 37:
        // Obtener sustancias activas usando el stored procedure simple
        $estatus = isset($_POST['estatus']) ? $_POST['estatus'] : 1; // Por defecto solo activas

        $response = $master->getByProcedure("sp_inventarios_cat_sustancias_activas_select", [
            $estatus
        ]);
        break;
    case 38:
        // CRUD de sustancias activas (crear, actualizar, eliminar)
        $id_sustancia = isset($_POST['id_sustancia']) && $_POST['id_sustancia'] !== '' && $_POST['id_sustancia'] !== 'null' ? $_POST['id_sustancia'] : null;
        $nombre_sustancia = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
        $tipo_sustancia = isset($_POST['tipo']) ? $_POST['tipo'] : '';
        $descripcion_sustancia = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
        $estatus_sustancia = isset($_POST['estatus']) ? $_POST['estatus'] : 1;
        $accion = isset($_POST['accion']) ? $_POST['accion'] : '';

        // Validar parámetros según la acción
        if (empty($accion)) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: Falta especificar la acción',
                'data' => array()
            );
            break;
        }

        if (in_array($accion, ['CREATE', 'UPDATE']) && empty($nombre_sustancia)) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: El nombre de la sustancia es obligatorio',
                'data' => array()
            );
            break;
        }

        if (in_array($accion, ['UPDATE', 'DELETE']) && empty($id_sustancia)) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: El ID de la sustancia es obligatorio para esta acción',
                'data' => array()
            );
            break;
        }

        // Validar sesión de usuario
        if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: No se ha identificado el usuario en la sesión',
                'data' => array()
            );
            break;
        }

        try {
            $response = $master->insertByProcedure("sp_inventarios_cat_sustancias_activas", [
                $id_sustancia,
                $nombre_sustancia,
                $tipo_sustancia,
                $descripcion_sustancia,
                $estatus_sustancia,
                $_SESSION['id'],
                $accion
            ]);
        } catch (Exception $e) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: ' . $e->getMessage(),
                'data' => array()
            );
        }
        break;
    case 33:
        // Obtener evidencias de surtimientos por requisición ID
        $requisicion_id = isset($_POST['requisicion_id']) ? intval($_POST['requisicion_id']) : null;

        if ($requisicion_id === null) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: Falta el ID de requisición',
                'data' => array()
            );
            break;
        }

        // Log de debugging
        error_log("API 33 - Buscando evidencias para requisición ID: " . $requisicion_id);

        try {
            $conexion = $master->connectDb();

            // Primero verificar si la requisición existe
            $check_req_sql = "SELECT COUNT(*) as total FROM inventarios_cat_requisiciones WHERE id_requisicion = ?";
            $check_req_stmt = $conexion->prepare($check_req_sql);
            $check_req_stmt->execute([$requisicion_id]);
            $requisicion_exists = $check_req_stmt->fetch(PDO::FETCH_ASSOC);
            error_log("API 33 - Requisición existe: " . json_encode($requisicion_exists));

            // Verificar si hay surtimientos para esta requisición
            $check_surt_sql = "SELECT id_surtimiento, fecha_surtimiento, persona_recibe FROM inventarios_cat_surtimientos WHERE requisicion_id = ?";
            $check_surt_stmt = $conexion->prepare($check_surt_sql);
            $check_surt_stmt->execute([$requisicion_id]);
            $surtimientos = $check_surt_stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log("API 33 - Surtimientos encontrados: " . json_encode($surtimientos));

            // Verificar si hay evidencias en total
            $check_ev_sql = "SELECT COUNT(*) as total FROM inventarios_cat_surtimientos_evidencia";
            $check_ev_stmt = $conexion->prepare($check_ev_sql);
            $check_ev_stmt->execute();
            $total_evidencias = $check_ev_stmt->fetch(PDO::FETCH_ASSOC);
            error_log("API 33 - Total evidencias en sistema: " . json_encode($total_evidencias));

            $sql = "SELECT 
                        e.id_evidencia,
                        e.surtimiento_id,
                        e.nombre_archivo,
                        e.ruta_archivo,
                        e.tipo_archivo,
                        e.tamaño_archivo,
                        e.descripcion,
                        e.fecha_subida,
                        s.fecha_surtimiento,
                        s.persona_recibe,
                        s.estatus as estatus_surtimiento
                    FROM inventarios_cat_surtimientos_evidencia e
                    INNER JOIN inventarios_cat_surtimientos s ON e.surtimiento_id = s.id_surtimiento
                    WHERE s.requisicion_id = ?
                    ORDER BY s.fecha_surtimiento DESC, e.fecha_subida ASC";

            $stmt = $conexion->prepare($sql);
            $stmt->execute([$requisicion_id]);
            $evidencias = $stmt->fetchAll(PDO::FETCH_ASSOC);

            error_log("API 33 - Evidencias encontradas para requisición: " . count($evidencias));
            error_log("API 33 - Datos de evidencias: " . json_encode($evidencias));

            $conexion = null;

            $response = array(
                'code' => 1,
                'message' => 'Evidencias obtenidas exitosamente',
                'data' => $evidencias
            );
        } catch (Exception $e) {
            error_log("API 33 - Error: " . $e->getMessage());
            $response = array(
                'code' => 0,
                'message' => 'ERROR: ' . $e->getMessage(),
                'data' => array()
            );
        }
        break;
    case 39:
        //obtener los datos de surtimiento
        $response = $master->getByProcedure("sp_inventarios_obtener_detalle_surtimiento", [
            $id_surtimiento
        ]);
        break;
    case 40:
        // Obtener artículos surtidos por requisición (consulta directa)
        $requisicion_id = isset($_POST['requisicion_id']) ? intval($_POST['requisicion_id']) : null;

        if ($requisicion_id === null) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: Falta el ID de requisición',
                'data' => array()
            );
            break;
        }

        try {
            $sql = "SELECT 
                        rd.id_detalle,
                        rd.requisicion_id,
                        rd.articulo_id,
                        rd.cantidad_solicitada,
                        rd.cantidad_aprobada,
                        COALESCE(rd.cantidad_surtida, 0) as cantidad_surtida,
                        a.nombre_comercial as nombre_articulo,
                        a.clave_art as clave_articulo,
                        u.descripcion as unidad_medida,
                        CASE 
                            WHEN COALESCE(rd.cantidad_surtida, 0) >= rd.cantidad_aprobada THEN 'completo'
                            WHEN COALESCE(rd.cantidad_surtida, 0) > 0 THEN 'parcial'
                            ELSE 'pendiente'
                        END as estado_surtimiento
                    FROM inventarios_cat_requisiciones_detalles rd
                    INNER JOIN inventarios_cat_articulos a ON rd.articulo_id = a.id_articulo
                    LEFT JOIN inventarios_cat_unidades u ON a.unidad_venta = u.id_unidades
                    WHERE rd.requisicion_id = ?
                    ORDER BY a.nombre_comercial";

            $conexion = $master->connectDb();
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$requisicion_id]);
            $articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conexion = null;

            $response = array(
                'code' => 1,
                'message' => 'Artículos de requisición obtenidos exitosamente',
                'data' => $articulos
            );
        } catch (Exception $e) {
            error_log("API 40 - Error: " . $e->getMessage());
            $response = array(
                'code' => 0,
                'message' => 'ERROR: ' . $e->getMessage(),
                'data' => array()
            );
        }
        break;
    case 41:
        // Obtener evidencias de un surtimiento específico
        $surtimiento_id = isset($_POST['surtimiento_id']) ? intval($_POST['surtimiento_id']) : null;

        if ($surtimiento_id === null) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: Falta el ID de surtimiento',
                'data' => array()
            );
            break;
        }

        try {
            $sql = "SELECT 
                        e.id_evidencia,
                        e.surtimiento_id,
                        e.nombre_archivo,
                        e.ruta_archivo,
                        e.tipo_archivo,
                        e.tamaño_archivo,
                        e.descripcion,
                        e.fecha_subida
                    FROM inventarios_cat_surtimientos_evidencia e
                    WHERE e.surtimiento_id = ?
                    ORDER BY e.fecha_subida ASC";

            $conexion = $master->connectDb();
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$surtimiento_id]);
            $evidencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conexion = null;

            $response = array(
                'code' => 1,
                'message' => 'Evidencias del surtimiento obtenidas exitosamente',
                'data' => $evidencias
            );
        } catch (Exception $e) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: ' . $e->getMessage(),
                'data' => array()
            );
        }
        break;
    case 42:
        // Obtener proveedores de un artículo específico (para edición)
        $id_articulo = isset($_POST['id_articulo']) ? intval($_POST['id_articulo']) : null;

        if ($id_articulo === null) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: Falta el ID del artículo',
                'data' => array()
            );
            break;
        }

        try {
            $response = $master->getByProcedure("sp_inventarios_articulo_proveedores_b", [
                $id_articulo
            ]);
        } catch (Exception $e) {
            error_log("API 42 - Error: " . $e->getMessage());
            $response = array(
                'code' => 0,
                'message' => 'ERROR: ' . $e->getMessage(),
                'data' => array()
            );
        }
        break;
    case 43:
        // obtener detalles de artículos de una orden de compra específica
        $id_orden_compra = isset($_POST['id_orden_compra']) && $_POST['id_orden_compra'] !== '' && $_POST['id_orden_compra'] !== 'null' ? $_POST['id_orden_compra'] : null;

        if (!$id_orden_compra) {
            $response = array(
                'response' => array(
                    'code' => 0,
                    'message' => 'ERROR: ID de orden de compra es obligatorio',
                    'data' => array()
                )
            );
            break;
        }

        try {
            $response = $master->getByProcedure("sp_inventarios_cat_orden_compra_detalle_b", [
                $id_orden_compra
            ]);

            error_log("API 43 - Detalles de orden: " . json_encode($response));
        } catch (Exception $e) {
            error_log("API 43 - Error en SP: " . $e->getMessage());
            $response = array(
                'response' => array(
                    'code' => 0,
                    'message' => 'ERROR: ' . $e->getMessage(),
                    'data' => array()
                )
            );
        }
        break;
    case 44:
        #recuperar ordenes de compra
        $response = $master->getByProcedure("sp_inventarios_cat_orden_compra_b", []);
        break;
    default:
        $response = "API no definida.";
}


echo $master->returnApi($response);
