<div class="modal fade" id="ModalRegistrarPaciente" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title">Nuevo registro de paciente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center" >Asegurese que toda su información este correcta. <br /> Utilice su <strong>CURP</strong> para crear su registro de laboratorio</p>
        <form class="row" id="formRegistrarPaciente">
          <div class="row">
            <div class="col-12 col-lg-5">
                <label for="procedencia" class="form-label">Procedencia</label>
                <select class="input-form" id="listProcedencia" >
                </select>
            </div>
            <div class="col-12 col-lg-4">
              <label for="segmento" class="form-label">Segmentos</label>
              <select name="segmento" id="segmentos_procedencias-menu" class="input-form" required >
                <!-- <option value="4">WCE-GAVSA</option> -->
              </select>
            </div>
          </div>
          <?php include "formRegistroPaciente.php"; ?>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formRegistrarPaciente" class="btn btn-confirmar" id="btn-registrarse">
          <i class="bi bi-send-plus"></i> Registrar
        </button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $.getScript('http://localhost/nuevo_checkup/vista/include/modal/js/registrar-paciente.js');
</script>
