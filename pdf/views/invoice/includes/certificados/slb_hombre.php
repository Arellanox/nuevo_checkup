<?php

# firma del medico
$img = file_get_contents("https://i.ibb.co/GQsJwcZ/Image-005.jpg");
$encode = base64_encode($img);

# logo de bimo
$img2 = file_get_contents("https://i.ibb.co/hVmkQh6/Image-006.jpg");
$encode2 = base64_encode($img2);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>HC JORGE LÓPEZ AVALOS.pdf</title>
    <meta name="author" content="abka-" />
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            text-indent: 0;
        }

        .break {
            page-break-after: always;
        }

        .container {
            /* border: 1px solid black; */
            padding: 50px 30px 50px 50px;
        }

        .h1,
        h1 {
            color: #221F1F;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 12pt;
        }

        .s3 {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10pt;
        }

        .h2 {
            color: #221F1F;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 12pt;
        }

        p {
            color: #221F1F;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 12pt;
            margin: 0pt;
        }

        .s4 {
            color: #221F1F;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 12pt;
            vertical-align: -2pt;
        }

        .a,
        a {
            color: #221F1F;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 12pt;
        }
    </style>
</head>

<body>
    <!-- Contenedor del body -->
    <div class="container">
        <!-- Titulo -->
        <div class="title" style="text-align: center; margin-top:50px;">
            <h1>EXAMEN MEDICO</h1>
        </div>
        <!-- Cuerpo del reporte -->
        <div class="content">
            <!-- Asunto -->
            <div class="asunto" style="margin-top: 30px;">
                <h1>
                    ASUNTO: Certificado de Aptitud
                </h1>
            </div>
            <div class="informacion-medico" style="margin-top: 50px;">
                <h1 style="text-align:justify;">El Médico Beatriz Alejandra Ramos González, con cedula profesional 7796595 en el registro de profesiones, certifico que el Sr. Soto Cuellar, Carlos Alfonso con fecha de nacimiento 20/10/1995, Segmento SPS en el puesto PL Job Delivery Lead se sometió a un examen médico apoyado de pruebas de laboratorio y gabinete en la fecha 12/10/2023, es medicamente:</h1>
            </div>
            <div class="div_apto_noapto" style="margin-top: 10px">
                <p style="text-indent: 0pt;text-align: left;">
                    <br />
                </p>
                <p class="s1" style="padding-top: 2pt;padding-left: 130pt;text-indent: 0pt;text-align: left;">
                    <input type="checkbox" checked style="padding-top:10px;">
                    <span class="p">Apto sin restricciones en la industria de gas y petróleo.</span>
                </p>
                <p class="s1" style="padding-top: 2pt;padding-left: 130pt;text-indent: 0pt;text-align: left;">
                    <input type="checkbox">
                    <span class="p">Apto con restricciones para las siguientes actividades: </span>
                    <span class="s2">………………………………………………………………………………</span>
                </p>
                <p class="s1" style="padding-top: 2pt;padding-left: 130pt;text-indent: 0pt;text-align: left;">
                    <span>
                        <input type="checkbox">
                    </span>
                    <span class="p">No apto para trabajar en la industria de gas y petróleo</span>
                </p>


            </div>
            <div class="antidoping" style="margin-top: 20px;">
                <h1>ANTIDOPING: <br>
                    NEGATIVO
                </h1>
            </div>
            <div class="grupo-sanguineo" style="margin-top: 30px;">
                <h1>
                    GRUPO SANGUINEO: B+
                </h1>
            </div>
            <div class="add" style="margin-top: 20px;">
                <h1>
                    ADD: Se le realizaron los siguientes estudios médicos: BHC, VSG, QS, TGO, TGP GGT, perfil de lípidos, antidoping de 5 elementos, EGO, CPS, audiometría espirometría, Rayos X: tele de tórax, AP y lateral de columna lumbar y agudeza visual.
                </h1>
            </div>
            <div class="base">
                <h1>
                    Con base a la evaluación el empleado no cumple con ninguno de los criterios de vulnerabilidad publicados por
                    el IMSS en julio 2020, por lo tanto; no es considerado como personal vulnerable.
                </h1>
            </div>
            <div class="informacion-medico" style="margin-top: 10px;">
                <h1>
                    Nombre del Medico examinador: Ramos Gonzales, Beatriz Alenjandra.
                </h1>
                <h1>
                    Firma del Medico examinador:
                </h1>
                <div class="firma-contenedor" style="
                display:flex;
                justify-content:center;
                text-align:center;
                ">
                    <img src="data:image/png;base64,<?php echo $encode ?>">
                </div>
            </div>
            <div class="direccion">
                <h1>
                    Dirección del Medico examinador: Av. José Pagés Llergo #150 Col. Arboledas C.P. 86079 en Villahermosa, Tabasco,México.
                </h1>
                <h1 class="" style="margin-top: 5px;">
                    Teléfono: 9936340250
                </h1>
                <h1 style="margin-top: 5px ;">
                    Correo electrónico: hola@bimo.com.mx
                </h1>
            </div>
            <div class="sello-centro-medico">
                <style>
                    .sello-centro-medico {
                        position: absolute;
                        bottom: 50px;
                        left: 450px;
                        z-index: 100;
                    }

                    .sello-centro-medico h1 {
                        margin-bottom: 10px !important;
                    }
                </style>
                <div class="contenedor">
                    <h1>
                        SELLO DEL CENTRO MEDICO
                    </h1>
                    <img src="data:image/png;base64,<?php echo $encode2 ?>">
                </div>
            </div>
        </div>
    </div>
</body>

</html>