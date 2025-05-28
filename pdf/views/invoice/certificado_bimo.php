<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Certificado Médico</title>
    <style>
        <?php include 'assets/certificado_bimo.css'; ?>

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
    <?php
        $paciente = $resultados->PACIENTE[0] ?? [];
        $servicios = $resultados->SERVICIOS ?? [];
        $medicos = $resultados->MEDICOS ?? [];

        $array_aptitud = json_decode($paciente->APTITUD ?? "[]");
        $array_tipo_exam = json_decode($paciente->TIPO_EXAMEN_MEDICO ?? "[]");

        setlocale(LC_TIME, 'es_MX.UTF-8');
        date_default_timezone_set('America/Mexico_City');
    ?>
    <table class="tb-datos-personales">
        <thead class="tb-datos-personales-header">
        <tr>
            <th colspan="12">DATOS GENERALES</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="6">LUGAR:
                <strong>Av. José Pagés Llergo No. 150, Colonia Arboledas, Villahermosa Tab.</strong>
            </td>
            <td colspan="6">FECHA:
                <strong><?= strftime('%d %B %Y'); ?></strong>
            </td>
        </tr>
        <tr>
            <td colspan="6">NOMBRE:
                <strong><?= $paciente->NOMBRE_COMPLETO ?? '' ?></strong>
            </td>
            <td colspan="3">EDAD:
                <strong><?= $paciente->EDAD ?? '' ?> años</strong>
            </td>
            <td colspan="3">NACIONALIDAD:
                <strong><?= $paciente->NACIONALIDAD ?? '' ?></strong>
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
                <strong>
                    <?php imprimirTipoExamenMedico($array_tipo_exam, 'Ingreso'); ?>
                </strong>
            </td>
            <td class="label" colspan="2">PEIODICO</td>
            <td class="not-label" colspan="2">
                <strong>
                    <?php imprimirTipoExamenMedico($array_tipo_exam, 'Periodico'); ?>
                </strong>
            </td>
            <td class="label" colspan="2">EGRESO</td>
            <td class="not-label" colspan="2">
                <strong>
                    <?php imprimirTipoExamenMedico($array_tipo_exam, 'Egreso'); ?>
                </strong>
            </td>
            <td class="label" colspan="2">OTRO</td>
            <td class="not-lab" colspan="10">
                <strong>
                    <?php imprimirTipoExamenMedico($array_tipo_exam, 'Otro'); ?>
                </strong>
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
                    <?= $paciente->DIAGNOSTICO ?? '' ?>
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
                <strong><?= obtenerDescripcionGradoSalud($paciente->GRADO_SALUD) ?></strong>
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
            <td colspan="3"><?php imprimirAptitudTrabajo($array_aptitud, 'Apto') ?></td>
            <td colspan="18">
                <span>APTO PARA TRABAJAR</span>
            </td>
        </tr>
        <tr>
            <td colspan="3"><?php imprimirAptitudTrabajo($array_aptitud, 'Apto con Restricciones') ?></td>
            <td colspan="18">
                <span>APTO PARA TRABAJAR CON RESTRICCIONES</span>
            </td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="3"><?php imprimirAptitudTrabajo($array_aptitud, 'No Apto') ?></td>
            <td colspan="18">
                <span>NO APTO PARA TRABAJAR</span>
            </td>
        </tr>
        <tr>
            <td class="not-border" colspan="16"></td>
            <td class="vigencia title" colspan="2"><i><strong>VIGENCIA</strong></i></td>
            <td class="vigencia" colspan="2">
                <strong><?= describirVigencia($paciente->VIGENCIA) ?></strong>
            </td>
            <td class="vigencia title" colspan="2"><strong>FECHA DE VENCIMIENTO</strong></td>
            <td class="vigencia" colspan="2">
                <strong><?= $paciente->FECHA_VIGENCIA ?></strong>
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
            <?php
                $servicios_area6 = array_filter($servicios, function($item) {
                    return $item->AREA_ID == 6;
                });

                $servicios_area6 = array_values($servicios_area6); // Reindexar el array
                $count = count($servicios_area6);

            for ($i = 0; $i < $count; $i += 2): ?>
                <tr>
                    <td colspan="3"><strong><?= $servicios_area6[$i]->SERVICIO ?></strong></td>
                    <td colspan="3"></td>
                    <?php if (isset($servicios_area6[$i + 1])): ?>
                        <td colspan="3"><strong><?= $servicios_area6[$i + 1]->SERVICIO ?></strong></td>
                        <td colspan="3"></td>
                    <?php else: ?>
                        <td colspan="6"></td>
                    <?php endif; ?>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</main>

<footer class="footer">
    <?php
        $ruta_qr = preg_replace(
            '#https?://[^/]+/nuevo_checkup/#',
            './../', $paciente->RUTA_QR
        );

        $ruta_validacion = file_get_contents($ruta_qr);
        $encode_validacion = base64_encode($ruta_validacion);

        include 'layouts/footer/certificado_bimo.php';
    ?>
</footer>
</body>

</html>

<?php
    function describirVigencia($meses): string
    {
        if ($meses == 1) {
            return "1 MES";
        } elseif ($meses == 12) {
            return "1 AÑO";
        } elseif ($meses % 12 == 0) {
            $años = $meses / 12;
            return $años . " AÑOS";
        } else {
            return $meses . " MESES";
        }
    }

    function obtenerDescripcionGradoSalud($valor): string
    {
        $descripciones = [
            "0"     => "GRADO 0 - No presenta datos clínicos.",
            "1"     => "GRADO 1 - Enfermedad reversible.",
            "1 RT"  => "GRADO 1 RT - Sin lesiones, secuelas ni limitaciones laborales.",
            "1 EG"  => "GRADO 1 EG - Requiere evaluación general inicial.",
            "2"     => "GRADO 2 - Enfermedad Irreversible (Permanente)",
            "2 RT"  => "GRADO 2 RT - Lesiones leves, sin incapacidad permanente.",
            "2 EG"  => "GRADO 2 EG - Evaluación general y seguimiento necesario.",
            "3"     => "GRADO 3 - Enfermedad Irreversible (Permanente) No controlada con limitantes temporales para el puesto de Trabajo",
            "3 RT"  => "GRADO 3 RT - Lesiones moderadas, puede requerir reubicación.",
            "3 EG"  => "GRADO 3 EG - Evaluación especializada requerida.",
            "4"     => "GRADO 4 - Enfermedad Irreversible (Permanante) que produce Estado de Salud no compatible con puesto de Trabajo",
            "4 RT"  => "GRADO 4 RT - Lesiones graves o discapacidad significativa.",
            "4 EG"  => "GRADO 4 EG - Evaluación exhaustiva y planificación terapéutica."
        ];

        return $descripciones[$valor] ?? "Grado desconocido";
    }

    function imprimirTipoExamenMedico($array_tipo_exam, $tipo){
        if (count($array_tipo_exam) > 0) {
            foreach ($array_tipo_exam as $item) {
                if ($item === $tipo) {
                    echo 'X';
                }
            }
        }
    }

    function imprimirAptitudTrabajo($array_aptitud, $desc){
        if (count($array_aptitud) > 0) {
            foreach ($array_aptitud as $item) {
                if ($item === $desc) {
                    echo '<div style="background: #0c0c0c; width: 100%; height: 10px"></div>';
                }
            }
        }
    }
?>