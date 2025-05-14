<?php
date_default_timezone_set('America/Mexico_City');
session_start();

$menu = $_POST['menu'];
$tip = $_POST['tip'];
$tipoUrl = $_POST['tipoUrl'] ?? 1;

$current_host = $_SERVER['HTTP_HOST'];
$servidores = [
    'bimo-lab.com' => ['https' => 'http://', 'url' => 'bimo-lab.com'],
    'drjb.com.mx' => ['https' => 'https://', 'url' => 'drjb.com.mx', 'session' => true],
    'helicebiologicos.com' => ['https' => 'http://', 'url' => 'helicebiologicos.com'],
    'localhost' => ['https' => 'http://', 'url' => 'localhost'],
];
$servidorLocal = [
    'localhost' => ['https' => 'http://', 'url' => 'localhost'],
];

$servidorLocal = [
    'localhost' => ['https' => 'http://', 'url' => 'localhost'],
];

$https = 'http://';
$url = 'localhost';
$appname = "nuevo_checkup";
$isLocalHost = isset($servidorLocal[$current_host]);

if (isset($servidores[$current_host])) {
    $config = $servidores[$current_host];
    $https = $config['https'];
    $url = $config['url'];

    // Si el dominio es 'drjb.com.mx', establecer la variable de sesión
    if (isset($config['session']) && $config['session'] === true) {
        $_SESSION['URLACTUAL'] = $url;
    }
}

$current_url = $https . $url . '/' . $appname;
$session_data = $_SESSION;
$isFranquisiario = $_SESSION['franquiciario'];

if ($url == "drjb.com.mx"): ?>
    <style>
        table thead {background-color: #10ADA6 !important; }
        .bg-navbar { background-color: #00958e !important; }
    </style>
<?php endif; ?>


