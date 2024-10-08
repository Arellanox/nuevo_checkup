<div class="modal fade" id="modalFiltrarTabla" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <!-- <div class="modal-header header-modal">
                <h5 class="modal-title" id="filtrador"> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> -->
            <div class="modal-body">
                <h5>Filtrar reporte</h5>
                <hr>
                <form class="row">
                    <p>Selecciona las fechas a elegir</p>
                    <div class="col-12">
                        <label for="fecha_inicial" class="form-label">Fecha Inicial</label>
                        <input type="date" id="fecha_inicial" class="form-input input-form" required>
                    </div>
                    <div class="col-12">
                        <label for="fecha_final" class="form-label">Fecha Inicial</label>
                        <input type="date" id="fecha_final" class="form-input input-form" required>
                    </div>
                    <div class="col-12">
                        <label for="cliente" class="form-label">Cliente</label>
                        <select name="" id="cliente" class="form-select input-form"></select>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="0" id="checkFullClientes" name="full_clientes">
                            <label class="form-check-label" for="checkFullClientes">
                                Todos
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="area" class="form-label">Área</label>
                        <select name="area_id" id="area_list" class="form-select input-form">
                            <option value="6">LABORATORIO CLÍNICO</option>
                            <option value="12">LABORATORIO BIOMOLECULAR</option>
                        </select>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="0" id="checkFullArea" name="full_area">
                            <label class="form-check-label" for="checkFullArea">
                                Ambas
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="servicios" class="form-label">Servicio</label>
                        <select name="servicios" id="servicios" class="form-select input-form select2-search__field">
                        </select>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="0" id="checkFullServicios" name="full_area">
                            <label class="form-check-label" for="checkFullServicios">
                                Todos
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
                <button type="submit" class="btn btn-confirmar" id="actualizar_tabla">
                    <i class="bi bi-search"></i> Filtrar
                </button>
            </div>
        </div>
    </div>
</div>