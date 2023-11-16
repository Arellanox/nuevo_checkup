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
$firma = isset($_POST['firma']) ? $_POST['firma'] : null;
$servicio_id = isset($_POST['servicio_id']) ? $_POST['servicio_id'] : null;
$url = isset($_POST['url']) ? $_POST['url'] : null;
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
$servicios = isset($_POST['servicios']) ? $_POST['servicios'] : null;
$id_consentimiento = isset($_POST['id_consentimiento']) ? $_POST['id_consentimiento'] : null;
$consentimiento = isset($_POST['consentimiento']) ? $_POST['consentimiento'] : null;
$host = $_SERVER['SERVER_NAME'] == "localhost" ? "http://localhost/nuevo_checkup/" : "https://bimo-lab.com/nuevo_checkup/";

#DATOS PARA MANDAR EL QUIMICO, MEDICO, TOMADOR DE MUETRA, ETC.
$data_consentimiento_g = $_POST['data_consentimiento'];

#RECIBIMOS LAS URL FINALES YA CON LA FIRMA Y LA INFORMACION DEL PACIENTE INCRUSTADA EN EL PDF
$url_final = $_POST['url_final'];


$data_firma_g = array(
    $turno_id,
    $firma,
    json_encode($consentimiento)
);


$data_consentimiento_e = array(
    $id_consentimiento,
    $servicio_id
);

$data_PDF_QR = array(
    $turno_id,
    $quimico,
    $tomador_muestra,
    $medico
);



