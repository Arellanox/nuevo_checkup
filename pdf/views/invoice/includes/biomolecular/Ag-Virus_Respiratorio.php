<style>
    #table_virus_resp th {
        background-color: #d3d3d3;
        padding: 10px 7px 10px 7px;
        /* text-justify: left; */
        text-align: left;
        font-size: 16px;
    }

    #table_virus_resp td,
    #table_virus_resp strong {
        padding: 10px 7px 10px 6px;
        font-size: 16px;
        text-align: left;
    }

    #table_virus_resp {
        margin-top: 80px;
    }

    #informacion_resp p,
    #informacion_resp strong {
        font-size: 15px;
    }

    /* #table_virus_resp tr.header th {} */

    /* #table_virus_resp .col-rigth {
        text-justify: left;
    }

    #table_virus_resp .col-center {
        text-justify: left;
    } */

    /* #virus_resp_body {
        padding-bottom: 10px;
        padding-right: 30px;
        padding-left: 30px;
    } */
</style>


<p style="position:absolute;top:2px;left:548px;white-space:nowrap font-size: 12px !important" class="ft00">Muestra: <strong style="font-size: 11px"><?php echo $body[1]->resultado ?></strong> </p>

<br>

<?php
// print_r($body);
?>

<div id="virus_resp_body">
    <hr style="text-align: center; border-style: solid none solid none;width:100%">
    <table id="table_virus_resp" cellspacing="0">
        <!-- <tr>
        <th colspan="3">Encabezado de la tabla</th>
    </tr> -->
        <tr class="header">
            <th>Prueba</th>
            <th>Resultado</th>
            <th>Valor de normalidad</th>
        </tr>
        <tr>
            <td>Antígeno <i>Virus Sincitial Respiratorio</i></td>
            <td style="font-size: 14px;"><?php echo $body[0]->resultado ?></td>
            <td><strong>NEGATIVO</strong> </td>
        </tr>

    </table>

    <div id="informacion_resp"></div>

    <br>
    <br><br><br>
    <p style="font-size: 14px;">Comentarios: Esta prueba identifica la presencia de antígeno del Virus Sincitial Respiratorio, el resultado negativo
        de la prueba no significa inmunidad y el médico tratante es quien realiza la interpretación de este resultado de
        acuerdo a los datos clínicos que el paciente presente.
        <!-- Kit utilizado: <strong></strong> -->
    </p>
    <br>
    <br>
    <table style="width:100%; font-size:14px">
        <tr>
            <td><strong style="font-size: 14px;">Lote de kit: </strong><?php echo $body[2]->resultado ?></td>
            <td><strong style="font-size: 14px;">Kit utilizado: </strong><?php echo $body[3]->resultado ?></td>
        </tr>
        <tr>
            <td> <strong style="font-size: 14px;">Registro Sanitario: </strong>2132R2023 SSA</td>
        </tr>
    </table>

</div>
</div>