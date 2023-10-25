<?php
require_once "../lib/fpdf/autoload.php";
require_once "../clases/master_class.php";
// require_once "../clases/token_auth.php";

// $tokenVerification = new TokenVerificacion();
// $tokenValido = $tokenVerification->verificar();
// if (!$tokenValido) {
//     // $tokenVerification->logout();
//     // exit;
// }

$master = new Master();


$api = $_POST['api'];
$turno_id = isset($_POST['turno_id']) ? $_POST['turno_id'] : null;
$firma =isset($_POST['firma']) ? $_POST['firma'] : null;
$servicio_id = isset($_POST['servicio_id']) ? $_POST['servicio_id'] : null;
$url = isset($_POST['url']) ? $_POST['url'] : null;
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
$servicios = isset($_POST['servicios']) ? $_POST['servicios'] : null;
$id_consentimiento = isset($_POST['id_consentimiento']) ? $_POST['id_consentimiento'] : null;
$consentimiento = isset($_POST['consentimiento']) ? $_POST['consentimiento'] : null ;
$host = $_SERVER['SERVER_NAME'] == "localhost" ? "http://localhost/nuevo_checkup/" : "https://bimo-lab.com/nuevo_checkup/";

$data_firma_g = array(
    $turno_id,
    $firma,
    json_encode($consentimiento)
);


// var_dump($data_firma_g);
// exit;

$data_consentimiento_g = array(
    $url,
    $descripcion,
    $servicios,
    $id_consentimiento
);


$data_consentimiento_e = array(
    $id_consentimiento,
    $servicio_id
);





switch ($api) {
    case 1:
        #RECUPERA LA INFORMACION DEL PACIENTE Y EL CONSENTIMIENTO
        $response = $master->decodeJsonRecursively($master->getByProcedure("sp_consentimiento_formato_b", [$turno_id]));

        break;
    case 2:
        #GUARDA LA FIRMA DEL COSENTIMIENTO
        $response = $master->getByProcedure("sp_consentimiento_firma_g", $data_firma_g);

        #REALIZAMOS EL  RELLANADO DEL DOCUMENTO PARA LA VISTA PREVIA Y PARA GUARDAR LA URL YA RELLENADO
        $response1 = $master->getByProcedure("sp_insertar_datos_consentimiento_b", [$turno_id]);

        foreach ($response1 as $item) {

            $archivo_original = $item['PDF_BLANCO'];
            $firma_paciente = $item['FIRMA'];

            $ruta_si = str_replace($host, '../', $item['PDF_BLANCO']);

            $pdf = new FPDM($ruta_si);
            $pdf->useCheckboxParser = true;

            if ($item['CONSENTIMIENTO'] == 1) {

                $fields = array(
                    'FECHA_ACTUAL' => $item['FECHA'],
                    'ANIO' => $item['ANIO_ACTUAL'],
                    'NOMBRE_PACIENTE' => $item['NOMBRE_PACIENTE'],
                    'NOMBRE_PACIENTE_RESPOPNSABLE' => $item['NOMBRE_PACIENTE'],
                    'FIRMA_PACIENTE' => $item['FIRMA'],
                );
            } else {


                $fields = array(
                    'FECHA_ACTUAL' => $item['FECHA'],
                    'ANIO' => $item['ANIO_ACTUAL'],
                    'NOMBRE_PACIENTE' => $item['NOMBRE_PACIENTE'],
                    'NOMBRE_PACIENTE_NEGACION' => $item['NOMBRE_PACIENTE'],
                    'FECHA_NEGACION' => $item['FECHA_NEGACION'],
                    'FIRMA_PACIENTE_NEGACION' => $item['FIRMA'],
                    'NOMBRE_PACIENTE_REVOCACION' => $item['NOMBRE_PACIENTE'],
                    'FECHA_REVOCACION' => $item['FECHA_NEGACION'],
                    'FIRMA_PACIENTE_REVOCACION' => $item['FIRMA']

                );
            }




            $pdf->Load($fields, true);
            $pdf->Merge();


            $ruta = '../reportes/consentimientos/' . $turno_id . '/';
            $r = $master->createDir($ruta);

            $pdf->Output("F", $ruta . $turno_id . "_" . $item['DESCRIPCION'] . ".pdf");
            $ruta_tabla = str_replace('../', $host, $ruta);

            $response2 = $master->updateByProcedure('sp_actualizar_ruta_consentimientos_g', [$turno_id, $item['SERVICIO_ID'], $ruta_tabla ]);
        };
        

        break;
    case 3:
        #GUARDA EL CONCENTIMIENTOS CON TODO Y SERVICIOS
        $response = $master->getByProcedure("sp_consentimieto_g", $data_consentimiento_g);

        break;
    case 4:
        #ELIMINA LOS SERVICIOS DE UIN CONSENTIMIENTO
        $response = $master->getByProcedure("sp_consentimiento_estudios_e", $data_consentimiento_e);

        break;

    default:
        $response = "api no reconocida";
}

echo $master->returnApi($response);
