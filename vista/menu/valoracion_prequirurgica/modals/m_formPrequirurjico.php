<style>
    .pregunta {
        margin-top: 20px;
        font-size: 16px;
        color: black !important;
    }

    .respuesta {
        font-size: 14px;
    }
</style>


<div class="modal fade" id="MostrarCapturaPrequirurjico" tabindex="-1" aria-labelledby="formulario_pre" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-fullscreen modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CapturasPrequirurgica">Formulario Prequirurgico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="overflow-x: hidden;">
                <form id="formInterpretacion">
                    <div class="row container-pages m-2">
                        <!-- Interrogatorio -->
                        <section class="page px-4" style="display: none;">
                            <div class="rounded p-3 shadow my-2">
                                <h4>Antecedentes</h4>
                                <div class="row">

                                    <!-- Siguió Objetos -->
                                    <div class="col-12 m-1 row d-flex justify-content-center pregunta" style="font-size: 20px;">
                                        <div class="col-12">
                                            <label>Antecedente Personales Patológicos</label>
                                            <input type="hidden" name="antecedentes[1][id]" value="1">
                                        </div>
                                        <div class="col-12 target-1">
                                            <textarea name="antecedentes[1][comentario]" class="form-control input-form" placeholder="" type="text" rows="2" cols="2"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-4 row d-flex justify-content-center pregunta" style="font-size: 20px;">
                                        <div class="col-12 col-lg-8">
                                            <label>Antecedente Quirúrgicos: </label>
                                            <input type="hidden" name="antecedentes[2][id]" value="2">
                                        </div>
                                        <div class="col-12 col-lg-4 row d-flex align-items-start justify-content-center">
                                            <div class="col-auto">
                                                <input type="radio" required id="quirurgico_1" name="antecedentes[2][option]" value="1">
                                                <label for="quirurgico_1">Sí</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="radio" required id="quirurgico_2" name="antecedentes[2][option]" value="2">
                                                <label for="quirurgico_2">No</label>
                                            </div>
                                        </div>
                                        <div class="target-1 collapse">
                                            <textarea name="antecedentes[2][comentario]" class="form-control input-form" rows="2" cols="2" placeholder="Cuáles"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-4 row d-flex justify-content-center pregunta" style="font-size: 20px;">
                                        <div class="col-12 col-lg-8">
                                            <label>Antecedente de fracturas: </label>
                                            <input type="hidden" name="antecedentes[3][id]" value="3">
                                        </div>
                                        <div class="col-12 col-lg-4 row d-flex align-items-start justify-content-center">
                                            <div class="col-auto">
                                                <input type="radio" required id="fracturas_1" name="antecedentes[3][option]" value="1">
                                                <label for="fracturas_1">Sí</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="radio" required id="fracturas_2" name="antecedentes[3][option]" value="2">
                                                <label for="fracturas_2">No</label>
                                            </div>
                                        </div>
                                        <div class="target-2 collapse">
                                            <textarea name="antecedentes[3][comentario]" class="form-control input-form" rows="2" cols="2" placeholder="Cuáles"></textarea>
                                        </div>
                                    </div>
                                    <hr class="dropdown-divider m-2">

                                    <div class="col-12 col-lg-6 mb-4 row d-flex justify-content-center pregunta" style="font-size: 20px;">
                                        <div class="col-12 col-lg-8">
                                            <label>Hospitalizaciones previas: </label>
                                            <input type="hidden" name="antecedentes[4][id]" value="4">
                                        </div>
                                        <div class="col-12 col-lg-4 row d-flex align-items-start justify-content-center">
                                            <div class="col-auto">
                                                <input type="radio" required id="hospitalizacion_1" name="antecedentes[4][option]" value="1">
                                                <label for="hospitalizacion_1">Sí</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="radio" required id="hospitalizacion_2" name="antecedentes[4][option]" value="2">
                                                <label for="hospitalizacion_2">No</label>
                                            </div>
                                        </div>
                                        <div class="target-3 collapse">
                                            <textarea name="antecedentes[4][comentario]" class="form-control input-form" rows="2" cols="2" placeholder="Cuáles"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-4 row d-flex justify-content-center pregunta" style="font-size: 20px;">
                                        <div class="col-12 col-lg-8">
                                            <label>Alergias: </label>
                                            <input type="hidden" name="antecedentes[5][id]" value="5">
                                        </div>
                                        <div class="col-12 col-lg-4 row d-flex align-items-start justify-content-center">
                                            <div class="col-auto">
                                                <input type="radio" required id="alergias_1" name="antecedentes[5][option]" value="1">
                                                <label for="alergias_1">Sí</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="radio" required id="alergias_2" name="antecedentes[5][option]" value="2">
                                                <label for="alergias_2">No</label>
                                            </div>
                                        </div>
                                        <div class="target-3 collapse">
                                            <textarea name="antecedentes[5][comentario]" class="form-control input-form" rows="2" cols="2" placeholder="Cuáles"></textarea>
                                        </div>
                                    </div>
                                    <!-- Exposicion traumaticos -->
                                    <div class="col-12 col-lg-6 mb-4 row d-flex justify-content-center pregunta" style="font-size: 20px;">
                                        <div class="col-12 col-lg-8">
                                            <label>Tabaquimo: </label>
                                            <input type="hidden" name="antecedentes[6][id]" value="6">
                                        </div>
                                        <div class="col-12 col-lg-4 row d-flex align-items-start justify-content-center">
                                            <div class="col-auto">
                                                <input type="radio" required id="tabaquismo_1" name="antecedentes[6][option]" value="1">
                                                <label for="tabaquismo_1">Sí</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="radio" required id="tabaquismo_2" name="antecedentes[6][option]" value="2">
                                                <label for="tabaquismo_2">No</label>
                                            </div>
                                        </div>
                                        <div class="target-4 collapse">
                                            <textarea name="antecedentes[6][comentario]" class="form-control input-form" rows="2" cols="2" placeholder="Cantidad"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-4 row d-flex justify-content-center pregunta" style="font-size: 20px;">
                                        <div class="col-12 col-lg-8">
                                            <label>Alcoholismo: </label>
                                            <input type="hidden" name="antecedentes[7][id]" value="7">
                                        </div>
                                        <div class="col-12 col-lg-4 row d-flex align-items-start justify-content-center">
                                            <div class="col-auto">
                                                <input type="radio" required id="alcoholismo_1" name="antecedentes[7][option]" value="1">
                                                <label for="alcoholismo_1">Sí</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="radio" required id="alcoholismo_2" name="antecedentes[7][option]" value="2">
                                                <label for="alcoholismo_2">No</label>
                                            </div>
                                        </div>
                                        <div class="target-4 collapse">
                                            <textarea name="antecedentes[7][comentario]" class="form-control input-form" rows="2" cols="2" placeholder="Cantidad y Frecuencia"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-4 row d-flex justify-content-center pregunta" style="font-size: 20px;">
                                        <div class="col-12 col-lg-8">
                                            <label>Toxicomanias: </label>
                                            <input type="hidden" name="antecedentes[8][id]" value="8">
                                        </div>
                                        <div class="col-12 col-lg-4 row d-flex align-items-start justify-content-center">
                                            <div class="col-auto">
                                                <input type="radio" required id="toxicomanias_1" name="antecedentes[8][option]" value="1">
                                                <label for="toxicomanias_1">Sí</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="radio" required id="toxicomanias_2" name="antecedentes[8][option]" value="2">
                                                <label for="toxicomanias_2">No</label>
                                            </div>
                                        </div>
                                        <div class="target-4 collapse">
                                            <textarea name="antecedentes[8][comentario]" class="form-control input-form" rows="2" cols="2" placeholder="Cuál y Frecuencia"></textarea>
                                        </div>
                                    </div>


                                    <div class="col-12 col-lg-6 mb-4 row d-flex justify-content-center pregunta" style="font-size: 20px;">
                                        <div class="col-12 col-lg-4">
                                            <label>Cirugía programada: </label>
                                            <!-- <input type="hidden" name="cirugia[8][id]" value="8"> -->
                                            <!-- <textarea name="radiografia_torax" class="form-control input-form" rows="4" cols="2" placeholder="Especifique"></textarea> -->
                                            
                                        </div>

                                        <div class="col-12 col-lg-8 row d-flex align-items-start justify-content-center">
                                        <input type="text" class="form-control input-form" id="cirugia_programada" name="cirugia_programada">
                                        </div>
                                        <!-- <div class="target-4 collapse">
                                            <textarea name="antecedentes[8][comentario]" class="form-control input-form" rows="2" cols="2" placeholder="Cuál y Frecuencia"></textarea>
                                        </div> -->

                                    </div>

                                </div>
                            </div>
                        </section>

                        <section class="page px-4" style="display: none;">
                            <div class="rounded p-3 shadow my-2">
                                <h4>Exploración</h4>
                                <div class="row" id="">
                                    <div class="col-12 col-lg-4">

                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <p class="pregunta">TENSIÓN ARTERIAL</p>
                                                <p class="respuesta"><strong>120/83 MMHG</strong></p>
                                            </div>

                                            <div class="col-12 col-lg-6">
                                                <p class="pregunta">FRECUENCIA CARDIACA</p>
                                                <p class="respuesta"><strong>66 LATIDOS POR MINUTO</strong></p>
                                            </div>

                                            <div class="col-12 col-lg-6">
                                                <p class="pregunta">FRECUENCIA RESPIRATORIA</p>
                                                <p class="respuesta"><strong>20 RESPIRACIONES POR MINUTO</strong></p>
                                            </div>

                                            <div class="col-12 col-lg-6">
                                                <p class="pregunta">TEMPERATURA</p>
                                                <p class="respuesta"><strong>35.8°C</strong></p>
                                            </div>

                                            <div class="col-12 col-lg-6">
                                                <p class="pregunta">SATURACIÓN DE OXÍEGNO</p>
                                                <p class="respuesta"><strong>96 %</strong></p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-12 col-lg-8">
                                        <label>Exploración física: </label>
                                        <textarea name="exploracion_fisica" class="form-control input-form" rows="4" cols="2" placeholder="Especifique"></textarea>
                                    </div>
                                </div>

                            </div>
                        </section>

                        <section class="page px-4" style="display: none;">
                            <div class="rounded p-3 shadow my-2">
                                <h4>Laboratorios</h4>
                                <div class="row">
                                    <div class="col-12 col-lg-4">

                                    </div>

                                    <div class="col-12 col-lg-8">
                                        <div class="col-12 col-lg-12">
                                            <label>Electrocardiograma 12 derivaciones: </label>
                                            <textarea name="electro_derivaciones" class="form-control input-form" rows="4" cols="2" placeholder="Especifique"></textarea>
                                        </div>

                                        <div class="col-12 col-lg-12">
                                            <label>Radiografía de torax: </label>
                                            <textarea name="radiografia_torax" class="form-control input-form" rows="4" cols="2" placeholder="Especifique"></textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="page px-4" style="display: none;">
                            <div class="rounded p-3 shadow my-2">
                                <h4>Riesgo quirúrco</h4>
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="p-2">
                                            <div>
                                                <label>ASA: </label>
                                                <!-- <input type="hidden" name="riesgo[1][id]" value="1"> -->
                                                <select name="ASA" id="select-asa" class="input-form form-control">
                                                    <option value="I">I</option>
                                                    <option value="II">II</option>
                                                    <option value="III">III</option>
                                                    <option value="IV">IV</option>
                                                    <option value="V">V</option>
                                                    <option value="VI">VI</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label>GOLDMAN: </label>
                                                <!-- <input type="hidden" name="riesgo[2][id]" value="2"> -->
                                                <select name="GOLDMAN" id="select-goldman" class="input-form form-control">
                                                    <option value="I">I</option>
                                                    <option value="II">II</option>
                                                    <option value="III">III</option>
                                                    <option value="IV">IV</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label>GENEVA: </label>
                                                <!-- <input type="hidden" name="riesgo[3][id]" value="3"> -->
                                                <input type="text" class="form-control input-form" name="GENEVA">
                                            </div>

                                            <div>
                                                <label>CAPRINI: </label>
                                                <!-- <input type="hidden" name="riesgo[4][id]" value="4"> -->
                                                <input type="text" class="form-control input-form" name="CAPRINI">
                                            </div>

                                            <div>
                                                <label>STOP-BAN: </label>
                                                <!-- <input type="hidden" name="riesgo[5][id]" value="5"> -->
                                                <input type="text" class="form-control input-form" name="STOP-BAN">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-12 col-lg-8">
                                        <div class="p-2">
                                            <div>
                                                <label>GUPTA RESPIRATORIO: </label>
                                                <!-- <input type="hidden" name="riesgo[6][id]" value="6"> -->
                                                <textarea name="gupta_respiratorio" class="form-control input-form" rows="2" cols="1" placeholder="Especifique"></textarea>
                                            </div>
                                            <div>
                                                <label>GUPTA NEUMONIA: </label>
                                                <!-- <input type="hidden" name="riesgo[7][id]" value="7"> -->
                                                <textarea name="gupta_neumonia" class="form-control input-form" rows="2" cols="1" placeholder="Especifique"></textarea>
                                            </div>
                                            <div>
                                                <label>GUPTA CARDIOVASCULAR: </label>
                                                <!-- <input type="hidden" name="riesgo[8][id]" value="8"> -->
                                                <textarea name="gupta_cardiovascular" class="form-control input-form" rows="2" cols="1" placeholder="Especifique"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </section>

                        <section class="page px-4" style="display: none;">
                            <div class="rounded p-3 shadow my-2">
                                <h4>Recomendaciones</h4>

                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <table id="tablalistRecomendaciones" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th class="p-1 fw-bold">#</th>
                                                    <th class="p-1">Recomendaciones</th>
                                                    <th class="p-1 text-center"><i class="bi bi-trash3"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_recomendaciones"></tbody>
                                        </table>
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <div>
                                            <label>Recomendaciones: </label>
                                            <!-- <input type="hidden" name="recomendacion[9][id]" value="9"> -->
                                            <textarea name="recomendaciones_texto" class="form-control input-form" rows="4" cols="1" placeholder="Especifique"></textarea>
                                        </div>

                                        <div>
                                            <label>Lista de recomendaciones: </label>
                                            <p>Agrega uno por uno las recomendaciones del paciente</p>
                                            <input type="text" class="form-control input-form" id="recomendaciones_list">
                                            <input type="hidden" name="recomendacion[10][valor]">

                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <button type="button" class="btn btn-confirmar" id="btn-agregarRecomendaciones">
                                                    <i class="bi bi-clipboard2-plus"></i> Agregar
                                                </button>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </section>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">
                    <i class="bi bi-arrow-left-short"></i> Cancelar
                </button>

                <!-- Paginacion del formulario -->
                <button type="button" class="btn control-pagina-interpretacion btn-cancelar" target="back">
                    <i class="bi bi-arrow-left"></i>
                    Regresar</button>
                <button type="button" class="btn control-pagina-interpretacion btn-cancelar" target="next">
                    <i class="bi bi-arrow-right"></i>
                    Siguiente</button>
                <!-- /////// -->

                <button type="button" class="btn btn-borrar" id="btn-vistaPrevia">
                    <i class="bi bi-file-earmark-pdf"></i> Vista previa

                </button>

                <button type="button" class="btn btn-confirmar" id="btn-guardarInterpretacion">
                    <i class="bi bi-clipboard2-plus"></i> Guardar interpretación
                </button>

                <button type="button" class="btn btn-confirmar" id="btn-confirmarReporte">
                    <i class="bi bi-clipboard2-plus"></i> Confirmar reporte
                </button>

            </div>
        </div>
    </div>
</div>


<script>
    $(document).on("change keyup", "input[type='radio']", function() {
        const parentElement = $(this).closest(".row.d-flex.justify-content-center.pregunta");
        // console.log(parentElement)
        let collapID = parentElement.children(".collapse");
        // console.log(collapID);
        if (!collapID) return; // Si no hay ID, no hacer nada

        let name = $(this).attr("name"); // sacamos el nombre para diferenciar el type de check que se esta haciendo click

        // construimos un arreglo con los inputs que seran casos especiales, como estos que el textarea tiene que aparecer si o si
        const includes = [
            "antecedentes[6][option]",
            "antecedentes[7][option]",
            "antecedentes[8][option]"
        ];

        if (this.value == true || includes.includes(name)) {
            $(collapID).collapse("show") //.find(':textarea').prop('required', true);
        } else {
            $(collapID).collapse("hide") //.find(':textarea').val('').prop('required', false);
        }
    });
</script>



<style>
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