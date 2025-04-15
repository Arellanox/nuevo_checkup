<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

#api
$api = $_POST['api'];

#buscar
#$id = $_POST['id'];
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

$parametros = array(
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
    $medios_entrega,      // 26 _medios (JSON string)
    $tipo_conversion,  // 27 _tipo_conversion
    $talla             // 28 _talla
);

$response = "";

# Esta variable es enviada desde el formulario de fast checkup
# hay que evaluarlo si tiene algo ingresarlo en somatometria. Talla
$talla = $_POST['talla'];
$usuario_franquicia_id = $_SESSION['franquiciario'] ? $_SESSION['id'] : null;

$master = new Master();
switch ($api) {
    case 1:
        $medios = array_map('intval', explode(',', $medios_entrega));
        $parametros[26] = json_encode($medios); //Se asgina a la posición 26 directamente
        $parametros[28] = $talla; //Se asgina a la posición 28 directamente

        $response = $master->insertByProcedure("sp_pacientes_g", $parametros);
        break;
    case 2:
        # buscar pacientes
        // echo $id_paciente;
        $response = $master->getByProcedure("sp_pacientes_b", [
            $id_paciente, $curp, $pasaporte, $id_turno, $usuario_franquicia_id
        ]);

        foreach ($response as $key => $value) {
            $value['ordenes'] = $master->decodeJson([$value['ordenes']]);
            $response[$key]['ordenes'] = $value['ordenes'];
        }

        $response = $master->decodeJsonRecursively($response);

        break;
    case 3:
        # actualizar pacientes
        # convertimos en arreglo chido la lista separada por comas.
        $medios = explode(',', $medios_entrega);

        # agregamos el json al arreglo del paciente
        array_push($parametros, json_encode($medios));
        array_push($parametros, $talla);
        $response = $master->updateByProcedure("sp_pacientes_g", $parametros);
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
