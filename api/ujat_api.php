<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";


$datos = json_decode(file_get_contents('php://input'), true);

$master = new Master();
$api = $datos['api'];

switch($api){
    case 1:
        # recuperar los reportes confirmados dada una lista de pases.
        $pases = $datos['ids'];
        $reportes = [];

        foreach($pases as $pase){
            $info = $master->getByProcedure("sp_id_turno_x_pase_ujat", [$pase]);
            $id = $info[0]['ID_TURNO'];
            $px = $info[0]['PX'];

            $query = $master->getByProcedure("sp_recuperar_reportes_confirmados", [$id, null, null, null, null]);

            # SUPONIENDO QUE EL PASE SOLO ES PARA UNA COSA, ES DECIR, LABORATORIO, RX O ULTRASONIDO
            # EL QUERY SOLO DEBE DEVOLVER UN SOLO REGISTRO, POR LO QUE ACCEDEMOS A LA POSICION 0
            $reportes[] = [
                'pase' => $pase,
                'px' => $px,
                'url' => $query[0]['RUTA']
            ];
        }

        $response = $reportes;
        
        break;
}

echo json_encode($response);