                <head>
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
                            margin-top: 60px;
                            margin-bottom: 20px;
                            font-size: 10px;
                            /* background-color: gray; */
                        }

                        .header {
                            position: fixed;
                            top: -171px;
                            left: 25px;
                            right: 25px;
                            height: 220px;
                            margin-top: 0;
                            /* background-color: moccasin; */
                        }

                        .footer {
                            position: fixed;
                            bottom: -220px;
                            left: 25px;
                            right: 25px;
                            height: 250px;
                            /* background-color: moccasin; */
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
                            padding-bottom: 5px;
                            padding-right: 30px;
                            padding-left: 30px;
                            padding-top: 10px;
                            text-align: justify;
                            text-justify: inter-word;
                        }


                        h1 {
                            font-size: 18px;
                            margin-top: 2px;
                            margin-bottom: 2px;
                        }

                        h2 {
                            font-size: 16px;
                            margin-top: 2px;
                            margin-bottom: 2px;
                            text-align: center;
                            background-color: rgba(215, 222, 228, 0.748);
                            padding-top: 10px;
                        }

                        h3 {
                            font-size: 14px;
                            margin-top: 2px;
                            margin-bottom: 2px;
                        }

                        h4 {
                            font-size: 12px;
                            margin-top: 2px;
                            margin-bottom: 2px;
                        }

                        h5 {
                            font-size: 10.5px;
                            margin-top: 2px;
                            margin-bottom: 2px;
                        }

                        p {
                            font-size: 12px;
                        }

                        strong {
                            font-size: 12px;
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
                            table-layout: fixed;
                            /* border: 1px solid; */
                        }

                        /* Para divisiones de 3 encabezado*/
                        .col-left {
                            width: 53%;
                            max-width: 53%;
                            text-align: left;
                            font-size: 11px;
                            margin-left: 2px;
                        }

                        .col-center {
                            width: 30%;
                            max-width: 30%;
                            text-align: left;
                            font-size: 11px;
                            margin-left: 2px;
                        }

                        .col-right {
                            width: 17%;
                            max-width: 17%;
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
                            text-align: left;
                        }

                        .col-der {
                            width: 70%;
                            max-width: 70%;
                            text-align: center;
                        }

                        /* Fivisiones de cinco */
                        .col-one {
                            width: 30%;
                            max-width: 100px;
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

                        .fontSize10{
                            font-size: 10px;
                        }
                    </style>
                </head>

                <?php

                function text_bold($string)
                {
                    $nombre_bold = ['N/A'];

                    foreach ($nombre_bold as $string_search) {
                        return $valor_ct = strpos($string, $string_search) !== false;
                    }
                }


                // para el path del logo 
                $ruta = file_get_contents('../pdf/public/assets/icono_reporte.png');
                $encode = base64_encode($ruta);

                // Para la firma se requiere mandar la "firma" tambien en base 64 e incrustarlo como en el ejemplo de arriba,
                //los datos de abajo son meramente informativos y solo sirven para rellenar la informacion del documento
                // echo '<img src="data:image/png;base64, '. $img_valido .'" alt="" height="75" >';

                // path firma
                $ruta_firma = file_get_contents('https://bimo-lab.com/nuevo_checkup/pdf/public/assets/firma_marleny_marin.png');
                $encode_firma = base64_encode($ruta_firma);
                ?>

                <body>
                    <!-- header -->
                    <div class="header">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="col-der" style="border-bottom: none">
                                        <h4>
                                            DIAGNOSTICO BIOMOLECULAR S.A.de C.V. <br>
                                            Laboratorio de Análisis Clínicos <br>
                                            Resultado de Exámenes
                                        </h4>
                                    </td>
                                    <td class="col-izq" style="border-bottom: none; text-align:center;">
                                        <?php
                                        echo "<img src='data:image/png;base64, " . $encode . "' height='75' >";
                                        // echo "<img src='data:image/png;base64," . $barcode . "' height='75'>";
                                        ?>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                                <tr>
                                    <td style="text-align: center; border-style: solid none solid none; ">
                                        <h3>
                                            Laboratorio de Análisis Clínicos
                                        </h3>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="col-left" style="border-bottom: none">
                                        No. Identificación: <strong style="font-size: 12px;"> <?php echo $encabezado->FOLIO; ?> </strong>
                                    </td>
                                    <td class="col-center" style="border-bottom: none">
                                        Edad: <strong style="font-size: 12px;"> <?php echo $encabezado->EDAD; ?></strong>
                                    </td>
                                    <td class="col-right" style="border-bottom: none">
                                        Sexo: <strong style="font-size: 12px;"><?php echo $encabezado->SEXO; ?> </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-left" style="border-bottom: none">
                                        Nombre: <strong style="font-size: 12px;"> <?php echo $encabezado->NOMBRE; ?> </strong>
                                    </td>
                                    <td class="col-center" style="border-bottom: none">
                                        Fecha de Nacimiento: <strong style="font-size: 12px;"> <?php echo $encabezado->NACIMIENTO; ?> </strong>
                                    </td>
                                    <td class="col-right" style="border-bottom: none">
                                        Pasaporte: <strong style='font-size:12px'> <?php echo (isset($encabezado->PASAPORTE) && !empty($encabezado->PASAPORTE)) ? $encabezado->PASAPORTE : "SD"; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-left" style="border-bottom: none">
                                        Fecha de Toma de Muestra: <strong style="font-size: 12px;"> <?php echo $encabezado->FECHA_TOMA; ?> </strong>
                                    </td>
                                    <td class="col-center" style="border-bottom: none">
                                        Fecha de Resultado: <strong style="font-size: 10.3px;"><?php echo $encabezado->FECHA_RESULTADO; ?> </strong>
                                    </td>
                                    <td class="col-right" style="border-bottom: none">
                                        <!-- Tipo de Muestra: <strong>Sangre</strong> -->
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-left" style="border-bottom: none">
                                    </td>
                                    <td class="col-center" style="border-bottom:none">

                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <p style="font-size: 12px; padding-left: 3.5px; margin: -1px;">
                            <?php echo "Procedencia: <strong style='font-size: 12px;'> $encabezado->PROCEDENCIA"; ?> </strong>

                            <?php if ($encabezado->PAQUETE_CARGADO) { ?>
                                <span style="margin-left: 20px;">
                                    <!-- Tipo de muestra  -->
                                    <?php echo "Paquete: <strong style='font-size: 12px;'> $encabezado->PAQUETE_CARGADO"; ?> </strong>
                                </span>
                            <?php } ?>

                            <?php if ($encabezado->CATEGORIA) { ?>
                                <span style="margin-left: 20px;">
                                    <!-- Tipo de muestra  -->
                                    <?php echo "Categoría: <strong style='font-size: 12px;'> $encabezado->CATEGORIA"; ?> </strong>
                                </span>
                            <?php } ?>
                        </p>
                        <p style="font-size: 12px; padding-left: 3.5px; margin: -1px; margin-top: 5px">
                            <?php echo (isset($encabezado->MEDICO_TRATANTE) || !empty($encabezado->MEDICO_TRATANTE)) ? "Médico Tratante: <strong style='font-size: 13px;'>" . $encabezado->MEDICO_TRATANTE . "</strong>" : ""; ?> </strong>
                        </p>
                        <hr style="text-align: center; border-style: solid none solid none; width: 100%; ">
                    </div>

                    <div class="footer">
                        <!-- lo tenia directo y se cambio al footer 1 -->
                        <!-- Footer 1 chido -->
                        <?php
                        $footerDoctor = 'Q.F.B. MARLENY MARÍN HERNÁNDEZ <br>UPCH - Cédula profesional: 10599625';
                        include "includes/footer.php"; ?>
                    </div>

                    <!-- body -->
                    <div class="invoice-content">
                        <?php
                        $areas = $resultados->areas;
                        $count = count($areas);
                        $i = 0;
                        foreach ($areas as $key => $area) {
                            $a = 0;

                            echo "<h2 style='padding-bottom: 5px; padding-top: 5px;'>" . $area->area . "</h2>";

                            foreach ($area->estudios as $key => $estudio) {

                                echo "<h4 style='padding-top: 9px'>" . $estudio->estudio . "</h4>";

                                // IMPRIMIR TABLA DE VALORES DE REFERENCIAS PARA ESTUDIOS ESPECIALES./
                                if($estudio->estudio == "PERIL DE ALERGIA INHALATORIO (40 ELEMENTOS)"
                                    || $estudio->estudio == "PERFIL ALERGIA ALIMENTICIO (40 ELEMENTOS)"){
                                    echo '
                                        <div style="text-align: right;">
                                            <div style="display: inline-block">
                                            <table style="border-collapse: collapse; width: auto;">
                                                <tr>
                                                    <th colspan="2" style="text-align: center; padding: 8px; font-weight: bold;">Valores de referencia</th>
                                                </tr>
                                                <tr>
                                                    <td style="">&lt; 0.10</td>
                                                    <td style="">Clase 0 Ausencia o indetectable</td>
                                                </tr>
                                                <tr>
                                                    <td style="">0.11 - 0.24</td>
                                                    <td style="">Clase I/0 Muy bajo</td>
                                                </tr>
                                                <tr>
                                                    <td style="">0.25 - 0.39</td>
                                                    <td style="">Clase I Bajo</td>
                                                </tr>
                                                <tr>
                                                    <td style="">0.40 - 1.29</td>
                                                    <td style="">Clase II Moderado</td>
                                                </tr>
                                                <tr>
                                                    <td style="">1.30 - 3.89</td>
                                                    <td style="">Clase III Alto</td>
                                                </tr>
                                                <tr>
                                                    <td style="">3.90 - 14.99</td>
                                                    <td style="">Clase IV Muy alto</td>
                                                </tr>
                                                <tr>
                                                    <td style="">15.00 - 24.99</td>
                                                    <td style="">Clase V Muy alto</td>
                                                </tr>
                                                <tr>
                                                    <td style="">&gt; 25.00</td>
                                                    <td style="">Clase VI Muy alto</td>
                                                </tr>
                                            </table>
                                            </div>
                                        </div>
                                        ';
                                }

                        ?>
                                <table class="result" style="padding-top: 1px;">
                                    <thead>
                                        <tr>
                                            <th class="col-one">Nombre</th>
                                            <th class="col-two">Resultado</th>
                                            <th class="col-three">Unidad</th>
                                            <th class="col-four">Referencia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($estudio->analitos as $key => $analito) {
                                            $a++;
                                            if (is_array($analito)) {
                                        ?>
                                                <tr>
                                                    <td class="col-one">
                                                        <strong>Valores absolutos</strong>
                                                    </td>
                                                    <td class="col-two">
                                                    </td>
                                                    <td class="col-three">
                                                    </td>
                                                    <td class="col-four">
                                                    </td>
                                                </tr>
                                                <?php
                                                foreach ($analito as $b => $absoluto) {
                                                ?>
                                                    <tr style="text-indent: 5px;">
                                                        <td class="col-one">
                                                            <?php echo ($absoluto->analito != null) ? $absoluto->analito : '';  ?>
                                                        </td>
                                                        <td class="col-two">
                                                            <?php echo ($absoluto->valor_abosluto != null) ? $absoluto->valor_abosluto : ''; ?>
                                                        </td>
                                                        <td class="col-three">
                                                            <?php echo ($absoluto->unidad != null) ? $absoluto->unidad : ''; ?>
                                                        </td>
                                                        <td class="col-four fontSize10">
                                                            <?php echo ($absoluto->referencia != null) ? $absoluto->referencia : ''; ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <?php
                                                    if (
                                                        text_bold($analito->resultado)
                                                    ) {
                                                    } else {
                                                    ?>
                                                        <td class="col-one">
                                                            <?php #var_dump($analito->resultado);
                                                            echo ($analito->nombre != null) ? $analito->nombre : '';  ?>
                                                        </td>
                                                        <td class="col-two">
                                                            <?php echo ($analito->resultado != null) ? $analito->resultado : ''; ?>
                                                        </td>
                                                        <td class="col-three">
                                                            <?php echo ($analito->unidad != null) ? $analito->unidad : ''; ?>
                                                        </td>
                                                        <td class="col-four fontSize10">
                                                            <?php echo ($analito->referencia != null) ? $analito->referencia : ''; ?>
                                                        </td>
                                                    <?php
                                                    }
                                                    ?>
                                                </tr>
                                                <?php
                                                if (isset($analito->metodo) && $analito->metodo != null || $analito->metodo != '') {
                                                ?>
                                                    <tr>
                                                        <td class="col-one" style="font-size: 12px" colspan="4">
                                                            <?php echo "<strong style='font-size: 12px'>Método: </strong>" . $analito->metodo ?>
                                                        </td>
                                                        <!-- aqui modifique para ampliar la linea -->
                                                        <!-- <td class="col-two">
                                                        </td>
                                                        <td class="col-three">
                                                        </td>
                                                        <td class="col-four">
                                                        </td> -->
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                                <?php

                                                if (isset($analito->equipo) && $analito->equipo != null || $analito->equipo != '') {
                                                ?>
                                                    <tr>
                                                        <td class="col-one" style="font-size: 12px" colspan="4">
                                                            <?php echo "<strong style='font-size: 12px'>Equipo: </strong>" . $analito->equipo ?>
                                                        </td>
                                                        <!-- aqui modifique para ampliar la linea -->
                                                        <!-- <td class="col-two">
                                                        </td>
                                                        <td class="col-three">
                                                        </td>
                                                        <td class="col-four">
                                                        </td> -->
                                                    </tr>
                                                <?php
                                                }

                                                if (isset($analito->observaciones) && $analito->observaciones != null || $analito->observaciones != '') {
                                                ?>
                                                    <tr>
                                                        <td class="col-one" style="font-size: 12px" colspan="4">
                                                            <?php echo "<strong style='font-size: 12px'>Observaciones:" . $analito->observaciones . " </strong>"; ?>
                                                        </td>
                                                        <!-- aqui modifique para ampliar la linea -->
                                                        <!-- <td class="col-two">
                                                        </td>
                                                        <td class="col-three">
                                                        </td>
                                                        <td class="col-four">
                                                        </td> -->
                                                    </tr>
                                        <?php
                                                }

                                                if ($estudio->estudio == 'OTROS SERVICIOS') {
                                                    echo "<br>";
                                                }
                                            }
                                        }
                                        ?>


                                    </tbody>
                                </table>
                                <div style="font-size: 12px">

                                    <?php
                                    if ($estudio->metodo == '' || $estudio->metodo == null) {
                                    } else {
                                        echo "<strong style='font-size: 12px'>Método: </strong>" . $estudio->metodo;
                                    }
                                    ?>
                                </div>
                                <div style="font-size: 12px">

                                    <?php
                                    if ($estudio->equipo == '' || $estudio->equipo == null) {
                                    } else {
                                        echo "<strong style='font-size: 12px'>Equipo: </strong>" . $estudio->equipo;
                                    }
                                    ?>
                                </div>
                                <div style="font-size: 12px">

                                    <?php
                                    if ($estudio->observaciones == '' || $estudio->observaciones == null) {
                                    } else {
                                        echo "<strong style='font-size: 12px'>Observaciones:" . $estudio->observaciones . "</strong>";
                                    }
                                    ?>
                                </div>
                                <?php

                            }
                            $i++;
                            // $color_count % 2 == 0
                            // $a < 15
                            // if($a < 15){
                            // }

                            // if ($i < $count) {  
                            //     echo '<div class="break"></div>';
                            // }

                            // echo $a;
                            if ($a <= 15) {
                            } else {
                                if ($i < $count) {

                                    // echo "salto de linea";
                                ?>
                                    <!-- comente este linea para evitar las hojas en blanco -->
                                    <div class="break"></div>
                            <?php
                                }
                                // echo '<div class="break">';
                            }
                            ?>

                        <?php
                        }
                        ?>
                    </div>
                </body>

                </html>