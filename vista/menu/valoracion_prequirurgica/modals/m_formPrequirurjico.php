<div class="modal fade" id="MostrarCapturaPrequirurjico" tabindex="-1" aria-labelledby="CapturasPrequirurgica"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-fullscreen modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CapturasPrequirurgica">Formulario Prequirurgico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                
<form id="formSubirInterpretacionPRUEBA" style="display: none;">
    <div class="row container-pages">
    <!-- Interrogatorio -->
        <div class="rounded p-3 shadow my-2">
            <h4>Antecedentes</h4>
            <div class="row" id="div-antecedentes">

                <div class="">

                </div>

                <div class="col-12 col-md-6 mb-4 row d-flex justify-content-center pregunta"
                    style="font-size: 20px;">
                    <div class="col-12 col-lg-8">
                        <label>¿Antecedente quirúrgicos?: </label>
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
                </div>

                <div class="col-12 col-md-6 mb-4 row d-flex justify-content-center pregunta"
                    style="font-size: 20px;">
                    <div class="col-12 col-lg-8">
                        <label>¿¿Antecedente de fractura?: </label>
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
                <hr class="dropdown-divider m-2">

                <div class="col-12 col-md-6 mb-4 row d-flex justify-content-center pregunta"
                    style="font-size: 20px;">
                    <div class="col-12 col-lg-8">
                        <label>¿Hospitalizaciones previas?: </label>
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
                </div>
                <div class="col-12 col-md-6 mb-4 row d-flex justify-content-center pregunta"
                    style="font-size: 20px;">
                    <div class="col-12 col-lg-8">
                        <label>¿Alergias?: </label>
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
                </div>
                <!-- Exposicion traumaticos -->
                <div class="col-12 col-md-6 mb-4 row d-flex justify-content-center pregunta"
                    style="font-size: 20px;">
                    <div class="col-12 col-lg-8">
                        <label>¿Tabaquimo?: </label>
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
                </div>

                <div class="col-12 col-md-6 mb-4 row d-flex justify-content-center pregunta"
                    style="font-size: 20px;">
                    <div class="col-12 col-lg-8">
                        <label>¿Alcoholismo?: </label>
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
                </div>

                <div class="col-12 col-md-6 mb-4 row d-flex justify-content-center pregunta"
                    style="font-size: 20px;">
                    <div class="col-12 col-lg-8">
                        <label>¿Toxicomanias?: </label>
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
                </div>
            </div>
        </div>

        <div class="rounded p-3 shadow my-2">
            <h4>Antecedentes</h4>
            <div class="row" id="div-antecedentes">

            </div>
        </div>

    </div>

    </div>
</form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">
                    <i class="bi bi-arrow-left-short"></i> Cancelar
                </button>
                <button type="button" id="cargarElectroCaptura" class="btn btn-confirmar">
                    <i class="bi bi-send-plus"></i> Cargar
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).on("change keyup", "input[type='radio']", function () {
        const parentElement = $(this).closest(".row.d-flex.justify-content-center.pregunta");
        // console.log(parentElement)
        let collapID = parentElement.children(".collapse");
        // console.log(collapID);
        if (!collapID) return; // Si no hay ID, no hacer nada

        if (this.value == true) {
            $(collapID).collapse("show")//.find(':textarea').prop('required', true);
        } else {
            $(collapID).collapse("hide")//.find(':textarea').val('').prop('required', false);
        }
    });
</script>