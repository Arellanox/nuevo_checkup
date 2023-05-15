<?php session_start(); ?>

<div class="modal fade" id="ModalRegistrarEstudio" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="filtrador">Agregar Nuevo Estudio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="contenido-form-estudios">
        <form class="" id="formEstudios">
          <p class="text-center">Agrege un nuevo <strong>Estudio</strong> </p>
          <div class="row">
            <div class="col-8">
              <label for="descripcion" class="form-label">Nombre del Estudio</label>
              <input type="text" name="descripcion" class="form-control input-form" required>
            </div>
            <div class="col-4">
              <label for="abreviatura" class="form-label">CVE</label>
              <input type="text" name="abreviatura" class="form-control input-form" required>
            </div>
            <!-- <div class="col-12 col-md-12">
              <label for="grupo" class="form-label">Grupo de exámen</label>
              <select name="grupo[]" multiple="multiple" id="registrar-grupo-estudio" required>
              </select>
            </div> -->
            <div class="col-12 row">
              <div class="col" id="cont-area-estudios">
                <label for="area" class="form-label">Área</label>
                <select name="area" id="registrar-area-estudio" required>
                </select>
              </div>

              <!-- <div class="col">
                <label for="Costo" class="form-label">Costo</label>
                <input type="text" name="costo" class="form-control input-form" required>

              </div> -->

              <div class="col">
                <label for="dias_entrega" class="form-label">Día de entrega</label>
                <input type="number" name="dias_entrega" class="input-form" value="" required>
              </div>


              <!-- Solo  admin -->
              <div class="col" style="<?php if ($_SESSION['perfil'] != "1") {
                                        echo 'display: none';
                                      } ?>">
                <label for="seleccionable" class="form-label">Cargable/Seleccionable</label>
                <select name="seleccionable" id="registrar-seleccionable" required class="form-select input-form">
                  <option value="1">Cargable</option>
                  <option value="0">No Cargable</option>
                </select>
              </div>

              <div class="col">
                <label for="duracion" class="form-label">Duración</label>
                <input type="number" name="duracion" class="input-form" placeholder="Duración del estudio" value="" required>
              </div>
            </div>

            <!--  -->
            <div class="col-9 col-md-9">
              <label for="codigo_sat_id" class="form-label">Clave SAT</label>
              <select name="codigo_sat_id" id="registrar-concepto-facturacion" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Filtra la lista por coincidencias" data-bs-original-title="Solicitar area de administración la clave de este servicio">
              </select>
            </div>


            <div class="col-3 col-md-3">
              <label for="es_para" class="form-label">Para</label>
              <select name="es_para" id="registrar-seleccionable" required class="form-select input-form">
                <option value="1">MASCULINO</option>
                <option value="2">FEMENINO</option>
                <option value="3" selected>TODOS</option>
              </select>
            </div>
            <div class="col-12 col-md-12">
              <label for="indicaciones" class="form-label">Indicaciones</label>
              <textarea class="md-textarea input-form" name="indicaciones" cols="45" rows="2" placeholder=""></textarea>
            </div>

            <!-- <div class="row" style="zoom:100%;">
              <div class="col-6">
                <label for="">¿Se subroga?: </label>
              </div>
              <div class="col-3">
                <input type="radio" name="local" id="registrar-subrogaSi" value="1" required>
                <label for="registrar-subrogaSi">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" name="local" id="registrar-subrogaNo" value="0" required>
                <label for="registrar-subrogaNo">No</label>
              </div>
            </div> -->
            <!-- <p style="margin-top:15px; margin-bottom: 15px">Seleccione los contenedores que necesite esté estudio</p>
            <div class="" id="div-select-contenedores">

            </div>
            <div class="row">
              <div class="col-12">
                <button type="button" class="btn btn-hover" id="nuevo-contenedor">
                  <i class="bi bi-plus"></i> Agregar nuevo contenedor
                </button>
              </div>
            </div> -->
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formEstudios" class="btn btn-confirmar">
          <i class="bi bi-send-check"></i> Guardar
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  var htmlBodyFormEstudios = $('#contenido-form-estudios').html();
</script>