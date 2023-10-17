<div class="modal fade" id="modalFiltrarTablaReporteEpidemio" data-bs-backdrop="static" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header header-modal">
                <h5 class="modal-title">Filtrar Reporte</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- <h5></h5>
                <hr> -->
                <form id="filtroTablaFormPacientes" name="filtroTablaFormPacientes" class="row">
                    <p>Selecciona un rango de fecha a filtrar</p>
                    <div class="col-12">
                        <label for="fecha_inicial_epidemio" class="form-label">Fecha Inicial</label>
                        <input type="date" name="fecha_inicial_epidemio" id="fecha_inicial_epidemio" class="form-input input-form" required>
                    </div>
                    <div class="col-12">
                        <label for="fecha_final_epidemio" class="form-label">Fecha Final</label>
                        <input type="date" name="fecha_final_epidemio" id="fecha_final_epidemio" class="form-input input-form" required>
                    </div>

                    <div class="col-12">
                        <label for="resultado_epidemio" class="form-label">Resultado</label>
                        <input type="text" name="resultado_epidemio" id="resultado_epidemio" class="form-input input-form" required>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
                <button type="button" class="btn btn-confirmar" form="filtroTablaFormPacientes" id="actualizar_tabla_pacientes">
                    <i class="bi bi-search"></i> Filtrar
                </button>
            </div>
        </div>
    </div>
</div>



<script>
    // Obtener la fecha actual
    //var fechaActual = new Date();

    // Obtener el día de la semana de la fecha actual (0: domingo, 1: lunes, ..., 6: sábado)
    //var diaSemana = fechaActual.getDay();

    // Calcular la fecha inicial (lunes) y fecha final (domingo) de la semana actual
    //var fechaInicial = new Date(fechaActual.getFullYear(), fechaActual.getMonth(), fechaActual.getDate() - diaSemana + 1).toISOString().split('T')[0];
    //var fechaFinal = new Date(fechaActual.getFullYear(), fechaActual.getMonth(), fechaActual.getDate() + (6 - diaSemana) + 1).toISOString().split('T')[0];

    // Asignar los valores por defecto a los campos de entrada de fecha
    //document.getElementById('fecha_inicial').value = fechaInicial;
    //document.getElementById('fecha_final').value = fechaFinal;
</script>