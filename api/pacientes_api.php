<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$master = new Master();
$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();

if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

#api
$api = $_POST['api'];

#buscar
$curp = $_POST['curp'];

#insertar
$id_paciente = $_POST['id'];
$segmento_id = $_POST['segmento'];
$nombre = $_POST['nombre'];
$paterno = $_POST['paterno'];
$materno = $_POST['materno'];
$edad = $_POST['edad'];
$nacimiento = $_POST['nacimiento'];
$curp = $_POST['curp'];
$celular = $_POST['celular'];
$celular2 = $_POST['celular_2'];
$correo = $_POST['correo'];
$postal = $_POST['postal'];
$estado = $_POST['estado'];
$municipio = $_POST['municipio'];
$colonia = $_POST['colonia'];
$exterior = $_POST['exterior'];
$interior = $_POST['interior'];
$calle = $_POST['calle'];
$nacionalidad = $_POST['nacionalidad'];
$pasaporte = $_POST['pasaporte'];
$rfc = $_POST['rfc'];
$vacuna = $_POST['vacuna'];
$otravacuna = $_POST['vacunaExtra'];
$dosis = $_POST['inputDosis'];
$genero = $_POST['genero'];
$id_turno = $_POST['turno_id'];
$correo2 = $_POST['correo_2'];
$tipo_conversion = $_POST['comoNosConociste'];

# medios de entrega
$medios_entrega = $_POST['medios_entrega'];
# Esta variable es enviada desde el formulario de fast checkup
# hay que evaluarlo si tiene algo ingresarlo en somatometria. Talla
$talla = $_POST['talla'];
$idFranquicia = $_SESSION['franquiciario'] ? $_SESSION['id_cliente'] : null;
$response = "";

$parametros = [
    $_SESSION['id'],   // 0 _usuario_id
    $id_paciente,      // 1 _id_paciente
    $segmento_id,      // 2 _segmento_id
    $nombre,           // 3 _nombre
    $paterno,          // 4 _paterno
    $materno,          // 5 _materno
    $edad,             // 6 _edad
    $nacimiento,       // 7 _nacimiento
    $curp,             // 8 _curp
    $celular,          // 9 _celular
    $correo,           // 10 _correo
    $postal,           // 11 _postal
    $estado,           // 12 _estado
    $municipio,        // 13 _municipio
    $colonia,          // 14 _colonia
    $exterior,         // 15 _exterior
    $interior,         // 16 _interior
    $calle,            // 17 _calle
    $nacionalidad,     // 18 _nacionalidad
    $pasaporte,        // 19 _pasaporte
    $rfc,              // 20 _rfc
    $vacuna,           // 21 _vacuna
    $otravacuna,       // 22 _otravacuna
    $dosis,            // 23 _dosis
    $genero,           // 24 _genero
    $correo2,          // 25 _correo2
    $medios_entrega,   // 26 _medios (JSON string)
    $tipo_conversion,  // 27 _tipo_conversion
    $talla,            // 28 _talla
    $idFranquicia      // 29 _idFranquicia
];

switch ($api) {
    case 1:
        $medios = array_map('intval', explode(',', $medios_entrega));

        /*$master->setLog(json_encode($parametros), 'Parametros');
        $master->setLog(json_encode($medios_entrega), 'Medios de entrega');*/

        $response = $master->insertByProcedure("sp_pacientes_g", [
            $parametros[0], $parametros[1], $parametros[2], $parametros[3], $parametros[4], $parametros[5],
            $parametros[6], $parametros[7], $parametros[8], $parametros[9], $parametros[10], $parametros[11],
            $parametros[12], $parametros[13], $parametros[14], $parametros[15], $parametros[16], $parametros[17],
            $parametros[18], $parametros[19], $parametros[20], $parametros[21], $parametros[22], $parametros[23],
            $parametros[24], $parametros[25], json_encode($medios), $parametros[27], $talla, $parametros[29], $celular2
        ]);
        break;
    case 2:
        # buscar pacientes
        // echo $id_paciente;
        $response = $master->getByProcedure("sp_pacientes_b", [
            $id_paciente, $curp, $pasaporte, $id_turno, $idFranquicia
        ]);

        foreach ($response as $key => $value) {
            $value['ordenes'] = $master->decodeJson([$value['ordenes']]);
            $response[$key]['ordenes'] = $value['ordenes'];
        }

        $response = $master->decodeJsonRecursively($response);
        // $master->setLog(json_encode($response), "contenido");
        break;
    case 3:
        $medios = array_map('intval', explode(',', $medios_entrega));
        /*$parametros[26] = json_encode($medios); //Se asgina a la posición 26 directamente
        $parametros[28] = $talla; //Se asgina a la posición 28 directamente
        $response = $master->updateByProcedure("sp_pacientes_g", $parametros);*/

//        $master->setLog(json_encode($medios), 'Medios ');
//        $master->setLog(json_encode($medios_entrega), 'Medios de entrega ');

        $response = $master->updateByProcedure("sp_pacientes_g", [
            $parametros[0], $parametros[1], $parametros[2], $parametros[3], $parametros[4], $parametros[5],
            $parametros[6], $parametros[7], $parametros[8], $parametros[9], $parametros[10], $parametros[11],
            $parametros[12], $parametros[13], $parametros[14], $parametros[15], $parametros[16], $parametros[17],
            $parametros[18], $parametros[19], $parametros[20], $parametros[21], $parametros[22], $parametros[23],
            $parametros[24], $parametros[25], json_encode($medios), $parametros[27], $talla, $parametros[29], $celular2
        ]);
        break;
    case 4:
        # desactivr paciente
        $response = $master->deleteByProcedure("sp_pacientes_e", [$id_paciente]);
        break;
    case 5:
        $response = $master->getByProcedure("sp_ordenes_medicas_b", [$turno_id, $area_id]);
        break;
    default:
        $response = "api no reconocida";
        break;
}

echo $master->returnApi($response);