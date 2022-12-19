<html>
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet"> 
        <style>
            @page { 
                margin: 165px 10px; 
            }
            
            body{
                font-family: 'Noto Sans', sans-serif;
                margin-top: 60px;
                font-size: 10px;
            }

            #image {
                top: -155px;
                position: fixed;
                height: 120px;
                width: 80px;
                z-index: -9999;
                
                background-image: url({{$membrete}});
                background-repeat: no-repeat;
                background-size: 100%;
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
        $ruta = file_get_contents('../pdf/public/assets/logotipo.png');
        $encode = base64_encode($ruta);

        // Para la firma se requiere mandar la "firma" tambien en base 64 e incrustarlo como en el ejemplo de arriba,
        //los datos de abajo son meramente informativos y solo sirven para rellenar la informacion del documento
        // echo '<img src="data:image/png;base64, '. $img_valido .'" alt="" height="75" >';
        
        // path firma
        $ruta_firma = file_get_contents('http://bimo-lab.com/pdf/logo/firma.png');
        $encode_firma = base64_encode($ruta_firma);

    ?>
    <body>
        <div id="image">
        </div>
        <!-- header -->
        <div class="header">
            <br><br>
            
            <table>
                <tbody>
                    <tr>
                        <td class="col-der"  style="border-bottom: none">
                            <h4>
                                DIAGNOSTICO BIOMOLECULAR <br>
                                Laboratorio Clínico <br>
                                Resultados de Exámenes
                            </h4>
                        </td>
                        <td class="col-izq"  style="border-bottom: none; text-align:center;">
                            <?php echo "<img src='data:image/png;base64, ". $encode . "' height='75' > " ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table >
                <tbody>
                    <tr>
                        <td style="text-align: center; border-style: solid none solid none; ">
                            <h3>
                                Laboratorio Clinico
                            </h3>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                    <tr>
                        <td class="col-left"  style="border-bottom: none">
                            No. Identificacion: <strong> <?php echo $encabezado->FOLIO;?> </strong> 
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
            <?php
                $areas = $resultados->areas;
                $count = count($areas);
                $i = 0;
                foreach ($areas as $key => $area) {

                    echo "<h2  >". $area->area . "</h2>";

                    foreach ($area->estudios as $key => $estudio) {
                        echo "<h5>" . $estudio->estudio . "</h5>";
            ?>
                    <table class="result" >
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
                                if(is_array($analito)){
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
                                        <tr style="text-indent: 5px;" >
                                            <td class="col-one">
                                                <?php echo ($absoluto->analito != null) ? $absoluto->analito : '' ;  ?>
                                            </td>
                                            <td class="col-two">
                                                <?php echo ($absoluto->valor_abosluto != null) ? $absoluto->valor_abosluto : '' ; ?>
                                            </td>
                                            <td class="col-three">
                                                <?php echo ($absoluto->unidad != null) ? $absoluto->unidad : '' ; ?>

                                            </td>
                                            <td class="col-four">
                                                <?php echo ($absoluto->referencia != null) ? $absoluto->referencia : '' ; ?>

                                            </td>
                                        </tr>
                            <?php
                                    }
                                }else{
                            ?>
                                <tr >
                                    <td class="col-one">
                                        <?php echo ($analito->nombre != null) ? $analito->nombre : '' ;  ?>
                                    </td>
                                    <td class="col-two">
                                        <?php echo ($analito->resultado != null) ? $analito->resultado : '' ; ?>
                                    </td>
                                    <td class="col-three">
                                        <?php echo ($analito->unidad != null) ? $analito->unidad : '' ; ?>
                                    </td>
                                    <td class="col-four">
                                        <?php echo ($analito->referencia != null) ? $analito->referencia : '' ; ?>
                                    </td>
                                </tr>
                            <?php
                                    if(isset($analito->observaciones) && $analito->observaciones != null || $analito->observaciones != '' ){
                            ?>
                                        <tr>
                                            <td class="col-one">
                                                <?php echo "<strong>Observaciones: </strong>" .$analito->observaciones ?>
                                            </td>
                                            <td class="col-two">
                                            </td>
                                            <td class="col-three">
                                            </td>
                                            <td class="col-four">
                                            </td>
                                        </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                            

                        </tbody>
                    </table>
                    <div >
                        
                        <?php
                            if(isset($estudio->metodo)){
                                echo "<strong>Método: </strong>". $estudio->metodo;
                            }else{
                            }
                        ?>
                    </div>
                    <div >
                        
                        <?php
                            if(isset($estudio->equipo)){
                                echo "<strong>Equipo: </strong>" .$estudio->equipo;
                            }else{
                            }
                        ?>
                    </div>
                    <div >
                        
                        <?php
                            if($estudio->observaciones != '' || $estudio->observaciones != null){
                                echo "<strong>Observaciones: </strong>". $estudio->observaciones;
                            }else{
                            }
                        ?>
                    </div>
                    <br>
            <?php
                    }
                    $i++;
                    if ($i < $count) {  
                        echo '<div class="break"></div>';
                    }
                }
            ?>
        </div>
    </body>
</html>
