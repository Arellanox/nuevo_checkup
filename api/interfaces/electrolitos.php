<?php 
include "../../clases/master_class.php";
$datos = json_decode(file_get_contents('php://input'),true);

$idPaciente = $datos['patientId'];
$na = $datos['Na'];
$k = $datos['K'];
$cl = $datos['Cl'];

$electrolitos = array(
    "idTurno"=>$idPaciente,
    "Na"=>$na,
    "K"=> $k,
    "Cl"=>$cl
);

print_r($electrolitos);

?>