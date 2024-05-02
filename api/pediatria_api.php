<?php

require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

//Api
$api = $_POST['api'];

$master = new Master();

$antecedentes = $_POST['antecedentes'];
$turno_id = isset($_POST['turno_id']) ? $_POST['turno_id'] : $_POST['id_turno'];
# confirmar historia
$motivo_consulta = $_POST["motivo_consulta"];
$conclusiones = $_POST['conclusiones']; # es el campo de notas_padecimiento
$historia_subsecuente = $_POST['historia_subsecuente'];
$diagnostico = $_POST['diagnostico'];
$consulta_terminada = $_POST['confirmado'];
$registrado_por = $_SESSION['id'];

switch ($api) {
    case 1:
        # insertar/actualizar antecedentes
        $antecedentes = $master->getFormValues($antecedentes);
        $response = $master->insertByProcedure('sp_historia_pediatrica_g', [
            $turno_id,
            json_encode($antecedentes),
            # guardar datos generales de la historia pediatrica.
            $motivo_consulta,
            $conclusiones,
            $historia_subsecuente,
            $consulta_terminada,
            $registrado_por,
            $diagnostico
        ]);
        break;
    case 2:
        # buscar los antecedentes
        $response = $master->getByNext("sp_historia_pediatrica_b", [$turno_id]);

        $newResponse = [];
        foreach ($response[0][0] as $clave => $valor) {
            $newResponse[$clave] = $valor;
        }

        $items = [];
        for ($i = 1; $i < count($response); $i++) {
            $items[] = $response[$i];
        }

        $newResponse["ANTECEDENTES"] = $items;
        $response = [$newResponse];

        break;
    case 3:
        # confirmar historia pediatrica.
        $response = $master->insertByProcedure('sp_historia_pediatrica_terminar', [
            $turno_id
        ]);

        if ($consulta_terminada == 1) {
            # crear y actualizar ruta del reporte.
            $pdf = $master->reportador($master, $turno_id, 21, 'historia_pediatrica');

            # actuaizamo
        }
        break;
    case 4:
        # recuperar los datos de la consulta
        $response = $master->getByProcedure('sp_historia_pediatrica_consulta_b', [$turno_id]);
        break;
    default:
        $response = "api no reconocida " . $api;
        break;
}

echo $master->returnApi($response);
