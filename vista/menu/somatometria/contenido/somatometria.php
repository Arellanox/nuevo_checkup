<div class="col-12 loader" id="loader">
  <div class="preloader" id="preloader"> </div>
</div>
<div class="row">
  <div class="col-4 col-lg-4 col-xxl-3" style="margin-right: -5px !important;">
    <div class="card mt-3 p-3" id="lista-pacientes">
      <h4>Lista de pacientes</h4>
      <div class="text-center">
        <label for="inputBuscarTableListaNuevos">Buscar:</label>
        <input type="text" class="form-control input-color" style="display: unset !important;width:auto !important" name="inputBuscarTableListaNuevos" value="" style="width:80%" autocomplete="off" id="BuscarTablaListaSignos">
      </div>
      <table class="table display responsive" id="TablaSignos" style="width: 100%">
        <thead class="">
          <tr>
            <th scope="col d-flex justify-content-center" class="all">#</th>
            <th scope="col d-flex justify-content-center" class="all">Nombre</th>
            <th scope="col d-flex justify-content-center" class="min-tablet">Folio</th>
            <th scope="col d-flex justify-content-center" class="none">Compañia</th>
            <th scope="col d-flex justify-content-center" class="none">Edad</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-4 col-lg-3 col-xxl-3 informacion-Signos" style="margin-right: -5px !important;display:none">
    <div class="card mt-3" id="panel-informacion"> </div>
    <!-- <div class="card m-3 p-4">
      <h4>Estudios anteriores</h4>
      <div class="accordion" id="accordionResultadosAnteriores">
      </div>
    </div> -->
  </div>
  <div class="col-lg-5 col-xxl-6 informacion-Signos" style="margin-right: -5px !important;display:none">
    <div class="card mt-3 p-3">
      <div class="row">
        <div class="col-12 col-lg-7">
          <h4>Signos vitales del paciente</h4>
          <p class="none-p"> </p>
        </div>
        <div class="col-12 col-lg-5 d-flex justify-content-center align-items-center">
          <button type="submit" class="btn btn-hover me-2" form="form-resultados-somatometria" id="btn-form-resultado" style="margin-bottom:4px">
            <i class="bi bi-save"></i> Guardar resultados
          </button>
          <button type="submit" data-attribute="confirmar" class="btn btn-hover" id="omitir-paciente" style="margin-bottom:4px">
            <i class="bi bi-clipboard-x"></i> Saltar paciente
          </button>
        </div>
      </div>
      <form id="form-resultados-somatometria" class="row overflow-auto" style="max-height: 70vh;margin-bottom:10px;">
        <div class="col-12 col-lg-6" style="padding-right: 0px;">
          <ul class="list-group hover-list info-detalle">
            <li class="list-group-item">
              <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Frecuencia Cardiaca</p>
              <div class="input-group">
                <input type="text" class="form-control input-form" id="frecuenciaCardiaca" name="medidas[]resultado[]" placeholder="">
                <span class="input-span">bpm</span>
              </div>
            </li>

            <li class="list-group-item">
              <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Frecuencia Respiratoria</p>
              <div class="input-group">
                <input type="text" class="form-control input-form" id="frecuenciaRespiratoria" name="medidas[]resultado[]" placeholder="">
                <span class="input-span">rpm</span>
              </div>

            </li>

            <li class="list-group-item">
              <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Sistólica</p>
              <div class="input-group">
                <input type="text" class="form-control input-form" id="sistolica" name="medidas[]resultado[]" placeholder="">
                <span class="input-span">mmHg</span>
              </div>
            </li>
          </ul>
        </div>
        <div class="col-12 col-lg-6" style="padding-left: 0px;">
          <ul class="list-group hover-list info-detalle">
            <li class="list-group-item">
              <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Diastólica</p>
              <div class="input-group">
                <input type="text" class="form-control input-form" id="diastolica" name="medidas[]resultado[]" placeholder="">
                <span class="input-span">mmHg</span>
              </div>
            </li>

            <li class="list-group-item">
              <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Saturación de Oxígeno</p>
              <div class="input-group">
                <input type="text" class="form-control input-form" id="saturacionOxigeno" name="medidas[]resultado[]" placeholder="">
                <span class="input-span">%</span>
              </div>
            </li>

            <li class="list-group-item">
              <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Temperatura</p>
              <div class="input-group">
                <input type="text" class="form-control input-form" id="temperatura" name="medidas[]resultado[]" placeholder="">
                <span class="input-span">C</span>
              </div>
            </li>
          </ul>
        </div>
        <div class="accordion" id="accordinSomatrometria">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headSomatometria">
              <button class="accordion-button collapsed" id="collapseSOMATOMETRIABOTON" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSomato" aria-expanded="false" aria-controls="collapseSomato">
                Somatometría
              </button>
            </h2>
            <div id="collapseSomato" class="accordion-collapse collapse" aria-labelledby="headSomatometria" data-bs-parent="#accordinSomatrometria">
              <div class="accordion-body row">
                <div class="col-12 col-lg-6" style="padding-right: 0px;">
                  <ul class="list-group hover-list info-detalle">
                    <li class="list-group-item ">


                      <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Estatura</p>
                      <div class="input-group">
                        <input type="text" class="form-control input-form" data-id='calculoEstaturaMasaCorpo' id="estatura" name="medidas[]resultado[]" placeholder="">
                        <span class="input-span">cm</span>
                      </div>

                    </li>
                    <li class="list-group-item">
                      <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Peso</p>
                      <div class="input-group">
                        <input type="text" class="form-control input-form" data-id='calculoPesoMasaCorpo' id="peso" name="medidas[]resultado[]" placeholder="">
                        <span class="input-span">kg</span>
                      </div>

                    </li>
                    <li class="list-group-item">
                      <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Masa Corporal</p>
                      <div class="input-group">
                        <input type="text" class="form-control input-form" data-id="calculoMasaCorpo" id="masaCorporal" name="medidas[]resultado[]" placeholder="" disabled>
                        <span class="input-span">kg/m2</span>
                      </div>

                    </li>
                    <script>
                      $(document).on("change keyup", "input[data-id='calculoEstaturaMasaCorpo'] , input[data-id='calculoPesoMasaCorpo']", function() {
                        console.log($(this).val());
                        if ($("input[data-id='calculoEstaturaMasaCorpo']").val() && $("input[data-id='calculoPesoMasaCorpo']").val()) {
                          let estatura = (parseFloat($("input[data-id='calculoEstaturaMasaCorpo']").val()) / 100);
                          estatura = estatura * estatura;
                          console.log(estatura)
                          let peso = parseFloat($("input[data-id='calculoPesoMasaCorpo']").val())
                          $("input[data-id='calculoMasaCorpo").val((peso / estatura).toFixed(2))
                        } else {
                          $("input[data-id='calculoMasaCorpo']").val('');
                        }
                      })
                    </script>

                    <li class="list-group-item">
                      <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Masa Muscular</p>
                      <div class="input-group">
                        <input type="text" class="form-control input-form" id="masaMuscular" name="medidas[]resultado[]" placeholder="">
                        <span class="input-span">kg</span>
                      </div>

                    </li>
                    <li class="list-group-item">
                      <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Porcentaje de Grasa Visceral</p>
                      <div class="input-group">
                        <input type="text" class="form-control input-form" id="porcentajeGrasaVisceral" name="medidas[]resultado[]" placeholder="">
                        <span class="input-span">%</span>
                      </div>

                    </li>

                  </ul>
                </div>
                <div class="col-12 col-lg-6" style="padding-left: 0px;">
                  <ul class="list-group hover-list info-detalle">

                    <li class="list-group-item">
                      <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Huesos</p>
                      <div class="input-group">
                        <input type="text" class="form-control input-form" id="huesos" name="medidas[]resultado[]" placeholder="">
                        <span class="input-span">mm</span>
                      </div>

                    </li>
                    <li class="list-group-item">
                      <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Metabolismo</p>
                      <div class="input-group">
                        <input type="text" class="form-control input-form" id="metabolismo" name="medidas[]resultado[]" placeholder="">
                        <span class="input-span">tmb</span>
                      </div>

                    </li>

                    <li class="list-group-item">
                      <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Edad del cuerpo</p>
                      <div class="input-group">
                        <input type="text" class="form-control input-form" id="edadCuerpo" name="medidas[]resultado[]" placeholder="">
                        <span class="input-span">años</span>
                      </div>

                    </li>
                    <li class="list-group-item">
                      <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Perímetro Cefálico</p>
                      <div class="input-group">
                        <input type="text" class="form-control input-form" id="perimetroCefalico" name="medidas[]resultado[]" placeholder="">
                        <span class="input-span">cm</span>
                      </div>

                    </li>
                    <li class="list-group-item">
                      <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Porcentaje de Proteínas</p>
                      <div class="input-group">
                        <input type="text" class="form-control input-form" id="porcentajeProteinas" name="medidas[]resultado[]" placeholder="">
                        <span class="input-span">%</span>
                      </div>

                    </li>
                    <li class="list-group-item">
                      <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Porcentaje de Agua</p>
                      <div class="input-group">
                        <input type="text" class="form-control input-form" id="porcentajeAgua" name="medidas[]resultado[]" placeholder="">
                        <span class="input-span">%</span>
                      </div>

                    </li>

                  </ul>
                </div>
              </div>
            </div>
          </div>

        </div>
      </form>
      <!-- 
      <form id="form-resultados-somatometria" class="row">

        
</form> -->

    </div>
  </div>


  <div class="col-4 col-lg-8 col-xxl-9 d-flex justify-content-center align-items-center" id='loaderDivSignos' style="max-height: 75vh; display:none">
    <div class="preloader" id="loader-Signos"></div>
  </div>
</div>
<style media="screen">
  #TablaSignos_filter {
    display: none
  }
</style>