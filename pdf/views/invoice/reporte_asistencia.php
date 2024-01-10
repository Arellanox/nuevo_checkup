<?php

function convertirObjetoAArray($objeto)
{
    if (is_object($objeto)) {
        // Opción 1: Utilizar el casting
        $array_resultante = (array) $objeto;

        // Opción 2: Utilizar get_object_vars
        // $array_resultante = get_object_vars($objeto);

        return $array_resultante;
    } else {
        // Si el argumento no es un objeto, puedes manejarlo de acuerdo a tus necesidades
        return array();
    }
}

$resultado = convertirObjetoAArray($resultados[0]);

// echo "<pre>";
// var_dump();
// echo "</pre>";
// exit;



$asistencia = array(
    "colaborador" => array(
        "px" => $resultado['NOMBRE'],
        "area" => $resultado['AREA'],
        "dias_trabajados" => $resultado['DIAS_TRABAJADOS'],
        "Hrs_extras" => "",
        "vacaciones" => "",
        "permiso_cgs_1" => "",
        "permiso_cgs_2" => "",
        "permiso_sgs" => "",
        "incapacidad" => "",
        "retardos" => "",
        "faltas_injustificadas" => "",
    ),
    "periodo" => array(
        "inicio" => $resultado['FECHA_INICIO'],
        "final" => $resultado['FECHA_FINAL'],
    ),
    "no_quincenca" => 12,
    "fechas" => json_decode($resultado['ASISTENCIAS']),
);


?>


<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de entradas y salidas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">  -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            /* margin-top: 60px; */
            margin-bottom: 30px;
            font-size: 10px;
            /* background-color: gray; */
        }

        .break {
            page-break-after: always;
        }

        .footer .page:after {
            content: counter(page);
        }
    </style>

</head>


