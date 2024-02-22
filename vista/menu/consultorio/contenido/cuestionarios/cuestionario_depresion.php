<?php

$encuesta = [
    1 => [
        'descripcion' => 'satisfaccion_vida',
        'pregunta' => '¿En general, está satisfecho(a) con su vida?'
    ],
    2 => [
        'descripcion' => 'abandono_tareas_aficiones',
        'pregunta' => '¿Ha abandonado muchas de sus tareas habituales y aficiones?'
    ],
    3 => [
        'descripcion' => 'vida_vacia',
        'pregunta' => '¿Siente que su vida está vacía?'
    ],
    4 => [
        'descripcion' => 'frecuencia_aburrimiento',
        'pregunta' => '¿Se siente con frecuencia aburrido(a)?'
    ],
    5 => [
        'descripcion' => 'buen_humor',
        'pregunta' => '¿Se encuentra de buen humor la mayor parte del tiempo?'
    ],
    6 => [
        'descripcion' => 'temor_malo_ocurrir',
        'pregunta' => '¿Teme que algo malo pueda ocurrirle?'
    ],
    7 => [
        'descripcion' => 'felicidad',
        'pregunta' => '¿Se siente feliz la mayor parte del tiempo?'
    ],
    8 => [
        'descripcion' => 'desamparado_desprotegido',
        'pregunta' => '¿Con frecuencia se siente desamparado(a), desprotegido(a)?'
    ],
    9 => [
        'descripcion' => 'preferencia_hogar',
        'pregunta' => '¿Prefiere usted quedarse en casa, más que salir y hacer cosas nuevas?'
    ],
    10 => [
        'descripcion' => 'problemas_memoria',
        'pregunta' => '¿Cree que tiene más problemas de memoria que la mayoría de la gente?'
    ],
    11 => [
        'descripcion' => 'placer_vida',
        'pregunta' => '¿En estos momentos, piensa que es estupendo estar vivo(a)?'
    ],
    12 => [
        'descripcion' => 'sentirse_inutil',
        'pregunta' => '¿Actualmente se siente un(a) inútil?'
    ],
    13 => [
        'descripcion' => 'lleno_energia',
        'pregunta' => '¿Se siente lleno(a) de energía?'
    ],
    14 => [
        'descripcion' => 'sin_esperanza',
        'pregunta' => '¿Se siente sin esperanza en este momento?'
    ],
    15 => [
        'descripcion' => 'mejor_situacion_otros',
        'pregunta' => '¿Piensa que la mayoría de la gente está en mejor situación que usted?'
    ],
];

// Suponiendo que ya tienes el array $antecedentes definido con las preguntas

// Función para generar el HTML de una pregunta
function generarHTMLPregunta($id, $descripcion, $pregunta)
{
    // Modificado para excluir la sección de comentarios
    return <<<HTML
                        <!-- Pregunta de $descripcion -->
                        <div class="mb-4 row d-flex justify-content-center pregunta" style="font-size: 20px;">
                            <div class="col-12 col-lg-8">
                                <label>{$pregunta}:</label>
                            </div>
                            <div class="col-12 col-lg-4 row d-flex align-items-start justify-content-center">
                                <div class="col-auto">
                                    <input type="radio" required id="{$descripcion}_1" name="cuestionarioDepresion[$id][option]" value="1">
                                    <label for="{$descripcion}_1">Sí</label>
                                </div>
                                <div class="col-auto">
                                    <input type="radio" required id="{$descripcion}_2" name="cuestionarioDepresion[$id][option]" value="2">
                                    <label for="{$descripcion}_2">No</label>
                                </div>
                            </div>
                        </div>
                        <hr>
HTML;
}

// Inicio del HTML del formulario
$html = '<div class="mt-3" id="cuestionarioDepresion-preguntas">';

// Generar HTML para cada pregunta
foreach ($encuesta as $id => $datos) {
    $descripcion = str_replace(' ', '_', $datos['descripcion']);
    $pregunta = $datos['pregunta'];
    $html .= generarHTMLPregunta($id, $descripcion, $pregunta);
}

$html .= '</div>'; // Fin del HTML del formulario

?>


<div class="col-12 loader" id="loader">
    <div class="preloader" id="preloader"> </div>
</div>


<div class="container-fluid" style="z-index:5">
    <div class="row" id="menu-consultorio">
        <div class="col-8 row">
            <div class="col-auto d-flex justify-content-center align-items-center">
                <a href="" id="btn-regresar-vista" onclick="event.preventDefault()"><i class="bi bi-chevron-bar-left"></i>
                    Regresar</a>
            </div>
            <div class="col-auto">
                <h4 class="m-3" id="nombre-paciente-consulta">Nombre del paciente</h4>
            </div>
            <div class="col-12 row" style="margin-left:10px">
                <div class="col-auto">
                    <p class="info-detalle-p" id="nacimiento-paciente-consulta">fecha nacimiento</p>
                </div>
                <div class="col-auto">
                    <p class="info-detalle-p" id="edad-paciente-consulta"> </p>
                </div>
                <div class="col-auto">
                    <p class="info-detalle-p" id="genero-paciente-consulta"> </p>
                </div>
                <div class="col-auto" style="display: none;">
                    <p class="info-detalle-p" id="correo-paciente-consulta"> </p>
                </div>
                <div class="col-auto" style="display: none;">
                    <p class="info-detalle-p" id="curp-paciente-consulta"> </p>
                </div>
            </div>
        </div>
        <div class="col-4 d-flex justify-content-end">
            <button type="button" class="btn btn-hover me-2" style="margin: 15px 60px 10px 60px !important;font-size: 21px;" id="btn-formCuestionarioDepresion">
                <i class="bi bi-clipboard2-check"></i> Guardar cuestionario
            </button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-4 mb-2 mt-3">
        <div id="signos-vitales" style="display: none;" class="rounded p-3 shadow-sm my-2 position-relative "></div>
    </div>

    <div class="col-12 col-lg-8">
        <div class="overflow-auto" style="margin-bottom: 10px" id="vista-valoracion">
            <h3>Cuestionario de Depresión Geriátrica</h3>

            <p class="mt-3">Le voy a hacer algunas preguntas para evaluar su estado de ánimo, tome en cuenta únicamente cómo se ha sentido durante la última semana,
                por favor responda con Sí o No</p>

            <form id="formCuestionarioDepresion">
                <?php
                // Imprimir el HTML
                echo $html;
                ?>
            </form>


            <script>
                autoHeightDiv('#vista-valoracion', 157);
                $(window).resize(function() {
                    autoHeightDiv('#vista-valoracion', 157);
                })
            </script>
        </div>
    </div>
</div>




<style>
    #menu-consultorio {
        background-color: rgb(246, 253, 255);
        z-index: 5
    }
</style>