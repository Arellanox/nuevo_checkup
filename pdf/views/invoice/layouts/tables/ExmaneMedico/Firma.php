<?php
$nombre_doctor = $pie['datos_medicos']['0']['NOMBRE_COMPLETO'];
$uni = $pie['datos_medicos']['0']['UNIVERSIDAD'];
$cedula = $pie['datos_medicos']['0']['CEDULA'];

$footerDoctor = "$nombre_doctor <br>$uni - Cédula profesional: $cedula";
?>

<table style="margin-top: 100px">
    <tbody>
        <tr>
            <th>
                <span class="text-table-result" style="display: block; margin-bottom: 10px;">________________________________________</span>
                <span class="text-table-result" style="display: block;">Nombre del paciente</span>
                <span class="text-table-result" style="display: block;"><?= $encabezado->NOMBRE ?></span>
            </th>
            <th>
                <span class="text-table-result" style="display: block; margin-bottom: 10px;">________________________________________</span>
                <span class="text-table-result" style="display: block; margin-bottom: 4px;">Profesional de la salud</span>
                <span class="text-table-result" style="display: block; margin-bottom: 4px;">Cédula Profesional: <?= $cedula ?></span>
            </th>
        </tr>
    </tbody>
</table>