<?php
$id = $_GET['q'];

$rutaArchivo = 'personal.json';
$json = file_get_contents($rutaArchivo);
$data = json_decode($json, true);

if (!empty($data[$id])) {
    echo "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Identificacion | bimo</title>
            <link rel='icon' type='image/png' href='https://www.bimo-lab.com/archivos/sistema/LogoConFondoAppAndroid.png'>
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    background-image: url('$data[$id]');
                    background-size: cover;
                    background-position: center;
                }

                @media screen and (orientation: landscape) {
                    body {
                        background-size: contain;
                    }
                }

                @media screen and (max-width: 767px) {
                    body {
                        display: block;
                        text-align: center;
                    }
                }
            </style>
        </head>
        <body>
        </body>
        </html>
    ";
}
