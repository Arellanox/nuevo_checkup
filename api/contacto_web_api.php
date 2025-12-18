<?php
include_once "../clases/master_class.php";
include "../clases/correo_class.php";


 $datos = json_decode(file_get_contents('php://input'), true);

 if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Solicitudes preflight OPTIONS
    header('Access-Control-Allow-Origin: http://localhost:3000');
    header('Access-Control-Allow-Origin: https://www.bimo.com.mx');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Max-Age: 86400'); // 1 día
    header("HTTP/1.1 200 OK");
    exit;
}

// Para otras solicitudes, como POST
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Origin: https://www.bimo.com.mx');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json');
 
// Verifica si se ha recibido una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera los datos enviados desde el formulario
    $nombre = $datos['nombre'];
    $correo = $datos['correo'];
    $mensaje = $datos['mensaje'];

    // Enviar el correo hola@bimo.com.mx
    $correo = new Correo();
    $master = new Master();

    $correo->sendEmail("formularioContacto", "Nuevo lead captado!",["josue.delacruz@bimo.com.mx", "hola@bimo.com.mx"],$datos);
    
    # guardar los datos del lead.
    $r = $master->insertByProcedure("sp_formulario_contacto_g", [
        $datos['nombre'], 
        $datos['email'], 
        $datos['telefono'], 
        $datos['asunto'],
        $datos['comentario_ayuda'],
        $datos['politica']
    ]);

    // Devuelve una respuesta al cliente (JavaScript)
    $respuesta = ['success' => true, 'message' => 'Formulario enviado con éxito'];
    echo json_encode($respuesta);
} else {
    // Si la solicitud no es POST, devuelve un error
    http_response_code(405);
    echo 'Método no permitido';
}
?>
