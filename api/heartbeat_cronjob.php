<?php
include_once "../clases/master_class.php";
include_once "../clases/correo_class.php";

$master = new Master();
$mail = new Correo();

$limit = 20; // minutos sin señal antes de marcar offline

$response = $master->getByProcedure("sp_heartbeats_b",[]);

//echo "Fecha y hora local: " . date("Y-m-d H:i:s", time()) . "\n";

foreach ($response as $s) {
    $diff = (time() - strtotime($s["last_signal"])) / 60;
    if ($diff > $limit) {
        // Aquí puedes mandar un correo o alerta
        echo "⚠️ Servidor {$s["server_id"]} está offline. Última señal: {$s["last_signal"]} (hace $diff minutos)\n<br>";
        $mail->sendEmail("heartbeat", "Se fue la energía en bimo! (probablemente)", ["josue.delacruz@bimo.com.mx"]);
    }    
}    

