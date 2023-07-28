<div class="modal fade" id="modalHorarioAtencion" tabindex="-1" aria-labelledby="agenda" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header header-modal">
                <h5 class="modal-title" id="title-paciente_rechazar">Horario de atención</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Configura la hora de atención de esta area</p>

                <form class="row mt-2" id="fromAjusteHora">
                    <label class="" for="">Horas ajustadas</label>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="" for="hora_inicial">Inicio</label>
                            <input type="time" name="hora_inicial" id="hora_inicial" class="form-control input-form" id="horario_inicio">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="" for="hora_final">Final</label>
                            <input type="time" name="hora_final" id="hora_final" class="form-control input-form" id="horario_final">
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="" for="intervalo">Intervalo</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control input-form" name="intervalo" placeholder="Duración del servicio">
                            <span class="input-span" id="basic-addon1">min</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">
                    <i class="bi bi-arrow-left-short"></i> Cancelar
                </button>
                <button type="submit" form="fromAjusteHora" class="btn btn-confirmar" id="btn-agendar">
                    <i class="bi bi-clock-history"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>