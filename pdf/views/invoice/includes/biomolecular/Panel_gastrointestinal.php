<style>
    .bold {
        font-weight: bold;
    }

    .rojo {
        color: red;
    }

    .resultados_resp td {
        width: 33.3%;
    }
</style>

<br>
<br>
<br>

<table style="width: 100%;">
    <tr style="background-color: darkgrey;">
        <td style=" padding:3px;"><strong>PANEL GASTROINTESTINAL</strong></td>
        <td style="text-align:center; padding:3px;"><strong>Resultado</strong></td>
        <td style="text-align:center; padding:3px;"><strong>Valor de Normalidad</strong></td>
    </tr>
    <?php

    # $body = array_slice($body, 0, count($body) - 4);
    foreach ($body as $key => $value) {
        if ($value->resultado != 'LABEL_BIOMOLECULAR') {
    ?>
            <tr>
                <td style="text-align: left;" class=""><?php echo $value->nombre ?></td>
                <td class="<?php echo $value->resultado == 'DETECTADO' ? "bold rojo" : "bold";  ?>" style="text-align:center;"><?php if ($value->resultado != 'N/A') echo $value->resultado ?></td>
                <td style="text-align:center;"><?php if ($value->resultado != 'N/A') echo "NO DETECTADO"; ?></td>
            </tr>
        <?php
        } else {
        ?>
            <tr>
                <td colspan="12">&nbsp;</td>
            </tr>
            <tr class="bold">
                <td colspan="12" style="text-align: left;">•<?php echo $value->nombre ?></td>
            </tr>
    <?php
        }
    }
    ?>
    <tr>
        <td><br></td>
    </tr>
</table>

<br>


<!-- Comentario -->
<!-- <p style=" text-align: justify;"> -->
    <strong>Comentarios:</strong>
    <p style=" text-align: justify;"><em>Los resultados de esta prueba deberán correlacionarse con la anamnesis, datos epidemiológicos y otros datos de los que
disponga el médico tratante. Los resultados detectados no descartan la infección simultánea por patógenos no incluidos en
este panel, así como un resultado No detectado, no excluye la posibilidad de infección gastrointestinal.</em></p>

<p style=" text-align: justify;"><em>La detección de ácidos nucleicos de los patógenos en cuestión depende de que se haya realizado una obtención,
manipulación, transporte y almacenamiento correcto de la muestra.</em></p>
<div class="break"></div>
<br>
<p style=" text-align: justify;"><em>Los resultados “Detectados” para múltiples E. coli/Shigella diarreogénicas se puede deber a la presencia de múltiples
patotipos o a una única cepa que contiene los determinantes característicos de múltiples patotipos.</em></p>

<p style=" text-align: justify;"><em>Un resultado “Detectado” para E. coli (STEC) y Shigella/E. coli enteroinvasiva (EIEC) puede indicar la presencia de Shigella
dysenteriae.</em></p>

<p style=" text-align: justify;"><em>La presencia de E. dispar en niveles elevados, puede ser detectada como E. histolytica, así como Bifidobacterium spp. y
Ruminococcus spp. en la prueba de G. lamblia. Las reacciones cruzadas pueden deberse a la presencia de secuencias
homólogas detectadas en diferentes microorganismos.</em></p>

<p style=" text-align: justify;"><em>El ácido nucleico de virus, bacterias o parásitos puede persistir in vivo con independencia de la viabilidad del organismo. La
detección de dianas de material genético no implica que los correspondientes microorganismos sean infecciosos o sean los
agentes causantes de los síntomas clínicos (por ejemplo, portadores asintomáticos), por lo que en estos casos puede ser
necesario (cuando aplique) un cultivo en paralelo para recuperar el organismo y tipificar adicionalmente los agentes
bacterianos.</em></p>
<!-- </p> -->
<br>
<br>

<!-- Tabla con la información del equipo utilzado, kit de diagnostico y lote -->
<table style="width:100%;">
    <tr>
        <td><strong>Equipo utilizado: </strong>FilmArray® Panel Gastrointestinal</td>
        <td><strong>Tipo de muestra: </strong>Heces</td>
    </tr>
    <tr>
        <td> <strong>Método: </strong>PCR</td>
    </tr>
</table>