<div class="modal fade" id="ModalRegistrarPaciente" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true" data-bs-backdrop="static">
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
            <div class="col-12 col-lg-4">
                <label for="procedencia" class="form-label">Procedencia</label>
                <input type="text" readonly name="procedencia" value="SLCHUMBERGER" class="input-form">
            </div>
            <div class="col-12 col-lg-4">
              <label for="segmento" class="form-label">Segmentos</label>
              <select name="segmento" id="segmentos_procedencias" class="input-form" autocomplete="off" required>
                <option value="4">WCE-GAVSA</option>
              </select>
            </div>
          </div>
          <div class="col-12 col-lg-4">
            <label for="nombre" class="form-label">Nombres</label>
            <input type="text" name="nombre" value="" class="input-form">
          </div>
          <div class="col-6 col-lg-4">
            <label for="paterno" class="form-label">Apellido paterno</label>
            <input type="text" name="paterno" value="" class="input-form">
          </div>
          <div class="col-6 col-lg-4">
            <label for="materno" class="form-label">Apellido materno</label>
            <input type="text" name="materno" value="" class="input-form">
          </div>
          <div class="col-6 col-lg-2">
            <label for="edad" class="form-label">Edad</label>
            <div class="input-group">
              <input type="number" class="form-control input-form" name="edad" placeholder="" autocomplete="off" >
              <span class="input-span">años</span>
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <label for="nacimiento" class="form-label">Fecha de nacimiento</label>
            <input type="date" class="form-control input-form" name="nacimiento" placeholder="" autocomplete="off" >
          </div>
          <div class="col-7 col-lg-4">
            <label for="curp" class="form-label">CURP</label>
            <input type="text" class="form-control input-form" name="curp" placeholder="" autocomplete="off" >
          </div>
          <div class="col-5 col-lg-3">
            <label for="telefono" class="form-label">Télefono</label>
            <input type="number" class="form-control input-form" name="telefono" placeholder="" autocomplete="off" >
          </div>

          <div class="col-6 col-lg-2">
            <label for="postal" class="form-label">Código postal</label>
            <input type="number" class="form-control input-form" name="postal" placeholder="" autocomplete="off" >
          </div>
          <div class="col-6 col-lg-3">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" class="form-control input-form" name="estado" placeholder="" autocomplete="off" >
          </div>
          <div class="col-6 col-lg-3">
            <label for="municipio" class="form-label">Municipio</label>
            <input type="text" class="form-control input-form" name="municipio" placeholder="" autocomplete="off" >
          </div>
          <div class="col-6 col-lg-4">
            <label for="colonia" class="form-label">Colonia</label>
            <input type="text" class="form-control input-form" name="colonia" placeholder="" autocomplete="off" >
          </div>
          <div class="col-6 col-lg-3">
            <label for="exterior" class="form-label">No. Exterior</label>
            <div class="input-group">
            <span class="input-span">No.</span>
              <input type="text" class="form-control input-form" name="exterior" placeholder="" autocomplete="off" >
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <label for="interior" class="form-label">No. Interior</label>
            <div class="input-group">
              <span class="input-span">No.</span>
              <input type="text" class="form-control input-form" name="interior" placeholder="" autocomplete="off" >
            </div>
          </div>
          <div class="col-6">
            <label for="calle" class="form-label">Calle</label>
            <input type="text" class="form-control input-form" name="calle" placeholder="" autocomplete="off" >
          </div>

          <div class="col-6 col-lg-4">
            <label for="nacionalidad" class="form-label">Nacionalidad</label>
            <input type="text" class="form-control input-form" name="nacionalidad" placeholder="" autocomplete="off" >
          </div>
          <div class="col-6 col-lg-4">
            <label for="pasaporte" class="form-label">PASAPORTE</label>
            <input type="text" class="form-control input-form" name="pasaporte" placeholder="" autocomplete="off" >
          </div>
          <div class="col-6 col-lg-4">
            <label for="rfc" class="form-label">RFC</label>
            <input type="text" class="form-control input-form" name="rfc" placeholder="" autocomplete="off" >
          </div>
          <div class="col-6 col-lg-3">
            <label for="vacuna" class="form-label">Vacuna</label>
            <select class="input-form" name="vacuna" id="inputVacuna">
                <option value="1" >Ninguno...</opcion>
                <option value="PFIZER">PFIZER</opcion>
                <option value="ASTRA ZENECA" >ASTRA ZENECA</opcion>
                <option value="SPUTNIK V" >SPUTNIK V</opcion>
                <option value="SINOVAC" >SINOVAC</opcion>
                <option value="CANSINO" >CANSINO</opcion>
                <option value="MODERNA" >MODERNA</opcion>
                <option value="COVAX" >COVAX</opcion>
                <option value="JOHNSON & JOHNSON" >JOHNSON & JOHNSON</opcion>
                <option value="SINOPHARM" >SINOPHARM</opcion>
                <option value="OTRA">OTRA (ESPECIFIQUE)</opcion>
            </select>
          </div>
          <div class="col-6 col-lg-3" id="vacunaExtra">
            <label for="vacunaextra" class="form-label">Especifique otra vacuna</label>
            <input type="text" class="form-control input-form" id="vacunaextra" placeholder="" autocomplete="off" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
          </div>
          <div class="col-6 col-lg-3">
            <label for="dosis" class="form-label">Dosis</label>
            <select class="input-form" name="inputTipoPDF" id="inputDosis" >
                <option value="1RA" >1RA DOSIS</opcion>
                <option value="2DA">2DA DOSIS</opcion>
                <option value="3RA" >3RA DOSIS</opcion>
                <option value="REFUERZO" >REFUERZO</opcion>
            </select>
          </div>
          <div class="col-12 col-lg-6" style="margin-top: 30px;margin-bottom: 15px;">
              <div class="container">
                <div class="row"style="zoom:110%;">
                  <div class="col-md-auto">
                    <label for="" >Genero: </label>
                  </div>
                  <div class="col">
                      <input type="radio" id="mascuCues" name="genero" value="MASCULINO">
                      <label for="mascuCues">Masculino</label>
                  </div>
                  <div class="col">
                      <input type="radio"  id="FemeCues" name="genero" value="FEMENINO" >
                      <label for="FemeCues" >Femenino</label>
                  </div>
                </div>
              </div>
          </div>
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
