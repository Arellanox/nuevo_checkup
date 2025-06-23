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
        $nombreOrdenCompra = uniqid("orden_compra_$no_art");

        $dir = '../reportes/catalogo_movimientos/';
        # crear la carpeta
        $r = $master->createDir($dir);

        if (!$r) {
            $response = "Imposible crear directorio de la imagen.";
            break;
        }

        // Inicializar variable imagen_documento
        $imagen_documento = null;
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
                $imagen_documento = str_replace('../', $host, $img[0]['url']);
                $imagen_documento = $master->setToNull([$imagen_documento])[0];
            } else {
                $response = "Error al procesar el archivo. Intente nuevamente.";
                break;
            }
        } else {
            $response = "No se recibió archivo de factura o está vacío";
        }

        if (isset($_FILES["img_orden_compra"]) && !empty($_FILES['img_orden_compra']['name']) && !empty($_FILES['img_orden_compra']['name'][0])) {

            // Verificar errores de subida de archivos
            $uploadError = $_FILES['img_orden_compra']['error'][0];
            $tmpName = $_FILES['img_orden_compra']['tmp_name'][0];
            $fileSize = $_FILES['img_orden_compra']['size'][0];

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

            $img = $master->guardarFiles($_FILES, 'img_orden_compra', $dir, $nombreOrdenCompra);

            if (!empty($img) && is_array($img) && isset($img[0]['url'])) {
                $imagen_orden_compra = str_replace('../', $host, $img[0]['url']);
                $imagen_orden_compra = $master->setToNull([$imagen_orden_compra])[0];
            } else {
                $response = "Error al procesar el archivo. Intente nuevamente.";
                break;
            }
        } else {
            $response = "No se recibió archivo de orden de compra o está vacío";
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
            $orden_compra,
            $imagen_orden_compra,
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
            $id_detalle
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
    default:
        $response = "API no definida.";
}


echo $master->returnApi($response);
