<style>
    .drop-zone {
        width: 392px;
        height: 85px;
        border: 2px dashed rgb(0 79 90 / 17%);
        text-align: center;
        padding: 12px;
        margin-bottom: 25px !important;
        border-radius: 10px;
        margin-left: 8px;
    }

    .drop-zone.hover_dropDrag {
        border-color: #00bbb9 !important;
        background-color: #c6cacc !important;
    }

    label.label-captura-oido {
        background: transparent;
    }
</style>

</style>

<p class="text-center">Cargue y mueva el recuadro de la imagen para capturar la tabla del reporte.</p>

<!-- <form id="formSubirInterpretacionPRUEBA"> -->
<?php
// Asumiendo que $antecedentes es tu arreglo de preguntas
$antecedentes = [
    1 => [
        'descripcion' => 'sarampion',
        'pregunta' => '¿Ha tenido sarampión alguna vez en su vida?'
    ],
    2 => [
        'descripcion' => 'paperas',
        'pregunta' => '¿Ha padecido de paperas?'
    ],
    3 => [
        'descripcion' => 'meningitis',
        'pregunta' => '¿Alguna vez le han diagnosticado con meningitis?'
    ],
    4 => [
        'descripcion' => 'escarlatina',
        'pregunta' => '¿Ha tenido escarlatina?'
    ],
    5 => [
        'descripcion' => 'hipertension_arterial',
        'pregunta' => '¿Sufre de hipertensión arterial?'
    ],
    6 => [
        'descripcion' => 'otras',
        'pregunta' => '¿Algún otro antecedente?'
    ],
    7 => [
        'descripcion' => 'tinnitus',
        'pregunta' => '¿Ha experimentado tinnitus (zumbidos en los oídos)?'
    ],
    8 => [
        'descripcion' => 'infecciones_recurrentes_del_oido',
        'pregunta' => '¿Ha tenido infecciones recurrentes del oído?'
    ],
    9 => [
        'descripcion' => 'garcimina',
        'pregunta' => '¿Ha utilizado garcinia para algún tratamiento?'
    ],
    10 => [
        'descripcion' => 'quinina',
        'pregunta' => '¿Ha sido tratado alguna vez con quinina?'
    ],
    11 => [
        'descripcion' => 'estreptomicina',
        'pregunta' => '¿Le han prescrito estreptomicina para algún tratamiento?'
    ],
    12 => [
        'descripcion' => 'kanamicina',
        'pregunta' => '¿Ha usado kanamicina para tratar alguna afección?'
    ],
    13 => [
        'descripcion' => 'cirugia_de_oido',
        'pregunta' => '¿Ha tenido alguna cirugía de oído?'
    ],
    14 => [
        'descripcion' => 'trauma_craneoencefalico',
        'pregunta' => '¿Ha sufrido un trauma craneoencefálico?'
    ],
    15 => [
        'descripcion' => 'secreciones_de_oido',
        'pregunta' => '¿Padece de secreciones en el oído?'
    ],
    16 => [
        'descripcion' => 'acumulacion_de_cerumen',
        'pregunta' => '¿Tiene o ha tenido acumulación de cerumen?'
    ],
    17 => [
        'descripcion' => 'tinitos',
        'pregunta' => '¿Sufre de tinitos?'
    ],
    18 => [
        'descripcion' => 'ruido_intenso',
        'pregunta' => '¿Ha estado expuesto a ruido intenso de manera regular o prolongada?'
    ],
    19 => [
        'descripcion' => 'pasatiempos',
        'pregunta' => '¿Cuáles son sus pasatiempos, y cree que alguno de ellos podría afectar su salud auditiva?'
    ],
];


