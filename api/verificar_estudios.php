<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$master = new Master();

header('Content-Type: application/json');

# =========================
# RECIBIR ID
# =========================

$id = isset($_GET['id'])
    ? intval($_GET['id'])
    : 0;

if ($id <= 0) {

    echo json_encode([
        "error" => "ID inválido"
    ]);

    exit;
}

# CONSULTA
$resultado = $master->getByProcedure("sp_verificacion_estudios", [$id]);

# =========================
# RESPUESTA
# =========================

if (is_array($resultado)) {
    
    echo $master->returnApi($resultado);

} else {

    http_response_code(404);

    echo json_encode([
        "error" => "Estudio no encontrado"
    ]);
}
