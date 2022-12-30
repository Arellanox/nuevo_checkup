<?php
session_start();
include_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/Pdf.php";


$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}


$master = new Master();
$api = $_POST['api'];

#variables
$id_oftalmo = $_POST['id_oftalmo'];
$turno_id = $_POST['turno_id'];
$antecedentes_personales = $_POST['antecedentes_personales'];
$antecedentes_oftalmologicos = $_POST['antecedentes_oftalmologicos'];
$pacedimiento_actual = $_POST['padecimiento_actual'];
$agudeza_visual = $_POST['agudeza_visual'];
$od = $_POST['od'];
$oi = $_POST['oi'];
$jaeger = $_POST['jaeger'];
$refraccion = $_POST['refraccion'];
$prueba = $_POST['prueba'];
$exploracion_oftalmologica = $_POST['exploracion_oftalmologica'];
$forias = $_POST['forias'];
$campimetria = $_POST['campimetria'];
$presion_intraocular_od = $_POST['presion_intraocular_od'];
$presion_intraocular_oi = $_POST['presion_intraocular_oi'];
$diagnostico = $_POST['diagnostico'];
$plan = $_POST['plan'];

#creacion de array.
$params = array(
    $id_oftalmo,
    $turno_id,
    $antecedentes_personales,
    $antecedentes_oftalmologicos,
    $pacedimiento_actual,
    $agudeza_visual,
    $od,
    $oi,
    $jaeger,
    $refraccion,
    $prueba,
    $exploracion_oftalmologica,
    $forias,
    $campimetria,
    $presion_intraocular_od,
    $presion_intraocular_oi,
    $diagnostico,
    $plan,
    $_SESSION['id'],# id del usuario que esta subiendo la informacion,
    null # esta es la ruta del reporte, que posteriormente se tiene que actualizar
);

switch ($api) {
    case 1:
        #insertar
        # en el procedure se insertar el folio consecutivo de los resultados activos.
        $last_id = $master->insertByProcedure('sp_oftalmo_resultados_g',$params);

        # recuperamos el encabezado del paciente.
        $responsePac = $master->getByProcedure("sp_informacion_paciente",[$turno_id]);
         # pie de pagina
        $fecha_resultado = $responsePac[0]['FECHA_RESULTADO_OFTALMO'];
        $nombre_paciente = $responsePac[0]['NOMBRE'];
        $nombre = str_replace(" ","_",$nombre_paciente);

        $ruta_saved = "reportes/modulo/oftalmo/$fecha_resultado/".$id_turno."/";
        # Crear el directorio si no existe
        $r = $master->createDir("../".$ruta_saved);

        if($r!=1){
            $response = "No se puedo crear el directorio.";
            break;
        }
        $archivo = array("ruta"=>$ruta_saved,"nombre_archivo"=>$nombre."-".$responsePac[0]['TURNO'].'-'.$fecha_resultado);

        $clave = $master->getByProcedure("sp_generar_clave",[]);
        $pie_pagina = array("clave"=>$clave[0]['TOKEN'],"folio"=>$responsePac[0]['FOLIO_OFTALMO'],"modulo"=>3);

        # con el arreglo superior, creamos el pdf para conseguir la ruta antes de insertar en la tabla de mysql
        $pdf = new Reporte(json_encode($params), json_encode($responsePac[0]), $pie_pagina, $archivo, 'resultados', 'url');

        #actualizamos la url del reporte.
        $response = $master->updateByProcedure("sp_oftalmo_resultados_g",[$last_id,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,$pdf->build()]);

        break;
    case 2:
        # buscar
        # si ambas variables se le envian en null, recupera todo la informacion de la tabla, de todos los turnos.
        $response = $master->getByProcedure('sp_oftalmo_resultados_b',[$id_oftalmo,$turno_id]);
        break;
    default:
        # code...
        break;
}
echo $master->returnApi($response);
/*
    #primero recuperamos la informacion del paciente en responsePac
    $responsePac = $master->getByProcedure("sp_informacion_paciente",[$turno_id]);

        
    # pie de pagina
    $fecha_resultado = $responsePac[0]['FECHA_FOLDER_OF'];
    $nombre_paciente = $responsePac[0]['NOMBRE'];
    $nombre = str_replace(" ","_",$nombre_paciente);

    $ruta_saved = "reportes/modulo/oftalmo/$fecha_resultado/$id_turno/";

    # Crear el directorio si no existe
    $r = $master->createDir("../".$ruta_saved);

    if($r!=1){
        $response = "No se puedo crear el directorio.";
        break;
    }
    $archivo = array("ruta"=>$ruta_saved,"nombre_archivo"=>$nombre."-".$responsePac[0]['TURNO'].'-'.$fecha_resultado);

    $clave = $master->getByProcedure("sp_generar_clave",[]);

    $pie_pagina = array("clave"=>$clave[0]['TOKEN'],"folio"=>$responsePac[0]['FOLIO'],"modulo"=>3);

    # con el arreglo superior, creamos el pdf para conseguir la ruta antes de insertar en la tabla de mysql
    $pdf = new Reporte(json_encode($params), json_encode($responsePac[0]), $pie_pagina, $archivo, 'resultados', 'url');
    */
?>
