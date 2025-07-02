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
                        <label for="area" class="form-label">Tipo de cliente</label>
                        <select name="tipo_cliente" id="tipo_cliente" class="form-select input-form">
                            <option value="1">Contado</option>
                            <option value="2">Crédito</option>
                        </select>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="0" id="checkFullTipCliente" name="full_area">
                            <label class="form-check-label" for="checkFullTipCliente">
                                Ambos
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="area" class="form-label">Factura</label>
                        <select name="tiene_factura" id="tiene_factura" class="form-select input-form">
                            <option value="1">Con Factura</option>
                            <option value="0">Sin Factura</option>
                        </select>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="0" id="checkFullFacturado" name="full_area">
                            <label class="form-check-label" for="checkFullFacturado">
                                Ambos
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