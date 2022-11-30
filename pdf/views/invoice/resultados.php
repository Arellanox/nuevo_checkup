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
                line-height: 1;
                margin-top: 60px;
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
                height: 165px; 
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

            .separador-bottom{
                border-style: none none solid none;
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
                font-size: 10.8px;
                margin-top: 2px;
                margin-bottom: 2px;
            }
            p{
                font-size: 10px;
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
                word-break: break-all;
            }

            /* Para divisiones de 3 */
            .col-left{
                width: 25%; 
                max-width: 25%; 
                text-align: left;
                font-size: 10px;
            }
            .col-center{
                width: 50%; 
                max-width: 50%; 
                text-align: center;
                font-size: 10px;
            }
            .col-right{
                width: 25%; 
                max-width: 25%; 
                text-align: right;
                font-size: 10px;
            }

            /* Para divisiones de 4 */
            .result{
                font-size:10px
            }

            .col-one{
                width: 25%; 
                max-width: 25%; 
                text-align: left;
            }
            .col-two{
                width: 25%; 
                max-width: 25%; 
                text-align: center;
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

    <body>

    <!-- header -->
    <div class="header separador-bottom">
        <table>
            <tbody>
                <tr>
                    <td  style="border-bottom: none">
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <tr>
                <td class="col-left"  style="border-bottom: none">
                </td>
                <td class="col-center"  style="border-bottom: none">
                </td>
                <td class="col-right"  style="border-bottom: none">
                </td>
            </tr>
        </table>
    </div>
    

    <!-- footer -->
    <div class="footer">
        <table style="line-height: 0.5;">
            <tr >
                <td class="col-left" style="border-bottom: none; line-height: 0.5;">
                    <p>
                        <strong>Fecha de impresión: </strong> <?php echo date('d-m-Y') ?>
                    </p>
                    <p>
                    </p>
                    <p>
                    </p>
                </td>
                <td class="col-center" style="border-bottom: none; line-height: 0.5;">
                    <p>
                        <!-- Fimra -->
                    </p>
                    <p> 
                        <!-- valida -->
                    </p>
                    <p>
                    </p>
                    <p>
                    </p> 
                </td>
                <td class="col-right" style="border-bottom: none; line-height: 0.5; text-align: center">
                    <p class="page">Página </p>
                </td>
            </tr>
        </table>
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

                echo "<h2>". $area->area . "</h2>";

                foreach ($area->estudios as $key => $estudio) {
                    echo "<h5>" . $estudio->estudio . "</h5>";
        ?>
                <table class="result">
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
                            <tr>
                                <td class="col-one">
                                    <?php echo $analito->nombre ; ?>
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
                        }
                        ?>
                    </tbody>
                </table>
                <div style="font-size: 10px">
                    <strong>Método: </strong>
                    <?php echo $estudio->metodo; ?>
                </div>
                <div style="font-size: 10px">
                    <strong>Muestra: </strong>
                    <?php echo $estudio->muestra; ?>
                </div>
                <div style="font-size: 10px">
                    <strong>Observaciones: </strong>
                    <?php
                        if($estudio->observaciones){
                            echo $estudio->observaciones;
                        }
                    ?>
                </div>
                <br>
        <?php
                }
                $i++;
                if ($i < $count) {  //if the counter is less than the lenght of the array, add a page break. 
                                    //Esto evita que dompdf genere una pagina extra en blanco
                    echo '<div class="break"></div>';
                }

            }
        ?>
    </div>

    </body>
</html>
