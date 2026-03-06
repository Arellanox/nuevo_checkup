<style>
@page{
    size: letter;
    margin:10mm 15mm 10mm 15mm;
}

body{
    font-family: Helvetica, Arial, sans-serif;
    font-size:11pt;
}

table{
    border-collapse:collapse;
    width:100%;
}

td{
    vertical-align:top;
}

.titulo{
    font-family:"Times New Roman", serif;
    font-size:14pt;
    font-weight:bold;
    line-height:1.2;
}

.caja{
    background:#b7bfd6;
    border:2px solid #000;
    height:22px;
}

.caja-edad{
    width:45px;
}

.caja-especifique{
    width:200px;
}

.caja-larga{
    width:350px;
}

.caja-firma{
    height:32px;
}

.check{
    width:12px;
    height:12px;
    border:1.5px solid #000;
}

.tabla-resultados td{
    padding:4px;
}

.seccion-declaracion{
    margin-top:10px;
    text-align:justify;
    line-height:1.15;
}

.tabla-firma{
    margin-top:10px;
}

.caja-sello{
    border:2px solid #000;
    width:150px;
    height:90px;
}
</style>

<?php

$imende = file_get_contents("https://bimo-lab.com/nuevo_checkup/archivos/sistema/logo%20imende.png");
$imende = base64_encode($imende);

$apellido_paterno="DE LA CRUZ";
$apellido_materno="ARELLANO";
$nombres="JOSUE";
$edad="33";

$sello=file_get_contents("https://bimo-lab.com/nuevo_checkup/archivos/sistema/logo_bimo.png");
$sello=base64_encode($sello);
$sello_mime="image/png";

?>

<table>

<tr>

<td width="55%">
<img src="data:image/png;base64,<?= $imende ?>" width="260">
</td>

<td width="45%" align="right">

<div style="font-size:10pt">
F-MPCA-01-001<br>
Rev.06
</div>

<div style="height:35px"></div>

<div class="titulo">
Registro De<br>
Agudeza Visual
</div>

</td>

</tr>

</table>


<table style="margin-top:8px">

<tr>

<td width="12%">Nombre:</td>

<td width="29%">
<div class="caja" align="center"><?= $apellido_paterno ?></div>
</td>

<td width="29%">
<div class="caja" align="center"><?= $apellido_materno ?></div>
</td>

<td width="30%">
<div class="caja" align="center"><?= $nombres ?></div>
</td>

</tr>

<tr style="font-size:10pt">

<td></td>
<td align="center">Apellido Paterno</td>
<td align="center">Apellido Materno</td>
<td align="center">Nombre(s)</td>

</tr>

</table>


<table style="margin-top:6px">

<tr>

<td width="12%">Edad:</td>

<td width="12%">
<div class="caja caja-edad" align="center"><?= $edad ?></div>
</td>

<td>en años cumplidos</td>

</tr>

</table>


<table class="tabla-resultados" style="margin-top:10px">

<tr>

<td width="28%">Agudeza visual cercana</td>

<td width="24%">
<table>
<tr>
<td width="16"><div class="check"></div></td>
<td>Satisfactoria sin lentes</td>
</tr>
</table>
</td>

<td width="24%">
<table>
<tr>
<td width="16"><div class="check"></div></td>
<td>Satisfactoria con lentes</td>
</tr>
</table>
</td>

<td width="24%">
<table>
<tr>
<td width="16"><div class="check"></div></td>
<td>No satisfactoria</td>
</tr>
</table>
</td>

</tr>


<tr>

<td>Agudeza visual lejana</td>

<td>
<table>
<tr>
<td width="16"><div class="check"></div></td>
<td>Satisfactoria sin lentes</td>
</tr>
</table>
</td>

<td>
<table>
<tr>
<td width="16"><div class="check"></div></td>
<td>Satisfactoria con lentes</td>
</tr>
</table>
</td>

<td>
<table>
<tr>
<td width="16"><div class="check"></div></td>
<td>No satisfactoria</td>
</tr>
</table>
</td>

</tr>


<tr>

<td>Discriminación cromática</td>

<td>
<table>
<tr>
<td width="16"><div class="check"></div></td>
<td>Sin deficiencia en la percepción de colores</td>
</tr>
</table>
</td>

<td>
<table>
<tr>
<td width="16"><div class="check"></div></td>
<td>Con deficiencia en la percepción de colores</td>
</tr>
</table>
</td>

<td>

<table>
<tr>
<td width="16"><div class="check"></div></td>
<td>Especifique:</td>
</tr>
</table>

<div class="caja caja-especifique"></div>

</td>

</tr>


<tr>

<td>Prueba empleada</td>

<td>
<table>
<tr>
<td width="16"><div class="check"></div></td>
<td>Carta Ishihara</td>
</tr>
</table>
</td>

<td>
<table>
<tr>
<td width="16"><div class="check"></div></td>
<td>Carta Pseudo Isocromática</td>
</tr>
</table>
</td>

<td>
<table>
<tr>
<td width="16"><div class="check"></div></td>
<td>Carta Jaeger</td>
</tr>
</table>
</td>

</tr>


<tr>

<td></td>

<td>
<table>
<tr>
<td width="16"><div class="check"></div></td>
<td>Carta Snellen</td>
</tr>
</table>
</td>

<td></td>
<td></td>

</tr>


<tr>

<td>Otra prueba:</td>

<td colspan="3">
<div class="caja caja-larga"></div>
</td>

</tr>


<tr>

<td>Fecha de aplicación de los exámenes:</td>

<td colspan="3">
<div class="caja caja-larga"></div>
</td>

</tr>

</table>



<div class="seccion-declaracion">

Bajo protesta de decir verdad, declaro que se han aplicado los exámenes de agudeza visual lejana y cercana al individuo cuyo nombre aparece arriba y declarando que tiene una agudeza visual cercana en al menos un ojo que le permite leer las letras J1 de la carta de Jaeger o equivalente a una distancia no menor de 30 cm. Y una agudeza visual lejana en al menos un ojo que le permita leer las letras 20/20 de la carta de Snellen o equivalente a una distancia no menor de 30 metros. Así como la aplicación del examen de discriminación cromática, observando los resultados antes mencionados.

</div>

<br>
<table style="margin-top:6px">
    <tr>
        <td width="45%" colspan="3">Profesional que aplicó los exámenes.</td>
       
    </tr>
    <tr>
        <td width="20%">
            <table>
                <tr>
                    <td width="16"><div class="check"></div></td>
                    <td>Oftalmólogo</td>
                </tr>
            </table>
        </td>
        <td width="20%">
            <table>
                <tr>
                    <td width="16"><div class="check"></div></td>
                    <td>Optometrista</td>
                </tr>
            </table>
        </td>
        <td></td>
    </tr>
</table>



<table class="tabla-firma">
    <tr>
        <td width="65%" style="vertical-align:middle;">
            <table>
                <tr>
                    <td width="35%">Nombre y firma:</td>
                    <td><div class="caja caja-firma"></div></td>
                </tr>
            </table>
            <table style="margin-top:6px">
                <tr>
                    <td width="35%">Cédula profesional:</td>
                    <td><div class="caja caja-firma"></div></td>
                </tr>
            </table>
        </td>
        <td width="35%" style="padding-left:10px">
            <div style="font-size:10pt;margin-bottom:4px">
                Sello de validez
            </div>
            <div class="caja-sello">
                <img src="data:<?= $sello_mime ?>;base64,<?= $sello ?>" width="100">
            </div>
        </td>
    </tr>
</table>