<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include "../clases/correo_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) { //Preregistro necesita recuperar antecedentes
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();
$api = $_POST['api'];
$turno_id = $_POST['turno_id'];
$usuario_id = $_SESSION['id'];
$d_certificado = $_POST['id_certificado'];
$host = $_SERVER['SERVER_NAME'] == "localhost" ? "http://localhost/nuevo_checkup/" : "https://bimo-lab.com/nuevo_checkup/";

switch ($api) {
    case 1:
        # Guardar el pdf del certificado poe del paciente
        $dir = '../reportes/modulo/certificados_poe/';
        $r = $master->createDir($dir);
        // print_r($_FILES);
        $certificado = $master->guardarFiles($_FILES, 'certificado-POE', $dir, "CERTIFICADO_POE_$turno_id");
        // var_dump($certificado);
        // exit;
        $ruta_certificado = str_replace("../", $host, $certificado[0]['url']);
        $response = $master->insertByProcedure("sp_certificados_poe_g", [$d_certificado, $ruta_certificado, $turno_id, $usuario_id]);

        // var_dump($response);
        // exit;
        break;

    case 2:
        //Buscar el certificado poe en la base de datos
        $response = $master->getByProcedure("sp_certificados_poe_b", [$turno_id]);
        break;
}


echo $master->returnApi($response);
