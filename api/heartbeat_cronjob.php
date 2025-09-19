<?php
include_once "../clases/master_class.php";
include_once "../clases/correo_class.php";

$limit = 40; // minutos sin señal antes de marcar offline


echo time();


$response = $master->getByProcedure("sp_heartbeats_b",[]);


foreach ($response as $s) {
    $dt = new DateTime($s["last_signal"]);
    $dt->modify("-1 hour"); // 👈 Ajuste manual
    $diff = (time() - $dt->getTimestamp()) / 60;
    $diff = (time() - strtotime($s["last_signal"])) / 60;
    if ($diff > $limit) {
        // Aquí puedes mandar un correo o alerta
        echo "⚠️ Servidor {$s["server_id"]} está offline (última señal hace $diff min)\n";
    }    
}    