// Función para generar el HTML de una pregunta
function generarHTMLPregunta($id, $descripcion, $pregunta)
{
    return <<<HTML
                        <!-- Antecedente de $descripcion -->
                        <div class="m-4 row d-flex justify-content-center pregunta" style="font-size: 20px;">
                            <div class="col-12 col-lg-8">
                                <label>{$pregunta}:</label>
                            </div>
                            <div class="col-12 col-lg-4 row d-flex align-items-start justify-content-center">
                                <div class="col-auto">
                                    <input type="radio" required id="{$descripcion}_1" name="antecedentes[$id][option]" value="1">
                                    <label for="{$descripcion}_1">Sí</label>
                                </div>
                                <div class="col-auto">
                                    <input type="radio" required id="{$descripcion}_2" name="antecedentes[$id][option]" value="2">
                                    <label for="{$descripcion}_2">No</label>
                                </div>
                            </div>
                            <div class="target-{$id} collapse">
                                <textarea name="antecedentes[$id][comentario]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
                            </div>
                        </div>
                        <hr>
HTML;
}

// Inicio del HTML del formulario
$html = '<div class="row" id="antecedentes-preguntas">';

// Generar HTML para cada columna
foreach ([1 => 10, 11 => count($antecedentes)] as $inicio => $fin) {
    $html .= '<div class="col-12 col-lg-6">';
    $html .= '<div class="rounded p-3 shadow my-2">';
    for ($i = $inicio; $i <= $fin; $i++) {
        if (isset($antecedentes[$i])) {
            $descripcion = str_replace(' ', '_', $antecedentes[$i]['descripcion']);
            $pregunta = $antecedentes[$i]['pregunta'];
            $html .= generarHTMLPregunta($i, $descripcion, $pregunta);
        }
    }
    $html .= '</div>';
    $html .= '</div>';
}

$html .= '</div>'; // Fin del HTML del formulario

?>

