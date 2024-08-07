<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/Pdf.php";
include "../clases/correo_class.php";

$master = new Master();

$api = $_POST['api'];


$host = $master->selectHost($_SERVER['SERVER_NAME']);

# variables
$id_grupo = $_POST['id_grupo'];
$descripcion = $_POST['descripcion']; #Al grupo no se crea nombre, sino descripcion
$cliente_id = $_POST['cliente_id'];
$usuario_id = $_SESSION['id'];
$facturado = $_POST['facturado']; # bit que marca si el grupo esta siendo facturado o creado;
$factura = $_POST['num_factura']; # numero de la factura que arroja alegra.
$detalle = $_POST['detalle_grupo']; # es un arreglo que incluye solo el id del turno. Ejemplo [45,46,46,48]
$fecha_creacion = $_POST['fecha_creacion']; # fecha de creacion del grupo

# recuperar pacientes
$fecha_inicial = $_POST['fecha_inicial'];
$fecha_final = $_POST['fecha_final'];

switch ($api) {
    case 1:
        # Agregar un grupo y su detalle.
        # Agregar el numer de factura y mas detalle al grupo.
        if ($facturado == 1) {
            # agregar datos de factura.
            $response = $master->insertByProcedure("sp_admon_grupos_g", [$id_grupo, $descripcion, $cliente_id, $usuario_id, $facturado, $usuario_id, $factura, json_encode($detalle)]);
        } else {
            # agregar datos de creacion de grupo.
            $response = $master->insertByProcedure("sp_admon_grupos_g", [$id_grupo, $descripcion, $cliente_id, $usuario_id, $facturado, null, null, json_encode($detalle)]);
        }

        break;
    case 2:
        # buscar grupos
        $response = $master->getByProcedure("sp_admon_grupos_b", [$cliente_id, $fecha_creacion]);
        break;
    case 3:
        # recuperar el detalle del grupo.
        $response = $master->getByProcedure("sp_admon_detalle_grupo", [$id_grupo]);
        break;
    case 4:
        # lista de pacientes a credito que no estan en grupos
        $response = $master->getByProcedure("sp_admn_pacientes_credito", [$cliente_id, $fecha_inicial, $fecha_final]);
        break;
    case 5:
        # lista de pacientes de contado que no han sido facturados aun.
        $response = $master->getByProcedure("sp_admon_pacientes_contado", [$fecha_inicial, $fecha_final]);
        break;
    case 6:
        # costo total del grupo
        $response = $master->getByProcedure("sp_admon_detalle_grupo_monetario", [$id_grupo]);
        break;
    case 7:
        # costo total de grupo por areas.
        $response = $master->getByProcedure("", []);
        break;
    case 8:
        # subir el archivo de la factura

        # recuperar el numero de la factura.
        $fac = $master->getByProcedure("sp_admon_recuperar_num_factura", [$id_grupo]);

        $doc = "FACTURA_". $fac[0]["FACTURA"]."_".uniqid($_SESSION['id']);

        # establecer la ruta de guardado
        $dir = "../archivos/facturas_emitidas/".$fac[0]['FACTURA'];

        # crear directorio si no existe
        $r = $master->createDir($dir);

        if($r){
            $file = $master->guardarFiles($_FILES, 'factura', $dir, $doc);
            $file = $file[0]['url'];

            # cambiar el prefijo
            $file = str_replace("../",$host, $file);

            $response = $master->updateByProcedure("sp_admon_subir_factura", [ $file ]);
        } else {
            $response = "Imposible crear directorio. Llame al departamente de TI inmediatamente.";
        }
        
        break;
    default:
        $response = "API no definida";
}

echo $master->returnApi($response);
