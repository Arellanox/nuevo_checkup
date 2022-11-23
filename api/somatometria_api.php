<?php
include_once "../clases/master_class.php";

$master = new Master();
$api = $_POST['api'];

$id_turno = $_POST['id_turno']; 
$id_signo = $_POST['id_signo']; #para insertar, este debe quedar null
$tipo = $_POST['tipo_signo'];
$valor = $_POST['resultado']; # resultado de la medida

$medidas = $_POST['medidas'];

switch ($api) {
    case 1:
        # reservado para insertar
        foreach ($medidas as $key => $medida) {
            $id_metrica = $key + 1;
            $response = $master->insertByProcedure("sp_mesometria_signos_vitales_g",[null,$id_turno,$id_metrica,$medida['resultado']]);
        }
       
        break;
    case 2:
        # buscar
        $response = $master->getByProcedure('sp_mesometria_signos_vitales_b',[$id_turno]);
        break;
    case 3:
        # reservado para actualizar
        break;
    case 4:
        # eliminar

    
    default:
        echo "Api no reconocida.";
        break;
}

echo $master->returnApi($response);
?>