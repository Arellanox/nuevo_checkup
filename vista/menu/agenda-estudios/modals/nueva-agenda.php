<div class="modal fade" id="modalNuevaAgenda" tabindex="-1" aria-labelledby="agenda" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header header-modal">
                <h5 class="modal-title" id="title-paciente_rechazar">Agregue una cita/agenda al paciente</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card p-3 mb-2">
                    <p>Información principal</p>
                    <form class="row" id="FormAgendaNueva">
                        <div class="col-12 col-md-12 col-xl-4">
                            <label for="nombre" class="form-label">Nombre del paciente</label>
                            <input type="text" name="nombre" value="" class="form-control input-form">
                        </div>
                        <div class="col-12 col-md-12 col-xl-4">
                            <label for="apellidos" class="form-label">Apellidos del paciente</label>
                            <input type="text" name="apellidos" value="" class="form-control input-form">
                        </div>
                        <div class="col-12 col-md-12 col-xl-4">
                            <label for="numero" class="form-label">Número de teléfono</label>
                            <input type="number" name="numero" value="" class="form-control input-form">
                        </div>
                        <div class="col-12 col-md-12 col-xl-4">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <input type="text" name="observaciones" value="" class="form-control input-form">
                        </div>
                        <div class="col-12 col-md-12 col-xl-4">
                            <label for="date" class="form-label">Fecha de agendas</label>
                            <input type="date" name="date" value="<?php echo date('Y-m-d') ?>" id="inputfechaAgenda" min=<?php echo date("Y-m-d"); ?> class="form-control input-form">
                        </div>

                        <script>

                        </script>
                        <div class="col-12 col-md-12 col-xl-4">
                            <label for="hora_agenda" class="form-label">Horas disponibles</label>
                            <select name="hora_agenda" id="select-horas" class="input-form form-select"></select>
                        </div>
                    </form>

                </div>
                <div class="card p-3 mt-2">
                    <h5>Selecciona estudios</h5>
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <label for="date" class="form-label">Estudios:</label>
                                    <select class="" id="select-us">
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button type="button" class="btn btn-confirmar" id="btn-agregarEstudioImg">
                                        <i class="bi bi-plus-lg"></i> Agregar
                                    </button>
                                </div>
                                <div class="col-12 mt-3">
                                    <p>Tiempo aproximado: </p>
                                    <p class="none-p" id="tiempo-aproximado">0 minutos</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <ul class="list-group" id="list-estudios-ultrasonido">
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">
                    <i class="bi bi-arrow-left-short"></i> Cancelar
                </button>
                <button type="submit" form="FormAgendaNueva" class="btn btn-borrar" id="btn-agendar">
                    <i class="bi bi-calendar-check"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>