<!-- <form></form> -->
<div class="row container-pages">
    <!-- Interrogatorio -->
    <section class="page px-4" style="display: none;">
        <form id="formSubirInterpretacionAudio-1">
            <!-- <div class=""> -->
            <h4>Antecedentes</h4>
            <!-- <div class="row" id="div-antecedentes"> -->


            <!-- Consumo de tabaco -->
            <!-- <div class="mb-4 row d-flex justify-content-center pregunta"
                        style="font-size: 20px;">
                        <div class="col-12 col-lg-8">
                            <label>¿Antecedente de tabaquismo?: </label>
                        </div>
                        <div class="col-12 col-lg-4 row d-flex align-items-start justify-content-center">
                            <div class="col-auto">
                                <input type="radio" required id="tabaco_1" name="antecedentes[1][option]" value="1">
                                <label for="tabaco_1">Sí</label>
                            </div>
                            <div class="col-auto">
                                <input type="radio" required id="tabaco_2" name="antecedentes[1][option]" value="2">
                                <label for="tabaco_2">No</label>
                            </div>
                        </div>
                        <div class="target-1 collapse">
                            <textarea name="antecedentes[1][comentario]" class="form-control input-form" rows="2"
                                cols="2" placeholder="Especifique"></textarea>
                        </div>
                    </div> -->
            <!-- Exposicion ruid -->
            <!-- <div class="mb-4 row d-flex justify-content-center pregunta"
                        style="font-size: 20px;">
                        <div class="col-12 col-lg-8">
                            <label>¿Exposición a ruido?: </label>
                        </div>
                        <div class="col-12 col-lg-4 row d-flex align-items-start justify-content-center">
                            <div class="col-auto">
                                <input type="radio" required id="ruido_1" name="antecedentes[2][option]" value="1">
                                <label for="ruido_1">Sí</label>
                            </div>
                            <div class="col-auto">
                                <input type="radio" required id="ruido_2" name="antecedentes[2][option]" value="2">
                                <label for="ruido_2">No</label>
                            </div>
                        </div>
                        <div class="target-2 collapse">
                            <textarea name="antecedentes[2][comentario]" class="form-control input-form" rows="2"
                                cols="2" placeholder="Especifique"></textarea>
                        </div>
                    </div>
                    <hr class="mt-2"> -->
            <!-- Exposicion solventes -->
            <!-- <div class="mb-4 row d-flex justify-content-center pregunta"
                        style="font-size: 20px;">
                        <div class="col-12 col-lg-8">
                            <label>¿Exposición a solventes?: </label>
                        </div>
                        <div class="col-12 col-lg-4 row d-flex align-items-start justify-content-center">
                            <div class="col-auto">
                                <input type="radio" required id="solventes_1" name="antecedentes[3][option]" value="1">
                                <label for="solventes_1">Sí</label>
                            </div>
                            <div class="col-auto">
                                <input type="radio" required id="solventes_2" name="antecedentes[3][option]" value="2">
                                <label for="solventes_2">No</label>
                            </div>
                        </div>
                        <div class="target-3 collapse">
                            <textarea name="antecedentes[3][comentario]" class="form-control input-form" rows="2"
                                cols="2" placeholder="Especifique"></textarea>
                        </div>
                    </div> -->
            <!-- Exposicion traumaticos -->
            <!-- <div class="mb-4 row d-flex justify-content-center pregunta"
                        style="font-size: 20px;">
                        <div class="col-12 col-lg-8">
                            <label>¿Antecedente de traumatismo?: </label>
                        </div>
                        <div class="col-12 col-lg-4 row d-flex align-items-start justify-content-center">
                            <div class="col-auto">
                                <input type="radio" required id="traumas_1" name="antecedentes[4][option]" value="1">
                                <label for="traumas_1">Sí</label>
                            </div>
                            <div class="col-auto">
                                <input type="radio" required id="traumas_2" name="antecedentes[4][option]" value="2">
                                <label for="traumas_2">No</label>
                            </div>
                        </div>
                        <div class="target-4 collapse">
                            <textarea name="antecedentes[4][comentario]" class="form-control input-form" rows="2"
                                cols="2" placeholder="Especifique"></textarea>
                        </div>
                    </div> -->
            <!-- </div> -->

            <?php
            // Formulario completo
            echo $html;
            ?>

            <!-- </div> -->
        </form>
    </section>

    <!-- Otoscopia -->
    <section class="page px-4" style="display: none;">
        <h2>Otoscopia</h2>

        <!-- Aqui va el oido derecho -->
        <div class="rounded p-3 shadow my-2">
            <div class="row">
                <div class="col-6">
                    <h5>Subir captura de Oído izquierdo</h5>
                    <form id="subirCapturaOidoIzquierdo" class="d-flex flex-column align-items-center">
                        <div id="dropOidoIzquierdo" class="drop-zone mx-2">
                            <label for="file-captura-oido-izquierdo" style="cursor: pointer;" class="label-captura-oido">Sube
                                tu
                                archivo
                                arrastrándolo
                                aquí</label>

                            <input type="file" id="file-captura-oido-izquierdo" name="file-captura-oido-izquierdo[]" style="display: none;">
                            <br>
                            <div class="spinner-border text-primary carga-captura-oido" role="status" style="display: none;">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </form>
                    <textarea name="audiometria_oido_izquierdo" class="form-textarea-content" style="width: 100%;margin: 0px;" placeholder="Conducto auditivo externo..." id="audiometria_oido_izquierdo"></textarea>

                </div>
                <div class="col-6">
                    <div class="text-center" id="contend-oido-izq">
                    </div>
                </div>
            </div>
        </div>

        <!-- Aqui va el oido izquierdo -->
        <div class="rounded p-3 shadow my-2">
            <div class="row">
                <div class="col-6">
                    <h5>Subir captura de Oído derecho</h5>
                    <form id="subirCapturaOidoDerecho" class="d-flex flex-column align-items-center">
                        <div id="dropOidoDerecho" class="drop-zone mx-2">
                            <label for="file-captura-oido-derecho" style="cursor: pointer;" class="label-captura-oido">Sube
                                tu
                                archivo
                                arrastrándolo
                                aquí</label>

                            <input type="file" id="file-captura-oido-derecho" name="file-captura-oido-derecho[]" style="display: none;">
                            <br>
                            <div class="spinner-border text-primary carga-captura-oido" role="status" style="display: none;">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </form>
                    <textarea name="audiometria_oido_derecho" class="form-textarea-content" style="width: 100%;margin: 0px;" placeholder="Conducto auditivo externo..." id="audiometria_oido_derecho"></textarea>
                </div>

                <div class="col-6">
                    <div class="text-center" id="contend-oido-der">
                    </div>
                </div>
            </div>
        </div>


        <!-- Otoscopia -->
        <div class="rounded p-3 shadow my-2">
            <!-- <h4>Otoscopía</h4> -->
            <p>Ambos pabellones:</p>
            <div class="p-4">
                <textarea name="otoscopia" rows="10" cols="90" class="form-textarea-content" placeholder="Análisis" id="textArea-otoscopia" style="width: 100%;margin: 0px !important;"></textarea>
            </div>
        </div>
    </section>

    <!-- Audiometria -->
    <section class="page px-4" style="display: none;">
        <form id="formSubirInterpretacionAudio-2">
            <h4>Audimetría</h4>
            <!-- Tabla de HZ -->

            <div class="rounded p-3 shadow my-2">
                <div class="d-flex">
                    <p class="me-3">Se realiza audiometría aérea, con los siguientes datos:</p>
                    <button type="button" class="btn btn-pantone-3165 btn-sm" id="AbrirModalCapturarTabla">
                        <i class="bi bi-table me-2"></i>Capturar Tabla
                    </button>
                </div>

                <div class="row">
                    <div class="col-12 col-xl-6">
                        <div class="rounded p-3 shadow my-2">
                            <h5><i class="bi bi-images"></i> Capturas</h5>
                            <div class="" id="captures">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-6">
                        <div class="px-3">
                            <table class="table mt-3 display responsive" id="tableAudioOido" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="oido all">Oído</th>
                                        <th class="hz all">500hz</th>
                                        <th class="hz all">1000hz</th>
                                        <th class="hz all">2000hz</th>
                                        <th class="hz min-tablet">3000hz</th>
                                        <th class="hz min-tablet">4000hz</th>
                                        <th class="hz min-tablet">6000hz</th>
                                        <th class="hz min-tablet">8000hz</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>OD</td>
                                        <td><input type="number" name="values[OD][500hz]" class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OD][1000hz]" class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OD][2000hz]" class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OD][3000hz]" class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OD][4000hz]" class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OD][6000hz]" class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OD][8000hz]" class="form-control input-form text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>OI</td>
                                        <td><input type="number" name="values[OI][500hz]" class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OI][1000hz]" class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OI][2000hz]" class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OI][3000hz]" class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OI][4000hz]" class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OI][6000hz]" class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OI][8000hz]" class="form-control input-form text-center">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Comentarios -->
                <div class="col-12 col-xl-6">
                    <div class="rounded p-3 shadow my-2">
                        <h4>Comentarios</h4>
                        <!-- <p></p> -->
                        <div class="p-4">
                            <textarea name="comentario" rows="10" cols="90" class="form-textarea-content" placeholder="Conclusiones" id="audio-comenConclucion" style="width: 100%;margin: 0px !important;"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="comentario_oido_derecho" class="form-label">Oído Derecho:</label>
                                <input type="text" class="form-control input-form" name="comentario_oido_derecho" placeholder="" id="comentario_oido_derecho">
                            </div>
                            <div class="col-12">
                                <label for="comentario_oido_izquierdo" class="form-label">Oído Izquierdo:</label>
                                <input type="text" class="form-control input-form" name="comentario_oido_izquierdo" placeholder="" id="comentario_oido_izquierdo">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recomendaciones -->
                <div class="col-12 col-xl-6">
                    <div class="rounded p-3 shadow my-2">
                        <h4>Recomendaciones</h4>
                        <!-- <p></p> -->
                        <div class="p-4">
                            <textarea name="recomendaciones" rows="10" cols="90" class="form-textarea-content" placeholder="Uso de protección..." id="textArea-recomendaciones" style="width: 100%;margin: 0px !important;"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>







    <!-- Columna 1 -->
    <!-- <div class="col-12 col-xl-6">
            <div class="row">
                <div class="col-12">
                    <div class="rounded p-3 shadow my-2">
                        <h4>Antecedentes</h4>
                        <div class="row" id="div-antecedentes"> -->
    <!-- Consumo de tabaco -->
    <!-- <div class="mb-4 row d-flex justify-content-center pregunta"
                                style="font-size: 20px;">
                                <div class="col-12 col-lg-8">
                                    <label>¿Antecedente de tabaquismo?: </label>
                                </div>
                                <div class="col-12 col-lg-4 row d-flex align-items-start justify-content-center">
                                    <div class="col-auto">
                                        <input type="radio" required id="tabaco_1" name="antecedentes[1][option]"
                                            value="1">
                                        <label for="tabaco_1">Sí</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="radio" required id="tabaco_2" name="antecedentes[1][option]"
                                            value="2">
                                        <label for="tabaco_2">No</label>
                                    </div>
                                </div>
                                <div class="target-1 collapse">
                                    <textarea name="antecedentes[1][comentario]" class="form-control input-form"
                                        rows="2" cols="2" placeholder="Especifique"></textarea>
                                </div>
                            </div> -->
    <!-- Exposicion ruid -->
    <!-- <div class="mb-4 row d-flex justify-content-center pregunta"
                                style="font-size: 20px;">
                                <div class="col-12 col-lg-8">
                                    <label>¿Exposición a ruido?: </label>
                                </div>
                                <div class="col-12 col-lg-4 row d-flex align-items-start justify-content-center">
                                    <div class="col-auto">
                                        <input type="radio" required id="ruido_1" name="antecedentes[2][option]"
                                            value="1">
                                        <label for="ruido_1">Sí</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="radio" required id="ruido_2" name="antecedentes[2][option]"
                                            value="2">
                                        <label for="ruido_2">No</label>
                                    </div>
                                </div>
                                <div class="target-2 collapse">
                                    <textarea name="antecedentes[2][comentario]" class="form-control input-form"
                                        rows="2" cols="2" placeholder="Especifique"></textarea>
                                </div> 
                            </div>
                            <hr class="mt-2">-->
    <!-- Exposicion solventes -->
    <!-- <div class="mb-4 row d-flex justify-content-center pregunta"
                                style="font-size: 20px;">
                                <div class="col-12 col-lg-8">
                                    <label>¿Exposición a solventes?: </label>
                                </div>
                                <div class="col-12 col-lg-4 row d-flex align-items-start justify-content-center">
                                    <div class="col-auto">
                                        <input type="radio" required id="solventes_1" name="antecedentes[3][option]"
                                            value="1">
                                        <label for="solventes_1">Sí</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="radio" required id="solventes_2" name="antecedentes[3][option]"
                                            value="2">
                                        <label for="solventes_2">No</label>
                                    </div>
                                </div>
                                <div class="target-3 collapse">
                                    <textarea name="antecedentes[3][comentario]" class="form-control input-form"
                                        rows="2" cols="2" placeholder="Especifique"></textarea>
                                </div>
                            </div> -->
    <!-- Exposicion traumaticos -->
    <!-- <div class="mb-4 row d-flex justify-content-center pregunta"
                                style="font-size: 20px;">
                                <div class="col-12 col-lg-8">
                                    <label>¿Antecedente de traumatismo?: </label>
                                </div>
                                <div class="col-12 col-lg-4 row d-flex align-items-start justify-content-center">
                                    <div class="col-auto">
                                        <input type="radio" required id="traumas_1" name="antecedentes[4][option]"
                                            value="1">
                                        <label for="traumas_1">Sí</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="radio" required id="traumas_2" name="antecedentes[4][option]"
                                            value="2">
                                        <label for="traumas_2">No</label>
                                    </div>
                                </div>
                                <div class="target-4 collapse">
                                    <textarea name="antecedentes[4][comentario]" class="form-control input-form"
                                        rows="2" cols="2" placeholder="Especifique"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

    <!-- <div class="col-12"> -->
    <!-- <div class="rounded p-3 shadow my-2">
                        <h4>Audimetría</h4>
                        <p>Se realiza audiometría aérea, con los siguientes datos:</p>
                        <div class="px-3">
                            <table class="table mt-3 display responsive" id="tableAudioOido" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="oido all">Oído</th>
                                        <th class="hz all">500hz</th>
                                        <th class="hz all">1000hz</th>
                                        <th class="hz all">2000hz</th>
                                        <th class="hz min-tablet">3000hz</th>
                                        <th class="hz min-tablet">4000hz</th>
                                        <th class="hz min-tablet">6000hz</th>
                                        <th class="hz min-tablet">8000hz</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>OD</td>
                                        <td><input type="number" name="values[OD][500hz]"
                                                class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OD][1000hz]"
                                                class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OD][2000hz]"
                                                class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OD][3000hz]"
                                                class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OD][4000hz]"
                                                class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OD][6000hz]"
                                                class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OD][8000hz]"
                                                class="form-control input-form text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>OI</td>
                                        <td><input type="number" name="values[OI][500hz]"
                                                class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OI][1000hz]"
                                                class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OI][2000hz]"
                                                class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OI][3000hz]"
                                                class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OI][4000hz]"
                                                class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OI][6000hz]"
                                                class="form-control input-form text-center">
                                        </td>
                                        <td><input type="number" name="values[OI][8000hz]"
                                                class="form-control input-form text-center">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div> -->

    <!-- <div class="col-12">
                    <div class="rounded p-3 shadow my-2">
                        <h4>Comentarios</h4> -->
    <!-- <p></p> -->
    <!-- <div class="p-4">
                            <textarea name="comentario" rows="10" cols="90" class="form-textarea-content"
                                placeholder="Conclusiones" id="audio-comenConclucion"
                                style="width: 100%;margin: 0px !important;"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="comentario_oido_derecho" class="form-label">Oído Derecho:</label>
                                <input type="text" class="form-control input-form" name="comentario_oido_derecho"
                                    placeholder="" id="comentario_oido_derecho">
                            </div>
                            <div class="col-12">
                                <label for="comentario_oido_izquierdo" class="form-label">Oído Izquierdo:</label>
                                <input type="text" class="form-control input-form" name="comentario_oido_izquierdo"
                                    placeholder="" id="comentario_oido_izquierdo">
                            </div>
                        </div>
                    </div>
                </div>

            </div> -->
    <!-- </div> -->

    <!-- Columna 2 -->
    <!-- <div class="col-12 col-xl-6">
            <div class="row">
                <div class="col-12"> -->

    <!-- <div class="rounded p-3 shadow my-2">
                        <h4>Otoscopía</h4> -->
    <!-- <p>Se realiza audiometría aérea, con los siguientes datos:</p> -->
    <!-- <div class="p-4">
                            <textarea name="otoscopia" rows="10" cols="90" class="form-textarea-content"
                                placeholder="Ambos pabellones..." id="textArea-otoscopia"
                                style="width: 100%;margin: 0px !important;"></textarea>
                        </div> -->
    <!-- <div class="input-file-contenedor">
                            <label for="img_otoscopia" class="form-label">Cargue imagenes de otoscopía</label>
                            <label for="img_otoscopia" class="input-file-label">
                                <i class="bi bi-box-arrow-up"></i> Seleccione archivo(s)
                            </label>
                            <input type="file" name="img_otoscopia[]" id="img_otoscopia"
                                accept=".png, .jpg, .jpeg, .pdf" multiple required class="input-file">
                        </div> -->
    <!-- </div> -->

    <!-- </div> -->

    <!-- <div class="col-12">
                    <div class="rounded p-3 shadow my-2">
                        <h4>Audimetría</h4>
                        <p>Se realiza audiometría aérea, con los siguientes datos:</p>
                        <div class="px-3">
                            <table class="table mt-3 display responsive" id="oidosDescripcion" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="all">Oído Derecho</th>
                                        <th class="all">Oído Izquierdo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><textarea name="audiometria_oido_derecho" class="form-textarea-content"
                                                style="width: 100%;margin: 0px;"
                                                placeholder="Conducto auditivo externo..."
                                                id="audiometria_oido_derecho"></textarea>
                                        </td>
                                        <td><textarea name="audiometria_oido_izquierdo" class="form-textarea-content"
                                                style="width: 100%;margin: 0px;"
                                                placeholder="Conducto auditivo externo..."
                                                id="audiometria_oido_izquierdo"></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div> -->
    <!--  <div class="col-12">
                    <div class="rounded p-3 shadow my-2">
                        <h4>Recomendaciones</h4> -->
    <!-- <p></p> -->
    <!-- <div class="p-4">
                            <textarea name="recomendaciones" rows="10" cols="90" class="form-textarea-content"
                                placeholder="Uso de protección..." id="textArea-recomendaciones"
                                style="width: 100%;margin: 0px !important;"></textarea>
                        </div>
                    </div>
                </div> -->

    <!-- </div>
        </div> -->
