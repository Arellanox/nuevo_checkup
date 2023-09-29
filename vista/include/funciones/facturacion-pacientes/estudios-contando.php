<div class="modal fade" id="modalEstudiosContado" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header header-modal">
                <h5 class="modal-title">Detalle del paciente <strong id="nombre-paciente-contado"></strong></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row px-4 pt-2">
                    <div class="col-12 col-md-8">
                        <div class="shadow p-3">
                            <h5>Cargos del paciente</h5>
                            <div class="p-2">
                                <!-- 11 -->
                                <table class="table table-hover shadow-sm p-4" style="display:none" id="container-estudios-11">
                                    <thead class="">
                                        <tr>
                                            <th scope="d-flex justify-content-center" class="col-6">Ultrasonido (Estudios)</th>
                                            <th scope="d-flex justify-content-center" class="col-2">Cantidad</th>
                                            <!-- subtotal sin descuento -->
                                            <th scope="d-flex justify-content-center" class="col-4">Subtotal</th>
                                            <!-- <th scope="d-flex justify-content-center" class="col-2">Descuento</th> -->
                                            <!-- Subtotal con descuento -->
                                            <!-- <th scope="d-flex justify-content-center" class="col-4">Precio antes de IVA</th> -->
                                        </tr>
                                    </thead>
                                    <tbody class="contenido-estudios" id="cargos-estudios-11">
                                    </tbody>
                                </table>
                                <!-- 8 -->
                                <table class="table table-hover shadow-sm p-4" style="display:none" id="container-estudios-8">
                                    <thead class="">
                                        <tr>
                                            <th scope="d-flex justify-content-center" class="col-6">Rayos X (Estudios)</th>
                                            <th scope="d-flex justify-content-center" class="col-2">Cantidad</th>
                                            <th scope="d-flex justify-content-center" class="col-4">Precio antes de IVA</th>
                                        </tr>
                                    </thead>
                                    <tbody class="contenido-estudios" id="cargos-estudios-8">
                                    </tbody>
                                </table>
                                <!-- 6 -->
                                <table class="table table-hover shadow-sm p-4" style="display:none" id="container-estudios-6">
                                    <thead class="">
                                        <tr>
                                            <th scope="d-flex justify-content-center" class="col-6">Laboratorio Clinico (Estudios)</th>
                                            <th scope="d-flex justify-content-center" class="col-2">Cantidad</th>
                                            <th scope="d-flex justify-content-center" class="col-4">Precio antes de IVA</th>
                                        </tr>
                                    </thead>
                                    <tbody class="contenido-estudios" id="cargos-estudios-6">
                                    </tbody>
                                </table>
                                <!-- 12 -->
                                <table class="table table-hover shadow-sm p-4" style="display:none" id="container-estudios-12">
                                    <thead class="">
                                        <tr>
                                            <th scope="d-flex justify-content-center" class="col-6">Laboratorio Biomolecular (Estudios)</th>
                                            <th scope="d-flex justify-content-center" class="col-2">Cantidad</th>
                                            <!-- subtotal sin descuento -->
                                            <th scope="d-flex justify-content-center" class="col-4">Subtotal</th>
                                            <!-- <th scope="d-flex justify-content-center" class="col-2">Descuento</th> -->
                                            <!-- Subtotal con descuento -->
                                            <!-- <th scope="d-flex justify-content-center" class="col-4">Precio antes de IVA</th> -->
                                        </tr>
                                    </thead>
                                    <tbody class="contenido-estudios" id="cargos-estudios-12">
                                    </tbody>
                                </table>
                                <!-- 0 -->
                                <table class="table table-hover shadow-sm p-4" style="display:none" id="container-estudios-0">
                                    <thead class="">
                                        <tr>
                                            <th scope="d-flex justify-content-center" class="col-6">Otros Estudios</th>
                                            <th scope="d-flex justify-content-center" class="col-2">Cantidad</th>
                                            <th scope="d-flex justify-content-center" class="col-4">Precio antes de IVA</th>
                                        </tr>
                                    </thead>
                                    <tbody class="contenido-estudios" id="cargos-estudios-0">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Columna 2 Tipos de pago, referencia, total -->
                    <div class="col-12 col-md-4">
                        <h5 class="px-2">Información de pago</h5>
                        <div class="px-3">
                            <div class="mb-2" id="TipoPago1">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="tipo_pago">Tipo de pago</label>
                                    <button class="btn" id="agregarformapago">
                                        <i class="bi bi-plus me-2"></i>
                                        agregar forma de pago
                                    </button>
                                </div>
                                <select name="tipo_pago" class="input-form form-control" id="contado-tipo-pago"></select>
                            </div>
                            <!-- Columna donde se agregaran la cantidad a pagar y el monto -->
                            <div id="formasPagoDiv"></div>

                            <div class="mb-2">
                                <label for="referencia-contado" class="form-label">Referencia</label>
                                <input type="text" id="referencia-contado" class="input-form form-control">
                            </div>
                            <div class="row d-flex justify-content-end">
                                <div class="col-8 text-end">Total de cargos:</div>
                                <div class="col-4 text-start" id="precio-total-cargo"> $0<!-- calculo --></div>

                                <div class="col-8 text-end">
                                    Descuento ( % )
                                    <div class="input-group flex-nowrap">
                                        <input type="number" placeholder="% de descuento:" class="form-control input-form text-end" value="0" id="descuento">
                                        <span class="input-group-text input-span">%</span>
                                    </div>

                                </div>
                                <div class="col-4 text-start" id="precio-descuento"> $0<!-- calculo --></div>
                                <div class="col-8 text-end">Subtotal:</div>
                                <div class="col-4 text-start" id="precio-subtotal"> $0<!-- calculo --></div>
                                <div class="col-8 text-end">IVA:</div>
                                <div class="col-4 text-start" id="precio-iva"> 16 %<!-- calculo --></div>
                                <div class="col-8 text-end">Total:</div>
                                <div class="col-4 text-start" id="precio-total"> $0<!-- calculo --></div>
                                <div class="col-8 text-end">Faltante:</div>
                                <div class="col-4 text-start" id="precio-faltante"> $0<!-- residuo --></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="zoom:90%">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">
                    <i class="bi bi-arrow-left-short"></i> Cerrar
                </button>
                <button type="button" class="btn btn-pantone-7408" id="terminar-proceso-cargo">
                    <i class="bi bi-receipt-cutoff"></i> Guardar y pagar
                </button>
            </div>
        </div>
    </div>
</div>