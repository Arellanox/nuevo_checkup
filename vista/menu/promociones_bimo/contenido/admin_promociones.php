<!-- <div class="col-12 loader" id="loader">
  <div class="preloader" id="preloader"> </div>
</div> -->

<style>
  .drop-zone {
    width: 100%;
    height: 85px;
    border: 2px dashed rgb(0 79 90 / 17%);
    text-align: center;
    padding: 12px;
    margin-bottom: 20px;
    border-radius: 10px;
    margin-left: 8px;
  }

  .drop-zone.hover_dropDrag {
    border-color: #00bbb9 !important;
    background-color: #c6cacc !important;
  }
</style>


<!-- tabs para movil -->
<div id="tab-button"></div>

<!-- style="max-height: 60vh" -->
<div class="row overflow-auto">
  <div class="col-12 col-xl-3 tab-first" id="tab-paciente" style="margin-right: -5px !important;">
    <div class="rounded p-3 shadow my-2" id="lista-pacientes">
      <!-- Carga de promociones (formulario) -->
      <form id="cargarPromocionalBimo" class="row">
        <p>Carga una nueva promocion</p>

        <div class="mb-2">
          <label for="nacimiento" class="form-label">Título</label>
          <input type="text" class="form-control input-form" name="titulo" placeholder="Promocial" required>
        </div>

        <div class="mb-2">
          <label for="">Descripción:</label>
          <textarea name="descripcion" class="form-control input-form" rows="1" cols="2" placeholder="Describa la promoción"></textarea>
        </div>

        <div class="mb-2">
          <label for="">Inicio de promoción:</label>
          <input type="date" class="form-control input-form" name="fecha_inicio" required>

          <label for="">Vencimiento de promoción:</label>
          <input type="date" class="form-control input-form" name="fecha_fin" required>
        </div>

        <div class="d-flex flex-column align-items-center">
          <div id="dropPromocionalesBimo" class="drop-zone mx-2">
            <label for="promocionales_bimo" style="cursor: pointer;" class="label-promocionales_bimo">Sube tu
              archivo
              arrastrándolo
              aquí</label>

            <input type="file" id="promocionales_bimo" name="archivos[]" style="display: none;">
            <br>
            <div class="spinner-border text-primary carga-promocionales_bimo" role="status" style="display: none;">
              <span class="visually-hidden">Loading...</span>
            </div>
          </div>
        </div>

        <div class="col-12 text-end">
          <button type="submit" form="cargarPromocionalBimo" data-attribute="guardar" class="btn btn-hover" style="margin-bottom:4px">
            <i class="bi bi-clipboard2-pulse"></i> Guardar
          </button>
        </div>

      </form>

    </div>
  </div>

  <!-- Galeria -->
  <div class="col-12 col-xl-9 tab-first" id="tab-paciente" style="margin-right: -5px !important;">
    <div class="rounded p-3 shadow my-2" id="lista-pacientes">
      <h4>Promociones</h4>
      <div class="row div-padre" id="galeria_prmociones"> </div>
    </div>
  </div>
</div>