<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) { 
    // $tokenVerification->logout();
    // exit;
}


$master = new Master();
$api = $_POST['api'];

$ignorarALevenshtein = $_POST['ignorarALevenshtein']; # enviar 1 para ignorar, 0 para hacerle caso a levenshtein
$id_medico = $_POST['id_medico'];
$nombre_medico = $_POST['nombre_medico'];
$email = $_POST['email'];
$usuario_id = $master->setToNull([$_POST['usuario_id']])[0];

# variables para la vista del medico
$fecha_inicio = $_POST['fecha_iniciio'];
$fecha_fin = $_POST['fecha_fin'];

switch ($api) {
    case 1:
        #insertar un nuevo medico.
        if ($ignorarALevenshtein == 1) {

            # si deciden ignorar a levenshtein lo insertamos
            $response = $master->insertByProcedure("sp_medicos_tratantes_g", [$id_medico, $nombre_medico, $email, $usuario_id]);
        } else {

            # si no ignoran a levenshtein obtenemos la lista de pacientes y devolvemos las coincidencias aproximadas
            $medicos = $master->getByProcedure("sp_medicos_tratantes_b", [null, null, null]);

            $x = [];

            # si recibimos la id del usuarios
            if (isset($usuario_id)) {
                $usuario = ($master->getByProcedure("sp_usuarios_b", [$usuario_id, null]))[0];
                $nombre_medico = $usuario['NOMBRE'] . ' ' . $usuario['PATERNO'] . ' ' . $usuario['MATERNO'];
            }

            foreach ($medicos as $medico) {
                $medico['distancia'] = $master->getLevenshteinDistance($nombre_medico, $medico['NOMBRE_MEDICO']);
                $x[] = $medico;
            }


            $coincidencias = array_filter($x, function ($obj) {
                return $obj['distancia'] <= 8;
            });

            if (count($coincidencias) == 0) {
                # si levenshtein dice que no hay coincidencias, insertamos al medico.
                $response = $master->insertByProcedure("sp_medicos_tratantes_g", [$id_medico, $nombre_medico, $email, $usuario_id]);
            } else {
                # si existen coincidencias, las devolvemos enel response
                // echo json_encode(array('code' => 2, "msj" => $master->getFormValues($coincidencias)));
                $response = $coincidencias;
                // exit;
            }
        }
        break;
    case 2:
        # buscar los medicos tratantes
        $response = $master->getByProcedure("sp_medicos_tratantes_b", [$id_medico, $nombre_medico, $email]);
        break;
    case 3:
        # eliminar medico tratante
        $response = $master->deleteByProcedure("sp_medicos_tratantes_e", [$id_medico]);
        break;
    case 4:
        # vista de los usuarios tipo medico tratante.
        
        #lista de pacientes que estan siendo atendidos por el usuario - medico tratante
        $response = $master->getByProcedure("sp_medicos_tratantes_vista", [$_SESSION['id'], $fecha_inicio, $fecha_fin]);
    default:
        $response = "API no definida.";
}

echo $master->returnApi($response);
