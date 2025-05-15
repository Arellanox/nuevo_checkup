 <?php session_start() ?>
<div class="col-12 loader" id="loader" style="">
    <div class="preloader" id="preloader"> </div>
</div>
<div class="row d-flex justify-content-center">
    <div class="col-6 col-lg-6" style="margin-right: -5px !important;">
        <div class="mt-3 rounded p-3 shadow my-2">
            <div class="text-center" style="margin-top:4px;zoom:95%;margin-bottom:5px;">
                <button type="button" class="btn btn-hover me-2"
                        data-bs-toggle="tooltip" data-bs-title="Editar Datos de un Cliente"
                        style="margin-bottom:4px" id="btn-cliente-editar">
                    <i class="bi bi-pencil-square"></i> Editar Cliente
                </button>
                <button type="button" class="btn btn-hover me-2"
                        data-bs-toggle="tooltip" data-bs-title="Obtener Código QR del Cliente"
                        style="margin-bottom:4px" id="generar-codigoqr">
                    <i class="bi bi-qr-code"></i> Código QR
                </button>
                <button type="button" class="btn btn-hover me-2"
                        data-bs-toggle="tooltip" data-bs-title="Asíngar Descuento a un Cliente"
                        style="margin-bottom:4px" id="btn-descuentoCliente">
                    <i class="bi bi-percent"></i> Descuento
                </button>
                <?php if(!$_SESSION['franquiciario']): ?>
                    <button type="button" class="btn btn-hover me-2"
                            data-bs-toggle="tooltip" data-bs-title="Mostrar/Ocultar Clientes de Francias y Bimo"
                            style="margin-bottom:4px" id="btn-showFranquiciasClientes">
                        <i class="bi bi-people"></i>
                        <span class="btn-text">Clientes de Franquicia</span>
                    </button>
                <?php endif; ?>
            </div>
            <table class="table table-hover display responsive tableContenido" id="TablaClientes" style="width: 100%">
                <thead class="" style="width: 100%">
                    <tr>
                        <th scope="col d-flex justify-content-center" class="all">#</th>
                        <th scope="col d-flex justify-content-center" class="all">Nombre</th>
                        <th scope="col d-flex justify-content-center" class="min-tablet">Razon Social</th>
                        <th scope="col d-fkex justify-content-center" class="min-tablet">Abreviatura</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-3 col-lg-3" style="margin-right: -5px !important;">
        <div class="mt-3 rounded p-3 shadow my-2" id="informacion-segmento">

        </div>
    </div>

    <div class="col-lg-3" style="margin-right: -5px !important;">
        <div class="mt-3 rounded p-3 shadow my-2" id="informacion-cliente">

        </div>
    </div>
</div>


<style media="screen">
    #TablaContacto_filter {
        display: none;
    }

    #TablaSegmentosAdmin_filter {
        display: none;
    }
</style>