<html>
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <!-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">  -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
        
        <style>
            @page { 
                margin: 165px 10px; 
            }
            
            body{
                font-family: 'Roboto', sans-serif;
                margin-top: 60px;
                font-size: 10px;
            }
            
            .header { 
                position: fixed; 
                top: -165px;
                left: 25px; 
                right: 25px; 
                height: 220px; 
                margin-top: 0; /*-30px*/
            }

            .footer { 
                position: fixed; 
                bottom: -165px; 
                left: 25px; 
                right: 25px; 
                height: 190px; 
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

            
            h1{
                font-size: 18px;
                margin-top: 2px;
                margin-bottom: 2px;
            }
            h2{
                font-size: 16px;
                margin-top: 2px;
                margin-bottom: 2px;
                text-align: center;
                background-color: rgba(215, 222, 228, 0.748);
                padding-top: 10px;
            }

            h3{
                font-size: 14px;
                margin-top: 2px;
                margin-bottom: 2px;
            }
            h4{
                font-size: 12px;
                margin-top: 2px;
                margin-bottom: 2px;
            }
            h5{
                font-size:  10.5px;
                margin-top: 2px;
                margin-bottom: 2px;
            }

            p{
                font-size: 12px;
            }

            strong{
                font-size: 12px;
            }
            
            .align-center{
                text-align: center;
            }
            
            table{
                width: 100%;
                max-width: 100%;
                margin: auto;
                white-space:nowrap;
                /* table-layout:fixed; */
            }
            th, td {
                width: 100%;
                max-width: 100%;
                word-break: break-all;
            }

            /* Para divisiones de 3 encabezado*/
            .col-left{
                width: 35%; 
                max-width: 35%; 
                text-align: left;
                font-size: 12px;
            }
            .col-center{
                width: 35%; 
                max-width: 35%; 
                text-align: left;
                font-size: 12px;
            }
            .col-right{
                width: 30%; 
                max-width: 30%; 
                text-align: left;
                font-size: 12px;
            }

            /* divisiones de 3 footer */
            .col-foot-one{
                width: 30%; 
                max-width: 30%; 
                text-align: left;
                font-size: 12px;
            }
            .col-foot-two{
                width: 40%; 
                max-width: 40%; 
                text-align: center;
                font-size: 12px;
            }
            .col-foot-three{
                width: 30%; 
                max-width: 30%; 
                text-align: right;
                font-size: 12px;
            }

            /* Para divisiones de 4 */
            .result{
                font-size:12px
            }

            /* diviciones de 2 */
            .col-izq{
                width: 30%; 
                max-width: 30%; 
                text-align: left;
            }
            .col-der{
                width: 70%; 
                max-width: 70%; 
                text-align: center;
            }

            /* Fivisiones de cinco */
            .col-one{
                width: 30%; 
                max-width: 30%; 
                text-align: left;
            }
            .col-two{
                width: 20%; 
                max-width: 20%; 
                text-align: right;
            }
            .col-three{
                width: 25%; 
                max-width: 25%; 
                text-align: center;
                
            }
            .col-four{
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
        $ruta_firma = file_get_contents('http://bimo-lab.com/pdf/logo/firma.png');
        $encode_firma = base64_encode($ruta_firma);

    ?>
    <body>
        <!-- header -->
        <div class="header">
            <br><br>
            
            <table>
                <tbody>
                    <tr>
                        <td class="col-der"  style="border-bottom: none">
                            <h4>
                                DIAGNOSTICO BIOMOLECULAR S.A.de C.V. <br>
                                Clínica Checkup <br>
                                Reporte de oftamologia
                            </h4>
                        </td>
                        <td class="col-izq"  style="border-bottom: none; text-align:center;">
                            <?php
                                echo "<img src='data:image/png;base64, ". $encode . "' height='75' >";
                                // echo "<img src='data:image/png;base64," . $barcode . "' height='75'>";
                            ?>

                        </td>
                    </tr>
                </tbody>
            </table>
            <table >
                <tbody>
                    <tr>
                        <td style="text-align: center; border-style: solid none solid none; ">
                            <h3>
                                Datos del paciente
                            </h3>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                    <tr>
                        <td class="col-left"  style="border-bottom: none">
                            No. Identificación: <strong> <?php echo $encabezado->FOLIO;?> </strong> 
                        </td>
                        <td class="col-center"  style="border-bottom: none">
                            Edad: <strong> <?php echo $encabezado->EDAD;?> años</strong> 
                        </td>
                        <td class="col-right"  style="border-bottom: none">
                            Sexo: <strong><?php echo $encabezado->SEXO;?> </strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-left"  style="border-bottom: none">
                            Nombre: <strong> <?php echo $encabezado->NOMBRE;?> </strong>  
                        </td>
                        <td class="col-center"  style="border-bottom: none">
                        <!-- style="font-size: 12px;" -->
                            Fecha de Nacimiento: <strong> <?php echo $encabezado->NACIMIENTO;?> </strong>
                        </td>
                        <td class="col-right"  style="border-bottom: none">
                            <?php echo (isset($encabezado->PASAPORTE)) ? "Pasaporte: <strong>".$encabezado->PASAPORTE."</strong>" : ""; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-left"  style="border-bottom: none">
                            Fecha de Toma de Muestra: <strong>  <?php echo $encabezado->FECHA_TOMA;?>  </strong>
                        </td>
                        <td class="col-center"  style="border-bottom: none">
                            Fecha de Resultado:     <strong><?php echo $encabezado->FECHA_RESULTADO;?> </strong>
                        </td>
                        <td class="col-right"  style="border-bottom: none">
                            <!-- Tipo de Muestra: <strong>Sangre</strong> -->
                        </td>
                    </tr>
                    <tr>
                        <td class="col-left"  style="border-bottom: none">
                            Procedencia: <strong><?php echo $encabezado->PROCEDENCIA;?> </strong>
                        </td>
                        <td class="col-center"  style="border-bottom: none">
                            <?php echo (isset($encabezado->MEDICO_TRATANTE)) ? "Médico Tratante: <strong>". $encabezado->MEDICO_TRATANTE . "</strong>" : "" ;?> 
                        </td>
                        <td class="col-right"  style="border-bottom: none">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="footer">
            <table>
                <tbody>
                    <tr class="col-foot-one">
                        <td colspan="12" style="text-align: right; padding-right: 0;"><strong>Atentamente</strong></td>
                    </tr>
                    <tr class="col-foot-two" >
                        <td colspan="10">
                        </td>
                        <td colspan="2" style="text-align: left;">
                            <?php echo "<img style='position:absolute; right:25px; margin-top: -15px ' src='data:image/png;base64, " . $encode_firma . "' height='80px'> " ?>
                        </td>
                    </tr>
                    <tr class="col-foot-three"  style="font-size: 13px;">
                        <td colspan="6" style="text-align: center; width: 50%">
                            <a target="_blank" href="#"> <img src='<?= $qr[1] ?>' alt='QR Code' width='110' height='110'> </a>
                        </td>
                        <td colspan="6" style="text-align: right; width: 50%; padding-top: 30px; margin-bottom: -25px">
                            <strong >Q.F.B. NERY FABIOLA ORNELAS RESENDIZ    <br>UPCH - Cédula profesional: 09291445</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr style="margin-top: -20px; height: 0.5px; background-color: black ;">
            <p style="text-align: center;"><small><strong>Avenidad Universidad S/N Colonia Casa Blanca, Villahermosa, Tabasco - Teléfono: 993 131 00 42 Correo electrónico: biologia.molecular@hguadalupe.com</strong></small></p>
        </div> 

        <!--  <div class="footer">
            <table>
                <tbody>
                    <tr class="col-foot-one">
                        <td colspan="12" style="text-align: center; padding-right: 0;"><strong>Atentamente</strong></td>
                    </tr>
                    <tr class="col-foot-two" >
                        <td colspan="3" style="text-align: center; ">
                            <a target="_blank" href="<?php echo $qr[0]; ?>"> <img style="margin-bottom: -30px" src='<?= $qr[1] ?>' alt='QR Code' width='110' height='110'> </a>
                        </td>
                        <td colspan="3" style="text-align: left;">
                            <?php echo "<img style='position:absolute;' src='data:image/png;base64, " . $encode_firma . "' height='80px'> " ?>
                        </td>
                    </tr>
                    <tr class="col-foot-three"  style="font-size: 13px;">
                        <td colspan="12" style="text-align: center; width: 50%; ">
                            <strong >Q.F.B. NERY FABIOLA ORNELAS RESENDIZ    <br>UPCH - Cédula profesional: 09291445</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr style="margin-top: 0px; height: 0.5px; background-color: black ;">
            <p style="text-align: center; margin-top: 0px"><small><strong>Avenida José Pagés Llergo No. 150  Interior 1, Colonia Arboledas, Villahermosa Tabasco, C.P. 86079, Teléfono: 993 131 00 42 
            Correo electrónico: hola@bimo.com.mx</strong></small></p>
        </div>-->



        <!-- body -->
        <div class="invoice-content">
            <p>
                ANTECEDENTES PERSONALES <br>
                NEGADOS <br>
            </p>
            <p>
                ANTECEDENTES OFTALMOLOGICOS <br>
                PTERIGION NASAL OJO IZQUIERDO <br>
                
            </p>
            <p>
                PADECIMIENTO ACTUAL. <br>
                ASINTOMATICA <br>
                
            </p>
            <p>
                AGUDEZA VISUAL SIN CORRECCIÓN: TABLA DE SNELLEN <br>
                OD: 20/20 <br>
                OI: 20/20 <br>
                JAEGER 1:20/20 VISIÓN CERCANA SIN CORRECCIÓN TARJETA DE ROSENBÁUM  <br>
            </p>
            <p>
                REFRACCIÓN: <br>
                <strong> 
                    NO AMERIA DE CORRECCIÓN OPTICA
                </strong> 
            </p>
            <p>
                PRUEBA CROMATICA NORMAL CON PRUEBA DE ISHIHARA
                
            </p>
            <p>
                EXPLORACIÓN OFTALMOLOGICA: <br>
                ANEXOS OCULARES NORMALES SEGMENTO ANTERIOR CONJUNTIVA PTERIGION NASAL OJO IZQUIERDO, CORNEA, IRIS, CRISTALINO, SIN ALTERACIONES. SEGMENTO POSTERIOR VITREO, NERVIO OPTICO, MACULA SIN ALTERACIONES.

            </p>
            <p>

                FORIAS NO PRESENTES
               
            </p>
            <p>
                CAMPIMETRtA POR CONFRONTACION NORMAL.
                
            </p>
            <p>
                PRESION INTRAOCULAR. <br>
                OD: 10 MMHG
                OI: 10 MMHG
                
            </p>
            <p>
                DIAGNOSTICO. <br>
                VALORACION VISUAL NORMAL + PTERIGION NASAL OJO IZQUIERDO NO INVOLUCRO EJE VISUAL
                
            </p>
            <p>
                PLAN: <br>
                OBSERVACION ANUAL
            </p>
        </div>
    </body>
</html>
