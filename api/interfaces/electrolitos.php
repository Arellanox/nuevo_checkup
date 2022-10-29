<?php 
include "../../clases/master_class.php";
$datos = json_decode(file_get_contents('php://input'),true);

$master = new Master();

$idPaciente = $datos['patientId'];
$na = $datos['Na'];
$k = $datos['K'];
$cl = $datos['Cl'];

$electrolitos = array(
    "Na"=>$na,
    "K"=> $k,
    "Cl"=>$cl
);

$idServicio = $datos['id_servicio'];
$grupo = $datos['grupo'];
$idArea = $datos['id_area'];
$otrasAreas = $datos['otras_areas'];

foreach ($electrolitos as $abreviatura => $resultado) {
    $response = $master->getByProcedure('sp_servicios_b',array($idServicio,$grupo,$idArea,$otrasAreas,$abreviatura));
    $id_servicio = $response[0]['ID_SERVICIO'];
    $response = $master->insertByProcedure('sp_subir_resultados',array($idPaciente,$id_servicio,$resultado));
}

echo $master->returnApi($response);

# print_r($electrolitos);

?>