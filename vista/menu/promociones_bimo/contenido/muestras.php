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
      <form id="subirResultadosCertificadoMedico" class="d-flex flex-column align-items-center">
        <p>Carga una nueva promocion</p>

        <div id="dropCertificadoMedico" class="drop-zone mx-2">
          <label for="certificado-medico" style="cursor: pointer;" class="label-certificado-medico">Sube tu
            archivo
            arrastrándolo
            aquí</label>

          <input type="file" id="certificado-medico" name="certificado-medico[]" style="display: none;">
          <br>
          <div class="spinner-border text-primary carga-certificado-medico" role="status" style="display: none;">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
      </form>

    </div>
  </div>

  <!-- Galeria -->
  <div class="col-12 col-xl-9 tab-first" id="tab-paciente" style="margin-right: -5px !important;">
    <div class="rounded p-3 shadow my-2" id="lista-pacientes">

      <h4>Promociones</h4>

      <div class="row">

        <!-- Gallery item -->
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
          <div class="bg-white rounded shadow-sm"><img src="https://bootstrapious.com/i/snippets/sn-gallery/img-6.jpg" alt="" class="img-fluid card-img-top">
            <div class="p-4">
              <h5> <a href="#" class="text-dark">Yellow banana</a></h5>
              <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
              <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">JPG</span></p>
                <div class="badge text-bg-warning px-3 rounded-pill font-weight-normal text-white">Por vencer</div>
              </div>
            </div>
          </div>
        </div>
        <!-- End -->

        <!-- Gallery item -->
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
          <div class="bg-white rounded shadow-sm"><img src="https://bootstrapious.com/i/snippets/sn-gallery/img-1.jpg" alt="" class="img-fluid card-img-top">
            <div class="p-4">
              <h5> <a href="#" class="text-dark">Yellow banana</a></h5>
              <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
              <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">JPG</span></p>
                <div class="badge text-bg-danger px-3 rounded-pill font-weight-normal text-white">Vencido</div>
              </div>
            </div>
          </div>
        </div>
        <!-- End -->

        <!-- Gallery item -->
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
          <div class="bg-white rounded shadow-sm"><img src="https://bootstrapious.com/i/snippets/sn-gallery/img-2.jpg" alt="" class="img-fluid card-img-top">
            <div class="p-4">
              <h5> <a href="#" class="text-dark">Yellow banana</a></h5>
              <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
              <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">JPG</span></p>
                <div class="badge text-bg-success px-3 rounded-pill font-weight-normal text-white">Activo</div>
              </div>
            </div>
          </div>
        </div>
        <!-- End -->


      </div>


    </div>
  </div>
</div>