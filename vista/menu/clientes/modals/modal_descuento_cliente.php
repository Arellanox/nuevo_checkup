<div class="modal fade" id="modalDescuentoCliente" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
    <div class="modal-dialog modal-xl  modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header header-modal">
                <h5 class="modal-title" id="filtrador">Decuento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-12 col-md-4">
                        <div class="mb-3 rounded p-3 shadow">
                            <p class="mr-3">¿Desea un descuento?</p>

                            <div class="text-center">
                                <div class="form-check m-2 form-check-inline">
                                    <input class="form-check-input check" type="radio" name="flexRadioDefault" id="checkDescuentoGeneral" value="1">
                                    <label class="form-check-label" for="checkDescuentoGeneral">General</label>
                                </div>

                                <div class="form-check m-2 form-check-inline">
                                    <input class="form-check-input check" type="radio" name="flexRadioDefault" id="checkDescuentoArea" value="2">
                                    <label class="form-check-label" for="checkDescuentoArea">Área</label>
                                </div>

                                <div class="form-check m-2 form-check-inline">
                                    <input class="form-check-input check" type="radio" name="flexRadioDefault" id="checkDescuentoNo" value="3" checked>
                                    <label class="form-check-label" for="checkDescuentoNo">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="rounded p-3 shadow" id="divDescuentoGeneral">
                            <div>
                                <h5>Descuento General</h5>
                                <p>Descuento</p>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control input-form" id="inputDescuentoGeneral" placeholder="00">
                                    <span class="input-span" id="basic-addon1">%</span>
                                </div>
                                <!-- <div class="d-flex justify-content-end col-12">
                                    <button type="submit" form="formRegistrarCliente" class="btn btn-confirmar"
                                        id="submit-registrarEstudio">
                                        <i class="bi bi-person-plus"></i> Guardar
                                    </button>
                                </div> -->

                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-8">
                        <div class="rounded p-3 shadow" id="divDescuentoArea">
                            <!-- contenido de area -->
                            <!-- <div class="row"> -->
                            <h5>Descuento Área</h5>
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <p>Descuento</p>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control input-form" id="inputDescuentoArea" placeholder="00">
                                        <span class="input-span" id="basic-addon1">%</span>
                                    </div>
                                </div>

                                <div class="col-12 col-md-8">
                                    <p>Áreas</p>
                                    <select name="" id="selectDescuentoCliente" class="form-select input-form">
                                    </select>
                                </div>
                                <!-- </div> -->
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="click" class="btn btn-confirmar" id="btn-descuentoClienteArea">
                                        <i class="bi bi-file-earmark-plus"></i> Agregar
                                    </button>
                                </div>

                            </div>
                            <table class="table table-hover display responsive" id="TablaDescuentoCliente" style="width: 100%;">
                                <thead>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <!-- <div class="col-12 col-md-6 mt-3 rounded p-3 shadow order-md-last">
                        <h5>Descuento General</h5>
                        <div class="col-md-3">
                            <p>Descuento</p>
                            <input type="number" class="form-control input-form" id="inputDescuento" placeholder="00%">
                        </div>
                        <button type="submit" form="formRegistrarCliente" class="btn btn-confirmar float-end"
                            id="submit-registrarEstudio">
                            <i class="bi bi-person-plus"></i> Guardar
                        </button>

                    </div> -->
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
                <button type="submit" form="formRegistrarCliente" class="btn btn-confirmar" id="btn-descuentoClienteGeneral">
                    <i class="bi bi-person-plus"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>