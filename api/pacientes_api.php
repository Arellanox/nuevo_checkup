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
    $id_paciente,
    $segmento_id,
    $nombre,
    $paterno,
    $materno,
    $edad,
    $nacimiento,
    $curp,
    $celular,
    $correo,
    $postal,
    $estado,
    $municipio,
    $colonia,
    $exterior,
    $interior,
    $calle,
    $nacionalidad,
    $pasaporte,
    $rfc,
    $vacuna,
    $otravacuna,
    $dosis,
    $genero,
    $correo2,
    $tipo_conversion
);

$response = "";

# Esta variable es enviada desde el formulario de fast checkup
# hay que evaluarlo si tiene algo ingresarlo en somatometria. Talla
$talla = $_POST['talla'];

$master = new Master();
switch ($api) {
    case 1:
        # insertar un nuevo paciente

        # Agregar los tipos de medios que quiere el paciente recibir sus resultados.
        # Este procedure recibe una lista separadas por comas de los ids de los medios de entrega

        # solo envias la lista con las opciones que tendra el paciente, agrega o elimina segun la lista que reciba.

        # convertimos en arreglo chido la lista separada por comas.
        $medios = explode(',', $medios_entrega);

        # agregamos el json al arreglo del paciente
        array_push($parametros, json_encode($medios));

        # insertar la talla en el arreglo general ( esto es para fast checkup)
        # luego al ser aceptado se guarda en somatometria (tabla)
        array_push($parametros, $talla);
    

        $response = $master->insertByProcedure("sp_pacientes_g", $parametros);
        break;
    case 2:
        # buscar pacientes
        // echo $id_paciente;
        $response = $master->getByProcedure("sp_pacientes_b", [$id_paciente, $curp, $pasaporte, $id_turno]);

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
