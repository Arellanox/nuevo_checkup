<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interpretación de Historia Pediátrica</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">  -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">

    <style>
        @page {
            margin: 165px 10px;
        }

        body {
            font-family: 'Roboto', sans-serif;
            margin-top: 80px;
            margin-bottom: 40px;
            font-size: 10px;
            /* background-color: gray; */
        }

        .header {
            position: fixed;
            top: -165px;
            left: 25px;
            right: 25px;
            height: 220px;
            margin-top: 0;
        }

        .footer {
            position: fixed;
            bottom: -165px;
            left: 25px;
            right: 25px;
            height: 220px;
            /* background-color: pink; */
        }

        a {
            position: fixed;
            padding: 0px;
            top: -15px;
            left: 40px
        }

        .footer .page:after {
            content: counter(page);
        }

        /* Saltar a nueva pagina */
        .break {
            page-break-after: always;
        }

        /* Content */
        .invoice-content {
            border-radius: 4px;
            padding-bottom: 10px;
            padding-right: 30px;
            padding-left: 30px;
            text-align: justify;
            text-justify: inter-word;
        }


        h1 {
            font-size: 22px;
            margin-top: 2px;
            margin-bottom: 2px;
        }

        h2 {
            font-size: 15px;
            margin-top: 18px;
            /* margin-bottom: 10px; */
            text-align: center;
            background-color: rgba(215, 222, 228, 0.748);
            /* padding-top: 10px; */
        }

        h3 {
            font-size: 16px;
            margin-top: 2px;
            margin-bottom: 2px;
        }

        h4 {
            font-size: 14px;
            margin-top: 2px;
            margin-bottom: 2px;
            line-height: 1;
        }

        h5 {
            font-size: 12.5px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        p {
            font-size: 12px;
            line-height: 1;
        }

        strong {
            font-size: 12px;
            /* line-height: 1.3; */
            margin-top: 0.5em;
            margin-bottom: 0.5em;

        }

        .align-center {
            text-align: center;
        }

        table {
            width: 100%;
            max-width: 100%;
            margin: auto;
            white-space: normal;
            word-break: break-all;
            /* table-layout:fixed; */
        }

        th,
        td {
            width: 100%;
            max-width: 100%;
            word-break: break-all;
        }

        /* Para divisiones de 3 encabezado*/
        .col-left {
            width: 44%;
            max-width: 44%;
            text-align: left;
            font-size: 11px;
            margin-left: 2px;
        }

        .col-center {
            width: 32%;
            max-width: 32%;
            text-align: left;
            font-size: 11px;
            margin-left: 2px;
        }

        .col-right {
            width: 24%;
            max-width: 24%;
            text-align: left;
            font-size: 11px;
            margin-left: 2px;
        }

        /* divisiones de 3 footer */
        .col-foot-one {
            width: 30%;
            max-width: 30%;
            text-align: left;
            font-size: 12px;
        }

        .col-foot-two {
            width: 40%;
            max-width: 40%;
            text-align: center;
            font-size: 12px;
        }

        .col-foot-three {
            width: 30%;
            max-width: 30%;
            text-align: right;
            font-size: 12px;
        }

        /* Para divisiones de 4 */
        .result {
            font-size: 12px
        }

        /* diviciones de 2 */
        .col-izq {
            width: 30%;
            max-width: 30%;
            text-align: center;
        }

        .col-der {
            width: 70%;
            max-width: 70%;
            text-align: left;
        }

        /* Fivisiones de cinco */
        .col-one {
            width: 30%;
            max-width: 30%;
            text-align: left;
        }

        .col-two {
            width: 20%;
            max-width: 20%;
            text-align: right;
        }

        .col-three {
            width: 25%;
            max-width: 25%;
            text-align: center;

        }

        .col-four {
            width: 25%;
            max-width: 25%;
            text-align: center;
        }
    </style>
</head>

<?php

// para el path del logo 
$ruta = file_get_contents('../pdf/public/assets/icono_reporte_checkup.png');
$encode = base64_encode($ruta);

// Para la firma se requiere mandar la "firma" tambien en base 64 e incrustarlo como en el ejemplo de arriba,
//los datos de abajo son meramente informativos y solo sirven para rellenar la informacion del documento
// echo '<img src="data:image/png;base64, '. $img_valido .'" alt="" height="75" >';

// path firma
$ruta_firma = file_get_contents('../pdf/public/assets/firma_beatriz.png');
$encode_firma = base64_encode($ruta_firma);


?>

<body>
    <!-- header -->
    <div class="header">
        <?php
        $titulo = 'Checkup Clínica y Prevención';
        $tituloPersonales = 'Información del paciente';
        $subtitulo = 'Historia Pediátrica';
        $encabezado->FECHA_RESULTADO = $encabezado->FECHA_RESULTADO_HISTORIA_PED;
        include 'includes/header.php';
        ?>
    </div>

    <!-- Footer 1 chido -->
    <div class="footer">
        <?php
        $footerDoctor = 'Dra. BEATRIZ ALEJANDRA RAMOS GONZÁLEZ <br>UJAT - Cédula profesional: 7796595';

        include 'includes/footer.php';
        ?>
    </div>


    <!-- body -->
    <div class="invoice-content">
        <!-- ANTECEDENTES HEREDOFAMILIARES PADRE -->
        <?php
        // echo '<pre>';
        // print_r($resultados[1]);
        // echo "</pre>";
        // exit;

        if(isset($resultados[1])){
            echo '<h2 style="padding-bottom: 6px; padding-top: 6px;">ANTECEDENTES HEREDOFAMILIARES PADRE </h2>';
        

            foreach($resultados[1] as $espoque):
            ?>
                <table class='result' style='padding-top: 1px; white-space:break-spaces; border-collapse: separate; border-spacing: 0 5px;'>
                <tbody>
                    <tr>
                        <td class="col-der" style="border-bottom: none; ">
                            <strong>
                                <?php echo $espoque->ANTECEDENTE; ?>
                            </strong>
                        </td>
                        <td class="col-izq" style="border-bottom: none">
                            <?php echo $espoque->RESPUESTA; ?>
                        </td>
                    </tr>
                    <?php if (isset($espoque->NOTAS)) { ?>
                        <tr>
                            <td class="col-der" style="text-align:justify;">
                                <strong>Nota: </strong> <?php echo $espoque->NOTAS; ?>
                            </td>
                            <td class="col-izq"></td>
                        </tr>
                    <?php           } ?>
                </tbody>
            </table>
                        <?php
            endforeach;       
         }
        ?>
     <!-- ANTECEDENTES HEREDOFAMILIARES MADRE -->
     <?php
     if(isset($resultados[2])){
            echo '<h2 style="padding-bottom: 6px; padding-top: 6px;">ANTECEDENTES HEREDOFAMILIARES MADRE </h2>';
        

            foreach($resultados[2] as $espoque):
            ?>
                <table class='result' style='padding-top: 1px; white-space:break-spaces; border-collapse: separate; border-spacing: 0 5px;'>
                <tbody>
                    <tr>
                        <td class="col-der" style="border-bottom: none; ">
                            <strong>
                                <?php echo $espoque->ANTECEDENTE; ?>
                            </strong>
                        </td>
                        <td class="col-izq" style="border-bottom: none">
                            <?php echo $espoque->RESPUESTA; ?>
                        </td>
                    </tr>
                    <?php if (isset($espoque->NOTAS)) { ?>
                        <tr>
                            <td class="col-der" style="text-align:justify;">
                                <strong>Nota: </strong> <?php echo $espoque->NOTAS; ?>
                            </td>
                            <td class="col-izq"></td>
                        </tr>
                    <?php           } ?>
                </tbody>
            </table>
                        <?php
            endforeach;       
         }
        ?>

    <div class="break"></div>
    <!-- ANTECEDENTES PERINATALES -->
     <?php
     if(isset($resultados[3])){
            echo '<h2 style="padding-bottom: 6px; padding-top: 6px;">ANTECEDENTES PERINATALES </h2>';
        

            foreach($resultados[3] as $espoque):
            ?>
                <table class='result' style='padding-top: 1px; white-space:break-spaces; border-collapse: separate; border-spacing: 0 5px;'>
                <tbody>
                    <tr>
                        <td class="col-der" style="border-bottom: none; ">
                            <strong>
                                <?php echo $espoque->ANTECEDENTE; ?>
                            </strong>
                        </td>
                        <td class="col-izq" style="border-bottom: none">
                            <?php echo $espoque->RESPUESTA; ?>
                        </td>
                    </tr>
                    <?php if (isset($espoque->NOTAS)) { ?>
                        <tr>
                            <td class="col-der" style="text-align:justify;">
                                <strong>Nota: </strong> <?php echo $espoque->NOTAS; ?>
                            </td>
                            <td class="col-izq"></td>
                        </tr>
                    <?php           } ?>
                </tbody>
            </table>
                        <?php
            endforeach;       
         }
        ?>
    <!-- DESARROLLO PSICOMOTOR -->
    <br>
     <?php
     if(isset($resultados[4])){
            echo '<h2 style="padding-bottom: 6px; padding-top: 6px;">DESARROLLO PSICOMOTOR</h2>';
        

            foreach($resultados[4] as $espoque):
            ?>
                <table class='result' style='padding-top: 1px; white-space:break-spaces; border-collapse: separate; border-spacing: 0 5px;'>
                <tbody>
                    <tr>
                        <td class="col-der" style="border-bottom: none; ">
                            <strong>
                                <?php echo $espoque->ANTECEDENTE; ?>
                            </strong>
                        </td>
                        <td class="col-izq" style="border-bottom: none">
                            <?php echo $espoque->RESPUESTA; ?>
                        </td>
                    </tr>
                    <?php if (isset($espoque->NOTAS)) { ?>
                        <tr>
                            <td class="col-der" style="text-align:justify;">
                                <strong>Nota: </strong> <?php echo $espoque->NOTAS; ?>
                            </td>
                            <td class="col-izq"></td>
                        </tr>
                    <?php           } ?>
                </tbody>
            </table>
                        <?php
            endforeach;       
         }
        ?>

           <!-- ANTECEDENTES PERSONALES NO PATOLOGICOS -->
    <br>
     <?php
     if(isset($resultados[5])){
            echo '<h2 style="padding-bottom: 6px; padding-top: 6px;">ANTECEDENTES PERSONALES NO PATOLÓGICOS</h2>';
        

            foreach($resultados[5] as $espoque):
            ?>
                <table class='result' style='padding-top: 1px; white-space:break-spaces; border-collapse: separate; border-spacing: 0 5px;'>
                <tbody>
                    <tr>
                        <td class="col-der" style="border-bottom: none; ">
                            <strong>
                                <?php echo $espoque->ANTECEDENTE; ?>
                            </strong>
                        </td>
                        <td class="col-izq" style="border-bottom: none">
                            <?php echo $espoque->RESPUESTA; ?>
                        </td>
                    </tr>
                    <?php if (isset($espoque->NOTAS)) { ?>
                        <tr>
                            <td class="col-der" style="text-align:justify;">
                                <strong>Nota: </strong> <?php echo $espoque->NOTAS; ?>
                            </td>
                            <td class="col-izq"></td>
                        </tr>
                    <?php           } ?>
                </tbody>
            </table>
                        <?php
            endforeach;       
         }
        ?>
           <!-- ANTECEDENTES PERSONALES PATOLOGICOS -->
    <div class="break"></div>
     <?php
     if(isset($resultados[6])){
            echo '<h2 style="padding-bottom: 6px; padding-top: 6px;">ANTECEDENTES PERSONALES PATOLÓGICOS</h2>';
        

            foreach($resultados[6] as $espoque):
            ?>
                <table class='result' style='padding-top: 1px; white-space:break-spaces; border-collapse: separate; border-spacing: 0 5px;'>
                <tbody>
                    <tr>
                        <td class="col-der" style="border-bottom: none; ">
                            <strong>
                                <?php echo $espoque->ANTECEDENTE; ?>
                            </strong>
                        </td>
                        <td class="col-izq" style="border-bottom: none">
                            <?php echo $espoque->RESPUESTA; ?>
                        </td>
                    </tr>
                    <?php if (isset($espoque->NOTAS)) { ?>
                        <tr>
                            <td class="col-der" style="text-align:justify;">
                                <strong>Nota: </strong> <?php echo $espoque->NOTAS; ?>
                            </td>
                            <td class="col-izq"></td>
                        </tr>
                    <?php           } ?>
                </tbody>
            </table>
                        <?php
            endforeach;       
         }
        ?>
            <!-- ALIMENTACIÓN -->
     <?php
     if(isset($resultados[7])){
            echo '<h2 style="padding-bottom: 6px; padding-top: 6px;">ALIMENTACIÓN</h2>';
        

            foreach($resultados[7] as $espoque):
            ?>
                <table class='result' style='padding-top: 1px; white-space:break-spaces; border-collapse: separate; border-spacing: 0 5px;'>
                <tbody>
                    <tr>
                        <td class="col-der" style="border-bottom: none; ">
                            <strong>
                                <?php echo $espoque->ANTECEDENTE; ?>
                            </strong>
                        </td>
                        <td class="col-izq" style="border-bottom: none">
                            <?php echo $espoque->RESPUESTA; ?>
                        </td>
                    </tr>
                    <?php if (isset($espoque->NOTAS)) { ?>
                        <tr>
                            <td class="col-der" style="text-align:justify;">
                                <strong>Nota: </strong> <?php echo $espoque->NOTAS; ?>
                            </td>
                            <td class="col-izq"></td>
                        </tr>
                    <?php           } ?>
                </tbody>
            </table>
                        <?php
            endforeach;       
         }
        ?>
            <!-- DENTICIÓN -->
     <?php
     if(isset($resultados[8])){
            echo '<h2 style="padding-bottom: 6px; padding-top: 6px;">DENTICIÓN</h2>';
        

            foreach($resultados[8] as $espoque):
            ?>
                <table class='result' style='padding-top: 1px; white-space:break-spaces; border-collapse: separate; border-spacing: 0 5px;'>
                <tbody>
                    <tr>
                        <td class="col-der" style="border-bottom: none; ">
                            <strong>
                                <?php echo $espoque->ANTECEDENTE; ?>
                            </strong>
                        </td>
                        <td class="col-izq" style="border-bottom: none">
                            <?php echo $espoque->RESPUESTA; ?>
                        </td>
                    </tr>
                    <?php if (isset($espoque->NOTAS)) { ?>
                        <tr>
                            <td class="col-der" style="text-align:justify;">
                                <strong>Nota: </strong> <?php echo $espoque->NOTAS; ?>
                            </td>
                            <td class="col-izq"></td>
                        </tr>
                    <?php           } ?>
                </tbody>
            </table>
                        <?php
            endforeach;       
         }
        ?>
    </div>
</body>



</html>