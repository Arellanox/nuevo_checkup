<?php
include_once "../clases/master_class.php";
include_once "../clases/correo_class.php";

$master = new Master();

$limit = 100; // minutos sin señal antes de marcar offline

$response = $master->getByProcedure("sp_heartbeats_b",[]);

echo "Fecha y hora local: " . date("Y-m-d H:i:s", time()) . "\n";

foreach ($response as $s) {
    $diff = (time() - strtotime($s["last_signal"])) / 60;
    if ($diff > $limit) {
        // Aquí puedes mandar un correo o alerta
        echo "⚠️ Servidor {$s["server_id"]} está offline (última señal hace $diff min)\n<br>";
    }    
}    