</div>

<!-- <div class="row my-4">
        <hr class="mt-2">
        
        <div class="col-12 col-lg-8">
            <div class="rounded p-2 shadow my-2">

                <h4>Tabla de resultados</h4>
                <p>Cargue, visualice y capture las tablas de reporte del equipo.</p>

                <div id="viewer"> </div>
            </div>
        </div>

        
        <div class="col-12 col-lg-4">
            <div class="mb-4">
                <div class="input-file-contenedor">
                    <label for="reporte_equipo" class="form-label">Cargar reporte</label>
                    <label for="reporte_equipo" class="input-file-label">
                        <i class="bi bi-box-arrow-up"></i> Seleccione archivo(s)
                    </label>
                    <input type="file" name="reporte_equipo[]" id="reporte_equipo" accept=".png, .jpg, .jpeg, .pdf"
                        required class="input-file">
                </div>
            </div>
            <div class="mb-4">
                <button type="button" id="capture" class="btn btn-option w-100"><i class="bi bi-camera"></i>
                    Capturar</button>
            </div>
            <div class="rounded p-3 shadow my-2">
                <h5><i class="bi bi-images"></i> Capturas</h5>
                <div class="" id="captures">
                </div>
            </div>
        </div>
    </div> -->

<!-- </form> -->

