<?php
include_once "../clases/master_class.php";
include_once "../clases/correo_class.php";

$limit = 40; // minutos sin señal antes de marcar offline

$response = $master->getByProcedure("sp_heartbeats_b",[]);


foreach ($response as $s) {
    $diff = (time() - strtotime($s["last_signal"])) / 60;
    if ($diff > $limit) {
        // Aquí puedes mandar un correo o alerta
        echo "⚠️ Servidor {$s["server_id"]} está offline (última señal hace $diff min)\n";
    }    
}    

