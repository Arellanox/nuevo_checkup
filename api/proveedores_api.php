<?php

include_once "../clases/master_class.php";
require_once "../clases/token_auth.php";


$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    //
}

$master = new Master();
$api = $_POST['api'];
$host = $master->selectHost($_SERVER['SERVER_NAME']);

// Informacion del proveedor (principal)
$id_proveedores = $_POST['id_proveedores'];
$razon_social = $_POST['razon_social'];
$nombre_comercial = $_POST['nombre_comercial'];
$tipo_persona = $_POST['tipo_persona'];
$nombre_representante = $_POST['nombre_representante'];
$objeto_social = $_POST['objeto_social'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$sitio_web = $_POST['sitio_web'];

$paramPrincipal = $master->setToNull(array(
    $id_proveedores,
    $razon_social,
    $nombre_comercial,
    $tipo_persona,
    $nombre_representante,
    $objeto_social,
    $telefono,
    $email,
    $sitio_web
));

// Informacion de la direccion del proveedor
$id_proveedor_direccion = $_POST['id_proveedor_direccion'];
$proveedor_id = $_POST['proveedor_id'];
$tipo_direccion = $_POST['tipo_direccion'];
$calle = $_POST['calle'];
$num_exterior = $_POST['num_exterior'];
$num_interior = $_POST['num_interior'];
$colonia = $_POST['colonia'];
$ciudad = $_POST['ciudad'];
$municipio = $_POST['municipio'];
$comprobante_domicilio = $_POST['comprobante_domicilio'];


$paramDireccion = array(
    $id_proveedor_direccion,
    $proveedor_id,
    $tipo_direccion,
    $calle,
    $num_exterior,
    $num_interior,
    $colonia,
    $ciudad,
    $municipio,
    $comprobante_domicilio,
);

# datos de contactos
$id_contacto = $_POST['id_contacto'];
$nombre_contacto = $_POST['nombre_contacto'];
$tipo_contacto = $_POST['tipo_contacto']; #id del tipo de contacto

# datos para archivos
$id_tipo_archivo = $_POST['id_tipo_archivo'];


# creditos de proveedores
$dias_credito = $_POST['dias_credito'];
$monto_credito = $_POST['monto_credito'];
$tipo_servicio_prestar = $_POST['tipo_servicio_prestar']; # area id

# direcciones
$tipo_direccion = $_POST['tipo_direccion'];


# turnos
$fecha_inicial = $_POST['fecha_inicial'];
$fecha_final - $_POST['fecha_final'];

switch ($api) {
        //insertar informacion del proveedor principal
    case 1:
        $response = $master->insertByProcedure('sp_proveedores_general_g', $paramPrincipal);
        break;

        //Busca todos los proveedores que esten guardados
    case 2:
        $response = $master->getByProcedure('sp_proveedores_general_b', []);
        break;
    case 3:
        # busca los tipos de contactos que existen
        $response = $master->getByProcedure("sp_proveedores_tipos_contactos_b", []);
        break;
    case 4:
        # eliminar un proveedor
        $response = $master->deleteByProcedure("sp_proveedores_e", [$id_proveedores]);
        break;
    case 5:
        # agregar un contacto de proveedor
        $response = $master->insertByProcedure("sp_proveedores_contactos_g", [
            $id_contacto,
            $nombre_contacto,
            $id_proveedores,
            $tipo_contacto,
            $telefono,
            $email
        ]);
        break;
    case 6:
        # eliminar un contacto de proveedor
        $response = $master->deleteByProcedure("sp_proveedores_contactos_e", [$id_contacto]);
        break;
    case 7:
        # buscar contactos
        $response = $master->getByProcedure("sp_proveedores_contactos_b", [$proveedor_id, $tipo_contacto]);
        break;
    case 8:
        # guardar los datos de la direccion del proveedor
        $dir = "../archivos/proveedores/$proveedor_id/comprobante_direccion/";
        $nombre_archivo = "TIPO_DIRECCION_" . $tipo_direccion . "_" . uniqid($_SESSION['id']);

        if ($master->createDir($dir)) {
            $files = $master->guardarFiles($_FILES, "comprobante", $dir, $nombre_archivo);

            $comprobante = str_replace('../', $host, $files[0]['url']);

            # reemplazamos el comprobante con el nuevo.
            $paramDireccion[9] = $comprobante;
            $response = $master->insertByProcedure('sp_proveedores_direccion_g', $paramDireccion);
        } else {
            $response = "No se pudo crear el directorio.";
        }
        break;
    case 9:
        # recuperar los tipos de documentos [csf, convenio, etc]
        $response = $master->getByProcedure("sp_proveedores_tipos_archivos_b", [$id_tipo_archivo]);
        break;
    case 10:
        # subir un archivo de proveedores.
        switch ($id_tipo_archivo) {
            case 1:
                $x = "CSF";
                break;
            case 2:
                $x = "Acta_Constitutiva";
                break;
            case 3:
                $x = "Convenio";
                break;
            case 4:
                $x = "Direccion";
                break;
            case 5:
                $x = "Caratula_de_Cuenta_Bancaria";
                break;
            case 6:
                $x = "Datos_de_Pago";
                break;
            default:
                $x = "UNKNOWN";
        }
        $nombre_archivo = $x . "_" . uniqid($_SESSION['id']);
        $dir = '../archivos/proveedores/' . $id_proveedores . '/';

        if ($master->createDir($dir)) {
            $files = $master->guardarFiles($_FILES, "archivo", $dir, $nombre_archivo);

            # preparar el arreglo para recibir varios archivos
            $x = array();
            foreach ($files as $file) {
                $uri = $file['url'];
                $file['url'] = str_replace('../', $host, $uri);
                $x[] = $file;
            }
            $response = $master->insertByProcedure('sp_proveedor_archivos_g', [
                $id_proveedores,
                json_encode($x),
                $id_tipo_archivo

            ]);
        } else {
            $response = "Error al crear directorio.";
        }


        break;
    case 11:
        # recuperar los archivos de un proveedor
        $response = $master->getByProcedure("sp_proveedores_archivos_b", [
            $id_proveedores,
            $id_tipo_archivo
        ]);

        $response = $master->decodeJsonRecursively($response);
        break;
    case 12:
        # agregar credito al proveedor

        $servicios = explode(',', $tipo_servicio_prestar);
        $response = $master->insertByProcedure("sp_proveedores_creditos_g", [
            $proveedor_id,
            $dias_credito,
            $monto_credito,
            json_encode($servicios)
        ]);
        break;
    case 13:
        # buscar credito del proveedor
        $response = $master->getByProcedure("sp_proveedores_creditos_b", [$proveedor_id]);
        $response = $master->decodeJsonRecursively($response);
        break;
    case 14:
        # buscar las direcciones de un proveedor
        $response = $master->getByProcedure("sp_proveedores_direccion_b", [$proveedor_id, $tipo_direccion]);
        break;
    case 15:
        # recuperar los pacientes que tiene proveedores externos.
        $response = $master->getByProcedure("sp_proveedores_turnos_b", [$proveedor_id, $fecha_inicial, $fecha_final]);
        break;

    default:
        $response = "API no definida";
        break;
}

echo $master->returnApi($response);
