<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";


$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    # $tokenVerification->logout();
    # exit;
}

$master = new Master();
$api = $_POST['api'];

# variables insert
$id_vendedor = $_POST['id_vendedor'];
$nombre = $_POST['nombre-vendedor'];
$paterno = $_POST['apellido-paterno_vendedor'];
$materno = $_POST['apellido-materno_vendedor'];
$nacimiento = $_POST['fecha-vendedor'];
$edad = $_POST['edad-vendedor'];
$telefono = $_POST['numero-vendedor'];
$correo = $_POST['email-vendedor'];
$comision = $_POST['comision-vendedor']; # comision otorgada. Ganancia
$id_medico = $_POST['id_medico'];
$id_periodo = $_POST['id_periodo'];


switch ($api) {
    case 1:
        # insertar/actualizar vendedores
        $response = $master->insertByProcedure("sp_vendedores_comisionistas_g", [
            $id_vendedor,
            $nombre,
            $paterno,
            $materno,
            $correo,
            $telefono,
            $nacimiento,
            $edad,
            $comision
        ]);
        break;
    case 2:
        # buscar vendedores alv

        # puedes enviar cualquiera de las 2 variables para el filtro, o no enviar ninguna para recuperar todos.
        $response = $master->getByProcedure("sp_vendedores_comisionistas_b", [$id_vendedor, $correo]);
        break;
    case 3:
        # eliminar el vendedor
        $response = $master->deleteByProcedure("sp_vendedores_comisionistas_e", [$id_vendedor]);
        break;

    case 4:
        # ventas realizadas en una fecha determinada por vendedor comisionista
        $response = $master->getByProcedure("sp_vendedores_comisionistas_ventas", [$id_vendedor, $fecha_inicial, $fecha_final]);
        break;
    case 5:
        # asignar un vendedor a un medico
        $response = $master->updateByProcedure("sp_vendedores_comisionistas_asignar_vendedor", [
            $id_medico,
            $id_vendedor
        ]);
        break;
    case 6:
        # recuperar los periodos de pago.
        $response = $master->getByProcedure("sp_vendedores_periodos_b", [$id_vendedor, $id_periodo]);
        break;

    default:
        $response = "Api no definida";
        break;
}

echo $master->returnApi($response);
