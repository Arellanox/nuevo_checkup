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
            /* Separador, solo borde inferior */
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
                text-align: justify;
            }
            
            .align-center{
                text-align: center;
            }
            
            table{
                width: 100%;
                max-width: 100%;
                margin: auto;
                white-space:nowrap;
                /* table-layout: fixed; */
            }
            th, td {
                /* border-bottom: 1px solid #ddd; */
                word-break: break-all;
                text-align: justify;

                /* word-wrap:  break-word; */
                /* white-space: pre-wrap; */
            }

            /* tbody td span {
                text-align: justify;
                display: inline-block;
                overflow: hidden; 
                white-space: nowrap; 
            } */
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

            .single-column{
                width: 100%;
                max-width: 100%;
                text-align: justify;
            }

            .col-one{
                width: 25%; 
                max-width: 25%; 
                text-align: left;
            }
            .col-two{
                width: 25%; 
                max-width: 25%; 
                text-align: left;
            }
            .col-three{
                width: 25%; 
                max-width: 25%; 
                text-align: left;
                
            }
            .col-four{
                width: 25%; 
                max-width: 25%; 
                text-align: left;
                
            }
            
        </style>
    </head>

    <body>
        <?php
        $data = $data->oftamologia;
        ?>

    <!-- header -->
    <div class="header separador-bottom">
        <table>
            <tbody>
                <tr>
                    <td  style="border-bottom: none">
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
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
    <strong>
        ANTECEDENTES PERSONALES:
    </strong>
    <?php echo $data->antecedentes_personales ?>
    <br>
    <strong>ANTECEDENTES OFTAMOLOGICOS: </strong>
    <?php echo $data->antecendentes_oftamologicos ?>
    <br>
    <strong>PADECIMIENTO ACTUAL: </strong>
    <?php echo $data->padecimiento_actual ?>
    <br>
    <strong>AGUDEZA VISUAL:</strong>
    <br>
    <?php
        echo $data->agudeza_visual[0]->metodo . "<br>";
        echo $data->agudeza_visual[0]->od . "<br>"; 
        echo $data->agudeza_visual[0]->oi . "<br>"; 
        echo $data->agudeza_visual[0]->jaeger . "<br>"; 
        echo $data->agudeza_visual[0]->observacion . "<br>"; 
    ?>
    <br>
    <strong>REFRACCIÓN</strong>
    <?php echo $data->refraccion ?>
    <br>
    <strong>PRUEBA CROMATICA </strong>
    <?php echo $data->prueba_cromatica ?>
    <br>
    <strong>EXPLORACIÓN OFTAMOLOGICA</strong>
    <br>
    <span>
        <?php echo $data->exploracion_oftamologica ?>
    </span>
    <br>
    <strong>FORIAS</strong>
    <?php echo $data->forias ?>
    <br>
    <strong>CAMPIMETRIA</strong>
    <?php echo $data->campimetria ?>
    <br>
    <strong>PRESION INTRAOCULAR</strong>
    <?php
        echo $data->presion_intraocular[0]->od ."<br>";
        echo $data->presion_intraocular[0]->oi ."<br>";
    ?>
        <br>
    </div>
    </body>
</html>