<body>
    <!-- header -->
    <div class="header">
        <?php
        ?>
    </div>

    <!-- Footer 1 chido -->
    <div class="footer">
        <?php
        ?>
    </div>


    <!-- body -->
    <!-- <?php ?> -->
    <div class="invoice-content">
        <style>
            @page {
                margin: 40px 10px 94px 10px;
            }

            .body-certificado {
                padding: 10px 30px 10px 30px;
            }

            .body-certificado p {
                font-size: 13px;
            }

            .body-certificado h1 {
                padding: none !important;
                margin: none !important;
            }

            .body-certificado .none-p {
                padding: none !important;
                margin: none !important;
            }

            .body-certificado .center {
                text-align: center !important;
            }

            .body-certificado .justify {
                text-align: justify !important;
            }

            .body-certificado table {
                width: 100%;
                max-width: 100%;

                caption-side: bottom;
                border-collapse: collapse;
            }

            .body-certificado th,
            .body-certificado td {
                border: 1px solid black;
                width: 100%;
                max-width: 100%;
                word-break: break-all;
            }

            .body-certificado .border {
                border: 1px solid black;
            }

            .body-certificado td {
                padding: 2px;
                font-size: 15px;
            }

            .body-certificado .res {
                font-size: 13px !important;
            }

            .body-certificado .left {
                padding-left: 30px !important;
            }

            .body-certificado .bg {
                padding: 6px;
                background-color: #e7e6e6 !important;
            }

            .border-none {
                border: none !important;
            }

            .body-certificado .bold {
                font-weight: bold !important;
            }

            .body-certificado .italic {
                font-style: italic !important;
            }

            .body-certificado .pb {
                padding-bottom: 20px !important;
            }

            .body-certificado .p {
                padding: 5px !important;
            }

            .body-certificado .tabla2 {
                margin-left: auto !important;
            }

            .body-certificado .bg-black {
                color: white !important;
                background-color: black !important;
            }

            .body-certificado .bg-gray {
                background-color: #d8d8d8 !important;
            }

            .body-certificado .title {
                position: absolute;
                top: -50px;
            }

            .body-certificado .p-blue {
                color: #061953 !important;
            }
        </style>

        <!-- Body -->
        <div class="body-certificado">
            <!-- Tabla de informacion del bimer -->
            <table>
                <tr>
                    <td colspan="3" class="center">
                        <span class="margin:20px 0px 20px 0px;">
                            REPORTE DE ENTRADAS Y SALIDAS DIAGNÓSTICO BIOMOLECULAR S.A DE C.V.
                        </span>
                    </td>
                    <td colspan="2" style="width: 40%;">
                        <span>
                            logo
                        </span>
                    </td>
                </tr>
                <!-- Espacio -->
                <tr>
                    <td style="border: none !important; height:20px !important;" colspan="5"></td>
                </tr>
                <!-- Colabor -->
                <tr>
                    <td colspan="1" class="border-none">Colaborador</td>
                    <td colspan="4" class="border-none center"><?php echo $asistencia['colaborador']['px'] ?></td>
                </tr>
                <!-- Area -->
                <tr>
                    <td colspan="1" class="border-none">Area</td>
                    <td colspan="4" class="center"><?php echo $asistencia['colaborador']['area'] ?></td>
                </tr>
                <!-- Periodo -->
                <tr>
                    <td class="border-none">Periodo</td>
                    <td class="bg-gray">De</td>
                    <td class="left"><?php echo $asistencia['periodo']['inicio'] ?></td>
                    <td class="bg-gray">A</td>
                    <td><?php echo $asistencia['periodo']['final'] ?></td>
                </tr>
                <!-- No quincena -->
                <tr>
                    <td colspan="1" class="border-none">No. quincena</td>
                    <td colspan="4" class=""> QO1</td>
                </tr>
                <!-- Espacio -->
                <tr>
                    <td style="border: none !important; height:20px !important;" colspan="5"></td>
                </tr>
            </table>

            <!-- Tabla de fecha salida y observaciones -->
            <table>
                <tr>
                    <td class="center bold p-blue">Fecha</td>
                    <td class="center bold p-blue">Fe</td>
                    <td class="center bold p-blue">Salida</td>
                    <td class="center bold p-blue">Observaciones</td>
                </tr>
                <?php foreach ($asistencia['fechas'] as $key => $value) : ?>
                    <?php $e = json_decode($value) ?>
                    <tr>
                        <td class="center"> <?php echo $e->FECHA ?> </td>
                        <td></td>
                        <td> <?php echo $e->HORA_SALIDA ?></td>
                        <td></td>
                    </tr>
                <?php endforeach ?>
                <!-- <tr>
                    <td class="center">01/01/2024</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> -->
                <!-- Espacio -->
                <tr>
                    <td style="border: none !important; height:20px !important;" colspan="4"></td>
                </tr>
            </table>

            <!-- Tabla con la informacion de dias trabajados Hrs Extras Vacaciones etc -->
            <table>
                <tr>
                    <td class="center bg-gray">Días trabajados</td>
                    <td class="center bg-gray"> Hrs. Extras</td>
                    <td class="center bg-gray">Vacaciones</td>
                    <td class="center bg-gray">Permisos CGS</td>
                    <td class="center bg-gray">Permisos CGS</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <!-- Espacio -->
                <tr>
                    <td style="border: none !important; height:20px !important;" colspan="5"></td>
                </tr>
            </table>

            <!-- Tabla  otros permisos, incapacidad, retardos, falta injustificada -->
            <table>
                <tr>
                    <td class="center bg-gray">Permisos SGS</td>
                    <td class="center bg-gray"> incapacidad</td>
                    <td class="center bg-gray">Retardos</td>
                    <td class="center bg-gray">Falta injustificada</td>
                    <td class="border-none"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="border-none"></td>
                </tr>
                <!-- Espacio -->
                <tr>
                    <td style="border: none !important; height:20px !important;" colspan="5"></td>
                </tr>
                <tr>
                    <td style="border: none !important; height:20px !important;" colspan="5"></td>
                </tr>
            </table>

            <!-- Firma de conformidad, fecha firma -->
            <table>
                <tr>
                    <td class="border-none" style="width: 80%;">
                        Firma de confirmidad
                    </td>
                    <td class="border-none" style="border-bottom: 1px solid black !important;">

                    </td>
                    <td class="border-none" style="width: 40%;"></td>
                    <td class="border-none" style="width: 50%;">
                        Fecha_firma
                    </td>
                    <td class="border-none" style="border-bottom: 1px solid black !important;">

                    </td>

                </tr>
                <tr>
                    <td style="border: none !important; height:20px !important;" colspan="5"></td>
                </tr>
            </table>

            <!-- Tabla nombre -->
            <table>
                <tr>
                    <td class="border-none" style="width: 10%;">
                        Nombre
                    </td>
                    <td class="border-none" style="border-bottom: 1px solid black !important;">

                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>