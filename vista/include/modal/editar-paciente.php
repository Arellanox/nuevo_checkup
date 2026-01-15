<div class="modal fade" id="ModalEditarPaciente" tabindex="-1" aria-labelledby="filtrador" aria-hidden="false"
     data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header header-modal">
                <h5 class="modal-title">Editar información del paciente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">Actualice la información requerida, no podrá regresar estos cambios</p>
                <form class="row" id="formEditarPaciente">
                    <div class="col-12 col-lg-4">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input type="text" name="nombre" value="" class="form-control input-form" required
                               id="editar-nombre">
                    </div>
                    <div class="col-6 col-lg-4">
                        <label for="paterno" class="form-label">Apellido paterno</label>
                        <input type="text" name="paterno" value="" class="form-control input-form" id="editar-paterno">
                    </div>
                    <div class="col-6 col-lg-4">
                        <label for="materno" class="form-label">Apellido materno</label>
                        <input type="text" name="materno" value="" class="form-control input-form" id="editar-materno">
                    </div>
                    <div class="col-6 col-lg-3">
                        <label for="nacimiento" class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control input-form" name="nacimiento" placeholder="" required
                               id="editar-nacimiento" onchange="$(`#editar-edad`).val(calcularEdad2(this.value)['numero'])
                                                $(`#span_formEdad_edit`).html(calcularEdad2(this.value)['tipo'])">
                    </div>
                    <div class="col-6 col-lg-2">
                        <label for="edad" class="form-label">Edad</label>
                        <div class="input-group">
                            <input type="number" class="form-control input-form" disabled step="0.01" name="edad"
                                   placeholder="" min="0" max="150" required id="editar-edad">
                            <span class="input-span" id="span_formEdad_edit">años</span>
                        </div>
                    </div>
                    <div class="col-7 col-lg-4">
                        <label for="curp" class="form-label">CURP</label>
                        <input type="text" class="form-control input-form" name="curp" placeholder="" required
                               id="editar-curp"> <!-- pattern="[A-Za-z]{4}[0-9]{6}[HMhm]{1}[A-Za-z]{5}[0-9]{2}" -->
                    </div>
                    <div class="col-5 col-lg-3">
                        <label for="celular" class="form-label">Télefono</label>
                        <input type="number" class="form-control input-form" name="celular" pattern="[0-9]{10}"
                               placeholder="" id="editar-telefono">
                        <input type="number" class="form-control input-form" name="celular_2" pattern="[0-9]{10}"
                               placeholder="" id="editar-telefono-2">
                    </div>
                    <div class="col-6 col-lg-4">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control input-form" name="correo" id="editar-correo"
                               placeholder="Primer Correo">
                        <input type="email" class="form-control input-form" name="correo_2" id="editar-correo_2"
                               placeholder="Segundo Correo">
                    </div>
                    <div class="col-6 col-lg-2">
                        <label for="postal" class="form-label">Código postal</label>
                        <input type="number" class="form-control input-form" name="postal" id="editar-postal"
                               pattern="[0-9]{5}" placeholder="" id="editar-posta">
                    </div>
                    <div class="col-6 col-lg-3">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" class="form-control input-form" name="estado" placeholder=""
                               id="editar-estado">
                    </div>
                    <div class="col-6 col-lg-3">
                        <label for="municipio" class="form-label">Municipio</label>
                        <input type="text" class="form-control input-form" name="municipio" placeholder=""
                               id="editar-municipio">
                    </div>
                    <div class="col-6 col-lg-4">
                        <label for="colonia" class="form-label">Colonia</label>
                        <input type="text" class="form-control input-form" name="colonia" placeholder=""
                               id="editar-colonia">
                    </div>
                    <div class="col-6 col-lg-4">
                        <label for="exterior" class="form-label">No. Exterior</label>
                        <div class="input-group">
                            <span class="input-span">No.</span>
                            <input type="text" class="form-control input-form" name="exterior" placeholder=""
                                   id="editar-exterior">
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <label for="interior" class="form-label">No. Interior</label>
                        <div class="input-group">
                            <span class="input-span">No.</span>
                            <input type="text" class="form-control input-form" name="interior" placeholder=""
                                   id="editar-interior">
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="calle" class="form-label">Calle</label>
                        <input type="text" class="form-control input-form" name="calle" placeholder=""
                               id="editar-calle">
                    </div>

                    <div class="col-6 col-lg-3">
                        <label for="nacionalidad" class="form-label">Nacionalidad</label>
                        <input type="text" class="form-control input-form" name="nacionalidad" placeholder=""
                               id="editar-nacionalidad">
                    </div>
                    <div class="col-6 col-lg-3">
                        <label for="pasaporte" class="form-label">Pasaporte</label>
                        <input type="text" class="form-control input-form" name="pasaporte" placeholder=""
                               id="editar-pasaporte">
                    </div>
                    <div class="col-6 col-lg-3">
                        <label for="rfc" class="form-label">RFC</label>
                        <input type="text" class="form-control input-form" name="rfc" placeholder="" id="editar-rfc">
                    </div>
                    <div class="col-12 col-lg-6" style="margin-top: 30px;margin-bottom: 15px;">
                        <div class="container">
                            <div class="row" style="zoom:110%;">
                                <div class="col-md-auto">
                                    <label for="">Genero: </label>
                                </div>
                                <div class="col">
                                    <input type="radio" id="edit-mascuCues" name="genero" value="MASCULINO" required>
                                    <label for="edit-mascuCues">Masculino</label>
                                </div>
                                <div class="col">
                                    <input type="radio" id="edit-femenCues" name="genero" value="FEMENINO" required>
                                    <label for="edit-emeCues">Femenino</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 pt-2" id="communicationOptions">
                        <div class="row mt-2 justify-content-center">
                            <p class="fs-6 text-center pb-2">Preferencia de entrega de resultados</p>
                            <div class="col-auto mb-3 form-check fs-4 mx-3">
                                <input type="checkbox" class="form-check-input input-edit-impreso-check"
                                       id="impreso" name="medios" value="3">
                                <label class="form-check-label" for="impreso" style="color: #1a8bbc">
                                    <i class="fas fa-print"></i> Impreso
                                </label>
                            </div>
                            <div class="col-auto mb-3 form-check fs-4 mx-3">
                                <input type="checkbox" class="form-check-input input-edit-whatsapp-check"
                                       id="whatsapp" name="medios" value="2">
                                <label class="form-check-label" for="whatsapp" style="color: #1ABC9C">
                                    <i class="fab fa-whatsapp"></i> Whatsapp
                                </label>
                            </div>
                            <div class="col-auto mb-3 form-check fs-4 mx-3">
                                <label class="form-check-label" for="correo"  style="color: #c35f3d">
                                    <input type="checkbox" class="form-check-input input-edit-correo-check"
                                           id="correo" name="medios" value="1">
                                    <i class="fas fa-envelope"></i> Correo
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 pt-2">
                        <div class="row mt-2 justify-content-center">
                            <div class="col-auto mb-3 form-check fs-4 mx-3">
                                <label for="selectComoNosConociste2" class= "form-label" > ¿Cómo supiste de nosotros?</label>
                                <select class="form-control input-form dataIdProcedencias2" name="comoNosConociste" id="selectComoNosConociste2">
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i
                            class="bi bi-arrow-left-short"></i> Cancelar
                </button>
                <button type="submit" form="formEditarPaciente" class="btn btn-confirmar" id="btn-actualizar">
                    <i class="bi bi-send-plus"></i> Actualizar
                </button>
            </div>
        </div>
    </div>
</div>