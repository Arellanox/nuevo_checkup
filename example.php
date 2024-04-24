<?php

// Tu clave API de OpenAI
$apiKey = "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";

// El texto que quieres convertir a voz
$text = "Hola, este es un ejemplo de texto convertido a voz utilizando el API de OpenAI.";

// Configuración de cURL
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/text-to-speech");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);

$headers = array();
$headers[] = "Content-Type: application/json";
$headers[] = "Authorization: Bearer {$apiKey}";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Aquí ajustas los parámetros según tus necesidades, como el modelo de voz
$data = json_encode(array(
    "text" => $text,
    // Añade aquí más opciones según necesites
));

curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// Ejecuta la solicitud y captura la respuesta
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    // Aquí puedes guardar el audio en un archivo o manipularlo como necesites
    // La respuesta incluirá la URL del audio generado que puedes descargar o reproducir
    $decodedResponse = json_decode($response, true);
    if (isset($decodedResponse['data']['url'])) {
        $audioUrl = $decodedResponse['data']['url'];
        echo "URL del audio: " . $audioUrl . "\n";
        // Por ejemplo, puedes redirigir al navegador para reproducir el audio
        // header("Location: " . $audioUrl);
    } else {
        echo "No se pudo generar el audio. Respuesta recibida: " . $response;
    }
}

curl_close($ch);
