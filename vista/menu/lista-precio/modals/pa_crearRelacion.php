<div class="modal fade" id="ModalCrearRelacion" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" class="titlePaqueteAsignado"><strong><span class="titlePaqueteAsignado">Relacion</strong></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="formCrearRelacion">
          <div class="row">

            <div class="col-md-6">
              <p class="text-center">Seleccione los clientes a los que pertenece</p> </p>
              <div class="input-group">
                <select id="relacion-paquete" name="relacion-paquete" class="form-select">
  
                </select>
                <button type="submit" class="btn btn-primary" id="asignarBtn">Asignar</button>
              </div>
            </div>
          </div>
        </form> 
        <br>
        <p for="descripcion" class="">
                Clientes que tienen el paquete: <strong><span class="titlePaqueteAsignado"></span></strong>
        </p>
        <!-- Campo de búsqueda -->
        <input type="text" id="filtroClientes" class="form-control mb-4" placeholder="Buscar cliente...">
        <div id="listaAsignada" class="row">
          <!-- lista de clientes que tienen el paquete -->
          <div class="col-auto">
            <div class="input-group mb-3">
              <div class="input-group-text">
                <label class="d-flex justify-content-center" for="">UNIVERSIDAD JUAREZ AUTOMONA DE TABASCO</label> 
                <button class="badge text-bg-danger listaClientesPaquetes" data-bs-id="18">
                  <i class="bi bi-trash3-fill"></i>
                </button>
              </div>
            </div>
          </div>

          <div class="col-auto">
            <div class="input-group mb-3">
              <div class="input-group-text">
                <label class="d-flex justify-content-center" for="">SLB</label> 
                <button class="badge text-bg-danger listaClientesPaquetes" data-bs-id="19">
                  <i class="bi bi-trash3-fill"></i>
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <!-- <button type="submit" form="formCrearRelacion" class="btn btn-confirmar">
          <i class="bi bi-person-plus"></i> Crear paquete
        </button> -->
      </div>
    </div>
  </div>
</div>
<style>
    .hidden {
      display: none;
    }
  </style>