<style>
    #viewer {
        height: 75vh;
        overflow-y: scroll;
        border: 1px solid #ccc;
    }

    #captures img {
        width: 100%;
        height: auto;
        margin: 5px;
        border: 1px solid #ccc;
    }

    .page.animate__animated {
        animation-duration: 0.5s;
        /* Ajusta este valor según lo rápido que quieras que sea */
    }

    .container-pages {
        position: relative;
    }

    .page {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
    }
</style>

<script>
    $(document).on("change keyup", "input[type='radio']", function() {
        const parentElement = $(this).closest(".row.d-flex.justify-content-center.pregunta");
        // console.log(parentElement)
        let collapID = parentElement.children(".collapse");
        // console.log(collapID);
        if (!collapID) return; // Si no hay ID, no hacer nada

        if (this.value == true) {
            $(collapID).collapse("show") //.find(':textarea').prop('required', true);
        } else {
            $(collapID).collapse("hide") //.find(':textarea').val('').prop('required', false);
        }
    });



    $('#tableAudioOido').DataTable({
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        lengthChange: false,
        info: false,
        paging: false,
        columnDefs: [{
                width: "5%",
                targets: 0
            },
            {
                width: "10%",
                targets: [1, 2, 3, 4, 5, 6, 7]
            },
        ],
        ordering: false,
        searching: false,
    })


    $('#oidosDescripcion').DataTable({
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        lengthChange: false,
        info: false,
        paging: false,
        columnDefs: [{
            width: "50%",
            targets: [0, 1]
        }, ],
        ordering: false,
        searching: false,
    })
</script>