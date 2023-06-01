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
                }

                .container {
                    background-color: rgb(0, 78, 89);
                    width: 100%;
                    height: 100%;
                }

                .image-container {
                    background-image: url('$data[$id]');
                    background-size: contain;
                    background-position: center;
                    background-repeat: no-repeat;
                    width: 100%;
                    height: 100%;
                }

                @media screen and (orientation: landscape) {
                    .image-container {
                        background-size: contain;
                    }
                }

                @media screen and (max-width: 767px) {
                    .container {
                        display: block;
                        text-align: center;
                    }
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='image-container'></div>
            </div>
        </body>
        </html>
    ";
}
