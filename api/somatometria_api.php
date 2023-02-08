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
            $newRecord = array(
                $id_signo,
                $id_turno,
                $id_metrica,
                $medida
            );

            $response = $master->insertByProcedure("sp_mesometria_signos_vitales_g", $newRecord);
        }
        break;
    case 2:
        # buscar
        $response = $master->getByProcedure('sp_mesometria_signos_vitales_b', [$id_turno]);
        if (is_array($response)) {
            foreach ($response as $key => $signo) {
                $array[$response[$key]['TIPO_SIGNO']] = $signo;
            }
            $array['FECHA_REGISTRO'] = $response[count($response) - 1]['FECHA_REGISTRO'];
            $response = $array;
        }
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
