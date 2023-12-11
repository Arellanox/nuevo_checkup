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
            <div class="modal-body">
                <form id="formInterpretacion">
                    <div class="row container-pages m-2">
                        <!-- Interrogatorio -->
                        <section>
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
                                            <input type="hidden" name="antecedentes[6][id]" value=6">
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
                                </div>
                            </div>
                        </section>

                        <section>
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


                        <section>
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

                        <section>
                            <div class="rounded p-3 shadow my-2">
                                <h4>Riesgo quirúrco</h4>
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="p-2">
                                            <div>
                                                <label>ASA: </label>
                                                <input type="hidden" name="riesgo[1][id]" value="1">
                                                <select name="riesgo[1][valor]" id="select-asa" class="form-control">
                                                    <option value="">1</option>
                                                    <option value="">2</option>
                                                    <option value="">3</option>
                                                    <option value="">4</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label>GOLDMAN: </label>
                                                <input type="hidden" name="riesgo[2][id]" value="2">
                                                <select name="riesgo[2][valor]" id="select-goldman" class="form-control">
                                                    <option value="">1</option>
                                                    <option value="">2</option>
                                                    <option value="">3</option>
                                                    <option value="">4</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label>GENEVA: </label>
                                                <input type="hidden" name="riesgo[3][id]" value="3">
                                                <input type="text" class="form-control input-form" name="riesgo[3][valor]">
                                            </div>

                                            <div>
                                                <label>CAPRINI: </label>
                                                <input type="hidden" name="riesgo[4][id]" value="4">
                                                <input type="text" class="form-control input-form" name="riesgo[4][valor]">
                                            </div>

                                            <div>
                                                <label>STOP-BAN: </label>
                                                <input type="hidden" name="riesgo[5][id]" value="5">
                                                <input type="text" class="form-control input-form" name="riesgo[5][valor]">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-12 col-lg-8">
                                        <div class="p-2">
                                            <div>
                                                <label>GUPTA RESPIRATORIO: </label>
                                                <input type="hidden" name="riesgo[6][id]" value="6">
                                                <textarea name="riesgo[6][valor]" class="form-control input-form" rows="2" cols="1" placeholder="Especifique"></textarea>
                                            </div>
                                            <div>
                                                <label>GUPTA NEUMONIA: </label>
                                                <input type="hidden" name="riesgo[7][id]" value="7">
                                                <textarea name="riesgo[7][valor]" class="form-control input-form" rows="2" cols="1" placeholder="Especifique"></textarea>
                                            </div>
                                            <div>
                                                <label>GUPTA CARDIOVASCULAR: </label>
                                                <input type="hidden" name="riesgo[8][id]" value="8">
                                                <textarea name="riesgo[8][valor]" class="form-control input-form" rows="2" cols="1" placeholder="Especifique"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </section>

                        <section>
                            <div class="rounded p-3 shadow my-2">
                                <h4>Recomendaciones</h4>
                            </div>
                        </section>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">
                    <i class="bi bi-arrow-left-short"></i> Cancelar
                </button>
                <button type="submit" form="formInterpretacion" class="btn btn-confirmar">
                    <i class="bi bi-send-plus"></i> Cargar
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

        if (this.value == true) {
            $(collapID).collapse("show") //.find(':textarea').prop('required', true);
        } else {
            $(collapID).collapse("hide") //.find(':textarea').val('').prop('required', false);
        }
    });
</script>