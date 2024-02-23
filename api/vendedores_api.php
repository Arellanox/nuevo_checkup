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
$nombre = $_POST['nombre'];
$paterno = $_POST['paterno'];
$materno = $_POST['materno'];
$nacimiento = $_POST['nacimiento'];
$edad = $_POST['edad'];
$telefono = $_POST['tel'];
$correo = $_POST['email'];
$comision = $_POST['comision']; # comision otorgada. Ganancia


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
    
    default:
        $response = "Api no definida";
        break;
}

echo $master->returnApi($response);