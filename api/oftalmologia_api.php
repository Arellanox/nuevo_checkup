<?php 
include_once "../clases/master_class.php";

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
    $plan
);

switch ($api) {
    case 1:
        #insertar 
        $response = $master->insertByProcedure('sp_oftalmo_resultados_g',$params);
        break;
    case 2:
        # buscar
        $response = $master->getByProcedure('sp_oftalmo_resultados_b',[$id_oftalmo,$turno_id]);
    
    default:
        # code...
        break;
}
echo $master->returnApi($response);
?>