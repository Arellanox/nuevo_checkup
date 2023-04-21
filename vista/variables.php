<?php

// $url = "bimo-lab.com";
// $https = 'https://';
// $url = "localhost";
$https = 'http://';

// $url = $_SERVER['HTTP_HOST'];
switch ($_SERVER['HTTP_HOST']) {
    case 'bimo-lab.com':
        $url = 'bimo-lab.com';
        break;
    case 'localhost':
        $url = 'localhost';
        break;
    case 'drjb.com.mx':
        $url = 'drjb.com.mx';
        $_SESSION['URLACTUAL'] = 'drjb.com.mx';
        break;
    case 'helicebiologicos.com':
        $url = 'helicebiologicos.com';
        break;

    default:
        $url = 'localhost';
        break;
}

$appname = "nuevo_checkup";
// echo $appname;

// echo $url;
// exit;


if ($url == "drjb.com.mx") {
?>
    <style>
        table thead {
            background-color: #10ADA6 !important;
        }

        .bg-navbar {
            /* background-color: rgb(000, 078, 089); */
            background-color: #00958e !important;
        }
    </style>

<?php
}


?>