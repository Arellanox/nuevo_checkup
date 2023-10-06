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
$medico_usuario_id = $_POST['usuario_id'];
// $usuario_id = $master->setToNull([$_POST['usuario_id']])[0];

# variables para la vista del medico
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

$nuevo_medico = $_POST['nuevo_medico'];
$usuario_id = $_SESSION['id'];
$filtrar_todos = $_POST['filtrar_todos'];

# Turno ID
$turno_id = $_POST['turno_id'];

switch ($api) {
    case 1:
        #Actualiza un nuevo medico
        $response = $master->insertByProcedure("sp_medicos_tratantes_g", [$id_medico, $nombre_medico, $email, $medico_usuario_id]);
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
        $response = $master->getByProcedure("sp_medicos_tratantes_vista", [$usuario_id, $fecha_inicio, $fecha_fin, $filtrar_todos]);
        break;

    case 5:
        # Verificacion de las coincidencias encontradas
        if (strlen($nombre_medico) <= 3) {
            $response = [];
        } else {
            $medicos = $master->getByProcedure("sp_medicos_tratantes_b", [null, null, null]);
            $coincidencias = [];
            $nombre_medico = strtolower($nombre_medico);
            foreach ($medicos as $medico) {
                $base = strtolower($medico['NOMBRE_MEDICO']);
                $baseTokens = explode(' ', $base);
                $userTokens = explode(' ', $nombre_medico);

                $matches = 0;
                foreach ($userTokens as $userToken) {
                    foreach ($baseTokens as $baseToken) {
                        if (levenshtein($baseToken, $userToken) <= 2) { // Umbral de distancia
                            $matches++;
                            break;
                        }
                    }
                }

                $score = $matches / count($userTokens); // Cambio clave aquí: ahora consideramos la proporción basada en el userInput

                if ($score > 0.7) { // Puedes ajustar este umbral según lo necesites
                    $coincidencias[] = $medico['NOMBRE_MEDICO'];
                }
            }

            $response = $coincidencias;
        }

        break;

    case 6:
        # recuperar reportes de paciente por el turno
        $response = $master->getByProcedure("sp_recuperar_reportes_confirmados", [$turno_id, null, null, null, null]);
        break;

    default:
        $response = "API no definida.";
}

echo $master->returnApi($response);
