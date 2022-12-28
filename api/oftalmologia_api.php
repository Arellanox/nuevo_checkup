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
    $_SESSION['id'] # id del usuario que esta subiendo la informacion
);

switch ($api) {
    case 1:
        #insertar
        $responsePac = $master->getByProcedure("sp_informacion_paciente",[$turno_id]);
        $pdf = new Reporte(json_encode($params), json_encode($responsePac[0]), $pie_pagina, $archivo, 'resultados', 'url');

        # inserta en el array de parametros, la ruta del pdf de reporte al final.
        array_push($params, $pdf->build());

        $response = $master->insertByProcedure('sp_oftalmo_resultados_g',$params);
        break;
    case 2:
        # buscar
        # si ambas variables se le envian en null, recupera todo la informacion de la tabla, de todos los turnos.
        $response = $master->getByProcedure('sp_oftalmo_resultados_b',[$id_oftalmo,$turno_id]);
        break;
    case 3: 
        #obtener resultado (url del pdf)
        # buscar
        $response = $master->getByProcedure('sp_oftalmo_resultados_b',[$id_oftalmo,$turno_id]);
        if ($response) {
          $response = array('url' => 'https://bimo-lab.com', 'area_id' => 3);
        }
        break;
    default:
        # code...
        break;
}
echo $master->returnApi($response);
?>
