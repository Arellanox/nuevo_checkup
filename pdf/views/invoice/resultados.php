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
                /* line-height: 1; */
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
                /* background-color: orange; */
            }

            .footer { 
                position: fixed; 
                bottom: -165px; 
                left: 25px; 
                right: 25px; 
                height: 165px; 
                /* background-color: blue; */
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

            /* .separador-bottom{
                border-style: none none solid none;
                border-style: none none none none;
            } */
            
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
            }
            th, td {
                /* border-bottom: 1px solid #ddd; */
                width: 100%;
                max-width: 100%;
                word-break: break-all;
            }

            /* Para divisiones de 3 encabezado*/
            .col-left{
                width: 30%; 
                max-width: 30%; 
                text-align: left;
                font-size: 12px;
            }
            .col-center{
                width: 40%; 
                max-width: 40%; 
                text-align: center;
                font-size: 12px;
            }
            .col-right{
                width: 30%; 
                max-width: 30%; 
                text-align: right;
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
                width: 25%; 
                max-width: 25%; 
                text-align: left;
            }
            .col-two{
                width: 25%; 
                max-width: 25%; 
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

        // Para el path del qr, esta imagen la debo recibir en base64, dentro del response que se me manda
        // para solo anexarlo aqui al ejemplo de abajo
            // echo '<img src="data:image/png;base64, '. $img_valido .'" alt="" height="75" >';
        // Para la firma se requiere mandar la "firma" tambien en base 64 e incrustarlo como en el ejemplo de arriba,
        //los datos de abajo son meramente informativos y solo sirven para rellenar la informacion del documento
        
        //path qr
        $ruta_qr = file_get_contents('../pdf/public/assets/qr.jpeg');
        $encode_qr = base64_encode($ruta_qr);

        // path firma
        $ruta_firma = file_get_contents('../pdf/public/assets/firma.png');
        $encode_firma = base64_encode($ruta_firma);

    ?>
    <body>
        
    <!-- header -->
    <div class="header">
        <br><br>
        
        <table>
            <tbody>
                <tr>
                    <td class="col-izq"  style="border-bottom: none; text-align:center;">
                    <?php echo "<img src='data:image/png;base64, ". $encode . "' height='75' > " ?>
                    </td>
                    <td class="col-der"  style="border-bottom: none">
                        <h4>
                            Hospital Nuestra Señora de Guadalupe <br>
                            Resultados de exámenes
                        </h4>
                    </td>
                </tr>
            </tbody>
        </table>
        <table >
            <tbody>
                <tr>
                    <td style="text-align: center; border-style: solid none solid none; ">
                        <h3>
                            Laboratorio Clínico
                        </h3>
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <tbody>
                <tr>
                    <td class="col-left"  style="border-bottom: none">
                    No. identificacion: 
                    63
                    </td>
                    <td class="col-center"  style="border-bottom: none">
                    Sexo:
                    Masculino
                    </td>
                    <td class="col-right"  style="border-bottom: none">
                    Edad:
                    99
                    </td>
                </tr>
                <tr>
                    <td class="col-left"  style="border-bottom: none">
                    Nombre:
                    Pedro Pascal
                    </td>
                    <td class="col-center"  style="border-bottom: none">
                    Fecha de toma:
                    07-12-2022
                    </td>
                    <td class="col-right"  style="border-bottom: none">
                    Fecha de resultado:
                    08-12-2022
                    </td>
                </tr>
                <tr>
                    <td class="col-left"  style="border-bottom: none">
                    Fecha nacimiento:
                    01-01-1923
                    </td>
                    <td class="col-center"  style="border-bottom: none">
                    Procedencia:
                    Republica de Yucatán
                    </td>
                    <td class="col-right"  style="border-bottom: none">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    

    <!-- footer -->
    <div class="footer">
        <table style="line-height: 0.5;">
            <tr >
                <td class="col-foot-one" style="border-bottom: none;">
                    <p>
                        <?php echo "<img src='data:image/jpeg;base64, ". $encode_qr . "' height='125px' width:'125px' > " ?>
                    </p>
                    <p>
                    </p>
                    <p>
                    </p>
                </td>
                <td class="col-foot-two" style="border-bottom: none; text-align: center; text-justify: inter-word;">
                    <p>
                        <!-- Fimra -->
                        <?php echo "<img src='data:image/png;base64, ". $encode_firma . "' height='100px' > " ?>
                    </p>
                    <p> 
                        <!-- valida -->
                        Q. F. B Emperatriz Vazquez Torrusco
                    </p>
                    <p>
                    </p>
                    <p>
                    </p> 
                </td>
                <td class="col-foot-three" style="border-bottom: none;">
                    <p>
                        Fecha de impresión: 
                        <?php echo date('d/m/Y') ?>
                    </p> 

                    <p class="page">Página </p>
                </td>
            </tr>
        </table>
        <br>
        <br>
        <br>
    </div>


    <!-- body -->
    <div class="invoice-content">
        <?php
            $areas = $data->areas;
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
                        ?>
                            <tr >
                                <td class="col-one">
                                    <?php echo $analito->nombre ; ?>
                                </td>
                                <td class="col-two">
                                    <?php echo ($analito->resultado != null) ? $analito->resultado : '' ; ?>
                                </td>
                                <td class="col-three">
                                    ml/dL
                                </td>
                                <td class="col-four">
                                    3.14 - 6.69
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        <?php
                            if(isset($estudio->absoluto)){
                        ?>
                            <tr>
                                <td class="col-one">
                                    <h5>
                                        VALORES ABSOLUTOS
                                    </h5>
                                </td>
                            </tr>
                        <?php
                                foreach($estudio->absoluto as $key=>$absoluto){
                        ?>
                            <tr>
                                <td class="col-one">
                                    <?php echo $analito->nombre ; ?>
                                </td>
                                <td class="col-two">
                                    <?php echo ($analito->resultado != null) ? $analito->resultado : '' ; ?>
                                </td>
                                <td class="col-three">

                                </td>
                                <td class="col-four">

                                </td>
                            </tr>
                        <?php
                                }
                            }
                        ?>

                    </tbody>
                </table>
                <div >
                    <strong>Método: </strong>
                    <?php
                        if(isset($estudio->metodo)){
                            echo $estudio->metodo;
                        }else{
                            echo "Sin metodo de muestra";
                        }
                    ?>
                </div>
                <div >
                    <strong>Observaciones: </strong>
                    <?php
                        if(isset($estudio->observaciones)){
                            echo $estudio->observaciones;
                        }else{
                            echo "Sin observaciones";
                        }
                    ?>
                </div>
                <br>
        <?php
                }
                $i++;
                if ($i < $count) {  //if the counter is less than the lenght of the array, add a page break. 
                                    //Esto evita que dompdf genere una pagina extra en blanco
                    // echo '<div class="break"></div>';
                }

            }
        ?>
    </div>

    </body>
</html>
