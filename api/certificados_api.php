<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include "../clases/correo_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();
$api = $_POST['api'];
$registrado_por = $_SESSION['id'];

# variables para lista de trabajo.
$fecha = isset($_POST['fecha_busqueda']) ? $_POST['fecha_busqueda'] : null;

# variables para certificado slb
$turno_id = $_POST['turno_id'];
$cliente_id = $_POST['cliente_id'];

# datos para guardar el certificado de slb
$nombre_medico = $_POST['nombre_medico'];
$cedula_medico = $_POST['cedula_medico'];
$nombre_paciente = $_POST['nombre_paciente'];
$fecha_nacimiento_paciente = $_POST['fecha_nacimiento_paciente'];
$segmento = $_POST['segmento'];
$categoria = $_POST['categoria'];
$apto = $_POST['apto'];
$comentarios_apto = $_POST['apto_comentarios'];
$antidoping = $_POST['antidoping'];
$grupo_sangre = $_POST['grupo_sangre'];
$add = $_POST['add'];
$tipo = $_POST['tipo_certificado'];

$certificado_slb = array(
    "nombre_medico" => $nombre_medico,
    "cedula_medico" => $cedula_medico,
    "nombre_paciente" => $nombre_paciente,
    "fecha_nacimiento_paciente" => $fecha_nacimiento_paciente,
    "segmento" => $segmento,
    "categoria" => $categoria,
    "apto" => $apto,
    "comentarios_apto" => $comentarios_apto,
    "antidoping" => $antidoping,
    "grupo_sangre" => $grupo_sangre,
    "add" => $add
);


$cuerpo = json_encode($_POST['cuerpo']);


switch($api){
    case 1:
        # lista de trabajo para certificados.
        # pacientes que tengan cargado entre sus estudios una historia clinica.
        $response = $master->getByProcedure("sp_lista_de_trabajo_certificados", [$fecha, 1, null, null, null]);
        break;
    case 2:
        # recuperar los datos del certificado
        $response = $master->getByProcedure("sp_certificados_b",[$cliente_id, $turno_id, $_SESSION['id']]);
        break;
    case 3:

        $response = $master->getByProcedure("sp_certificados_g", [$cuerpo, $_SESSION['id']]);

        break;
    default:
        $response = "API no definida.";
    break;

}

echo $master->returnApi($response);
?>