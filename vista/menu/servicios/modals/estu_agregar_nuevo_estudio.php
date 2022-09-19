<div class="modal fade" id="ModalRegistrarServicio" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="filtrador">Registrar nuevo servicio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="formRegistrarServicio">
          <p class="text-center">Cree un nuevo <strong>servicio</strong>  </p>
          <div class="row">
            <div class="col-6 col-md-6">
              <label for="cargo" class="form-label">Servicio derivada</label>
              <div class="input-group">
                <select name="cargo" id="select-servicio-derivada" class="input-form">
                  
                </select>
              </div>
            </div>
            <div class="col-6 col-md-6">
              <label for="cargo" class="form-label">Area del servicio</label>
              <select name="cargo" id="select-area-derivada" class="input-form">
              </select>
            </div>
            <div class="col-12">
              <label for="nombre" class="form-label">Nombre del servicio</label>
              <input type="text" name="nombre"  class="form-control input-form" required>
            </div>
            <div class="col-6">
              <label for="nombre" class="form-label">Tipo de servicio</label>
              <input type="text" name="nombre"  class="form-control input-form" required>
            </div>
            <div class="col-6 col-md-6">
              <label for="cargo" class="form-label">Dirigido a</label>
              <select name="cargo" class="input-form">
                <option value="1">Público general</option>
                <option value="2">Público femenino</option>
                <option value="3">Público masculino</option>
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formRegistrarServicio" class="btn btn-confirmar">
          <i class="bi bi-person-plus"></i> Crear
        </button>
      </div>
    </div>
  </div>
</div>