switch ($api) {
    case 1:
        #RECUPERA LA INFORMACION DEL PACIENTE Y EL CONSENTIMIENTO
        $response = $master->decodeJsonRecursively($master->getByProcedure("sp_consentimiento_formato_b", [$turno_id]));


        break;

    case 2:
        #GUARDA LA FIRMA DEL COSENTIMIENTO
        $response0 = $master->getByProcedure("sp_consentimiento_firma_g", $data_firma_g);

        #REALIZAMOS EL  RELLANADO DEL DOCUMENTO PARA LA VISTA PREVIA Y PARA GUARDAR LA URL YA RELLENADO
        $response1 = $master->getByProcedure("sp_insertar_datos_consentimiento_b", [$turno_id]);

        foreach ($response1 as $item) {

            $archivo_original = $item['PDF_BLANCO'];


            $ruta_si = str_replace($host, '../', $item['PDF_BLANCO']);

            $pdf = new FPDM($ruta_si);
            $pdf->useCheckboxParser = true;

            if ($item['CONSENTIMIENTO'] == 1) {

                $fields = array(
                    'FECHA_ACTUAL' => $item['FECHA'],
                    'ANIO' => $item['ANIO_ACTUAL'],
                    'NOMBRE_PACIENTE' => $item['NOMBRE_PACIENTE'],
                    'NOMBRE_PACIENTE_RESPONSABLE' => $item['NOMBRE_PACIENTE'],
                    'QUIMICO' => $item['QUIMICO']

                );
            } else {


                $fields = array(
                    'FECHA_ACTUAL' => $item['FECHA'],
                    'ANIO' => $item['ANIO_ACTUAL'],
                    'NOMBRE_PACIENTE' => $item['NOMBRE_PACIENTE'],
                    'QUIMICO' => $item['QUIMICO'],
                    'NOMBRE_PACIENTE_NEGACION' => $item['NOMBRE_PACIENTE'],
                    'FECHA_NEGACION' => $item['FECHA_NEGACION'],
                    'NOMBRE_PACIENTE_REVOCACION' => $item['NOMBRE_PACIENTE'],
                    'FECHA_REVOCACION' => $item['FECHA_NEGACION'],

                );
            }

            $pdf->Load($fields, true);
            $pdf->Merge();


            $ruta = '../reportes/consentimientos/' . $turno_id . '/';
            $r = $master->createDir($ruta);

            $archivo_final =  $ruta . $turno_id . "_" . $item['DESCRIPCION'] . ".pdf";
            $pdf->Output("F", $archivo_final);

            $ruta_tabla = str_replace('../', $host, $archivo_final);

            $response2 = $master->updateByProcedure('sp_actualizar_ruta_consentimientos_g', [$turno_id, $item['SERVICIO_ID'], $ruta_tabla]);
        };

        $response = $master->decodeJsonRecursively($master->getByProcedure("sp_consentimiento_formato_b", [$turno_id]));

        break;
    case 3:
        #RECUPERAR LAS FIRMAS JUNTO CON LAS CONFIGURACIONES DE ESTA
        $response = $master->decodeJsonRecursively($master->getByProcedure("sp_consentimiento_firma_configuracion", [$turno_id]));

        // Nuevo array con la estructura deseada
        $nuevoArray = [
            "response" => [
                "code" => 1,
                "data" => [
                   
                    "JSON_UNIDO" => []
                    

                ]
            ]
        ];

        
        foreach ($response as $index => $jsonOriginal) {
            
            $nuevoArray["response"]["data"]["JSON_UNIDO"][] = $jsonOriginal["JSON_FIRMAS"];
        }

        // Convertir el nuevo array a formato JSON
        $jsonFinal = json_encode($nuevoArray, JSON_PRETTY_PRINT);

        // Imprimir el resultado
        echo $jsonFinal;
        exit;

        break;
    case 4:
        #ELIMINA LOS SERVICIOS DE UIN CONSENTIMIENTO
        $response = $master->getByProcedure("sp_consentimiento_estudios_e", $data_consentimiento_e);
        break;

    case 5:
        #GUARDA EL CONCENTIMIENTOS CON TODO Y SERVICIOS
        $response = $master->getByProcedure(
            "sp_consentimieto_g",
            [json_encode($data_consentimiento_g)]
        );


        #RECUPERARA LOS QR PARA LOS CONSENTIMIENTOS
        $tipo = "Consentimiento";
        $turno_id = base64_encode($turno_id);
        $codeContents = $host . "vista/consentimiento/?turno=$turno_id";
        $nombre = 'TurnoID-' . $turno_id;
        $response = ["qr" => $master->generarQRURL($tipo, $codeContents, $nombre), "url" => $codeContents, "fileName" => $nombre];

        break;
    case 6:
        #RECUPERAR LOS CONSENTIMIENTOS DEL PACIENTE, PARA SU HISTORIAL O PARA VERLOS DESPUES DE FIRMAR
        $response = $master->getByProcedure('sp_consentimiento_b', [$turno_id]);

        break;
    case 7:

        #CREAMOS EL DIRECTORIO EN DONDE VAMOS ALMACENAR LOS PDF
        $destination = "../archivos/sistema/temp/qr/Consentimiento/consentimiento". "-" .$turno_id."/";
        $r = $master->createDir($destination);


        foreach ($url_final as $archivo ){
            #RECUPERAMOS LOS PDF
            $id_consentimiento = $consentimiento['id_consentimiento'];
            $pdf_blob = $consentimiento['pdf'];

            #GUARDAMOS LOS PDF
            $nombre_pdf = "consentimiento". "-". $id_consentimiento. "-". $turno_id. ".pdf";
            file_put_contents($destination . $nombre_pdf, base64_decode($pdf_blob));
            
            #GUARDAMOS EL PDF EN LA BD
            $ruta = str_replace('../', $host, $destination);
            $ruta_final = $ruta . $nombre_pdf;

            $response2 = $master->updateByProcedure('sp_actualizar_ruta_consentimientos_g', [$turno_id, $id_consentimiento, $ruta_final]);
            
        }


        $response = $master->getByProcedure('sp_consentimiento_b', [$turno_id]);
        

        break;
    default:
        $response = "api no reconocida";
}

echo $master->returnApi($response);

 