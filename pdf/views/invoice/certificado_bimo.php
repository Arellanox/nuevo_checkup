<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Certificado Médico</title>
    <style>
        <?php include 'assets/certiciado_bimo.css'; ?>

        .footer .page:after {
            content: counter(page);
        }
    </style>
</head>

<body>

<?php
$ruta = file_get_contents('../pdf/public/assets/icono_reporte_checkup.png');
$encode = base64_encode($ruta);

$ruta_firma = file_get_contents('../pdf/public/assets/firma_beatriz.png');
$encode_firma = base64_encode($ruta_firma);
?>

<header class="header">
    <?php
    $titulo = 'DIAGNOSTICO BIOMOLECULAR';
    $tituloPersonales = 'Laboratorio de Biología Molecular';
    $subtitulo = 'Requisición Maquilas';
    $encabezado->CREACION = $REPOSICION[0]->FECHA_REQUISICION;
    $encabezado->FOLIO = $REPOSICION[0]->FOLIO;
    $encabezado->ESTADO = $REPOSICION[0]->ESTADO;
    $encabezado->RESPONSABLE = $REPOSICION[0]->RESPONSABLE;

    include 'layouts/header/certificado_bimo.php';
    ?>
</header>

<main>
    <table class="tb-datos-personales">
        <thead class="tb-datos-personales-header">
        <tr>
            <th colspan="12">DATOS GENERALES</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="6">LUGAR:
                <strong>Villahermosa, Tabasco</strong>
            </td>
            <td colspan="6">FECHA:
                <strong>01 marzo 205</strong>
            </td>
        </tr>
        <tr>
            <td colspan="6">NOMBRE:
                <strong>Edwin Rafael Colina Landa</strong>
            </td>
            <td colspan="3">EDAD:
                <strong>38 años</strong>
            </td>
            <td colspan="3">NACIONALIDAD:
                <strong>Mexicana</strong>
            </td>
        </tr>
        </tbody>
    </table>
    <table class="tb-tipo-examen">
        <thead class="tb-tipo-examen-header">
        <tr>
            <th colspan="24">TIPO DE EXAMEN MEDICO</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="label" colspan="2">INGRESO</td>
            <td class="not-label" colspan="2">
                <strong>X</strong>
            </td>
            <td class="label" colspan="2">PEIODICO</td>
            <td class="not-label" colspan="2">
                <strong>X</strong>
            </td>
            <td class="label" colspan="2">EGRESO</td>
            <td class="not-label" colspan="2">
                <strong>X</strong>
            </td>
            <td class="label" colspan="2">OTRO</td>
            <td class="not-lab" colspan="10">
                <strong>X</strong>
            </td>
        </tr>
        <tr>
            <td colspan="24">
                QUIEN ES/ SERA CONSIDERADO PERSONAL EN ACTIVO EN LA EMPRESA: <strong>VINCO</strong>
            </td>
        </tr>
        <tr>
            <td colspan="24">
                EN LA POSICIÓN DE: <strong>OPERADOR</strong>
            </td>
        </tr>
        </tbody>
    </table>
    <table class="tb-diagnostico">
        <thead class="tb-diagnostico-header">
        <tr>
            <th colspan="24">DIAGNÓSTICO</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="24">
                <strong>
                    MIOPÍA/ ASTIGMATISMO/ DATOS INCIPIENTES DE HIPERMETROPIA/ ESPONDILOARTROSIS INCIPIENTE/
                    ANTEROLISTESISL5-S1/ DISMINUCION DE ESPACIO INTERVERTEBRAL L5-S1
                </strong>
            </td>
        </tr>
        </tbody>
    </table>
    <table class="tb-clasificacion">
        <thead class="tb-clasificacion-header">
        <tr>
            <th colspan="24">CLASIFICACIÓN EN GRADO DE SALUD</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="24">
                <strong>2 EG</strong>
            </td>
        </tr>
        </tbody>
    </table>
    <table class="tb-actitud-laboral">
        <thead class="tb-actitud-laboral-header">
        <tr>
            <th colspan="24">APTITUD DE TRABAJO</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="3" rowspan="2"></td>
            <td colspan="3"></td>
            <td colspan="18">
                <span>APTO PARA TRABAJAR</span>
            </td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="18">
                <span>APTO PARA TRABAJAR CON RESTRICCIONES</span>
            </td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="3"></td>
            <td colspan="18">
                <span>NO APTO PARA TRABAJAR</span>
            </td>
        </tr>
        <tr>
            <td class="not-border" colspan="16"></td>
            <td class="vigencia title" colspan="2"><i><strong>VIGENCIA</strong></i></td>
            <td class="vigencia" colspan="2">
                <strong>1 AÑO</strong>
            </td>
            <td class="vigencia title" colspan="2"><strong>FECHA DE VENCIMIENTO</strong></td>
            <td class="vigencia" colspan="2">
                <strong>06/03/2025</strong>
            </td>
        </tr>
        </tbody>
    </table>
    <br>
    <br>
    <table class="tb-estudios">
        <thead class="tb-estudios-header">
        <tr class="subheader">
            <th class="empty" colspan="3"></th>
            <th class="title" colspan="3">ESTUDIOS Y ANALISIS COMPLEMENTARIOS</th>
            <th class="not-border" colspan="6"></th>
        </tr>
        <tr class="header-base">
            <th colspan="3" style="border: 1px solid black;">Estudio</th>
            <th colspan="3" style="border: 1px solid black;">Resultado</th>
            <th colspan="3" style="border: 1px solid black;">Estudio</th>
            <th colspan="3" style="border: 1px solid black;">Resultado</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < 5; $i++): ?>
            <tr>
                <td colspan="3"><strong>Valoración visual</strong></td>
                <td colspan="3">Normal</td>
                <td colspan="3"><strong>Biometría hemática completa</strong></td>
                <td colspan="3">Normal</td>
            </tr>
        <?php endfor; ?>
        </tbody>
    </table>
</main>

<footer class="footer">
    <?php include 'layouts/footer/certificado_bimo.php'; ?>
</footer>
</body>

</html>