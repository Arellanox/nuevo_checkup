<div class="col-12 loader" id="loader" style="">
  <div class="preloader" id="preloader"> </div>
</div>
<div class="row">
  <div class="col-3 col-lg-3" style="margin-right: -5px !important;">
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
  <div class="col-3 col-lg-3 informacion-Signos" style="margin-right: -5px !important;display:none">
    <div class="card m-3" id="panel-informacion"> </div>
    <!-- <div class="card m-3 p-4">
      <h4>Estudios anteriores</h4>
      <div class="accordion" id="accordionResultadosAnteriores">
      </div>
    </div> -->
  </div>
  <div class="col-lg-6 informacion-Signos" style="margin-right: -5px !important;display:none">
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
      <form class="" id="form-resultados-somatometria">
        <ul class="list-group m-4 overflow-auto hover-list info-detalle" style="max-width: 100%; max-height: 65vh;margin-bottom:10px;">
          <li class="list-group-item ">
            <div class="row d-flex align-items-center">
              <div class="col-6 col-lg-8">
                <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Estatura</p>
              </div>
              <div class="col-6 col-lg-4">
                <div class="input-group">
                  <input type="number" class="form-control input-form" name="medidas[]resultado[]" placeholder=""  > <!-- required -->
                  <span class="input-span">m</span>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row d-flex align-items-center">
              <div class="col-6 col-lg-8">
                <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Peso</p>
              </div>
              <div class="col-6 col-lg-4">
                <div class="input-group">
                  <input type="number" class="form-control input-form" name="medidas[]resultado[]" placeholder=""  > <!-- required -->
                  <span class="input-span">kg</span>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row d-flex align-items-center">
              <div class="col-6 col-lg-8">
                <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Masa Corporal</p>
              </div>
              <div class="col-6 col-lg-4">
                <div class="input-group">
                  <input type="number" class="form-control input-form" name="medidas[]resultado[]" placeholder=""  > <!-- required -->
                  <span class="input-span">kg/m2</span>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row d-flex align-items-center">
              <div class="col-6 col-lg-8">
                <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Temperatura</p>
              </div>
              <div class="col-6 col-lg-4">
                <div class="input-group">
                  <input type="number" class="form-control input-form" name="medidas[]resultado[]" placeholder=""  > <!-- required -->
                  <span class="input-span">C</span>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row d-flex align-items-center">
              <div class="col-6 col-lg-8">
                <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Frecuencia Respiratoria</p>
              </div>
              <div class="col-6 col-lg-4">
                <div class="input-group">
                  <input type="number" class="form-control input-form" name="medidas[]resultado[]" placeholder=""  > <!-- required -->
                  <span class="input-span">r/m</span>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row d-flex align-items-center">
              <div class="col-6 col-lg-8">
                <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Sistólica</p>
              </div>
              <div class="col-6 col-lg-4">
                <div class="input-group">
                  <input type="number" class="form-control input-form" name="medidas[]resultado[]" placeholder=""  > <!-- required -->
                  <span class="input-span">mmHg</span>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row d-flex align-items-center">
              <div class="col-6 col-lg-8">
                <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Diastólica</p>
              </div>
              <div class="col-6 col-lg-4">
                <div class="input-group">
                  <input type="number" class="form-control input-form" name="medidas[]resultado[]" placeholder=""  > <!-- required -->
                  <span class="input-span">mmHg</span>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row d-flex align-items-center">
              <div class="col-6 col-lg-8">
                <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Frecuencia Cardiaca</p>
              </div>
              <div class="col-6 col-lg-4">
                <div class="input-group">
                  <input type="number" class="form-control input-form" name="medidas[]resultado[]" placeholder=""  > <!-- required -->
                  <span class="input-span">bpm</span>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row d-flex align-items-center">
              <div class="col-6 col-lg-8">
                <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Masa Muscular</p>
              </div>
              <div class="col-6 col-lg-4">
                <div class="input-group">
                  <input type="number" class="form-control input-form" name="medidas[]resultado[]" placeholder=""  > <!-- required -->
                  <span class="input-span">kg</span>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row d-flex align-items-center">
              <div class="col-6 col-lg-8">
                <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Perímetro Cefálico</p>
              </div>
              <div class="col-6 col-lg-4">
                <div class="input-group">
                  <input type="number" class="form-control input-form" name="medidas[]resultado[]" placeholder=""  > <!-- required -->
                  <span class="input-span">cm</span>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row d-flex align-items-center">
              <div class="col-6 col-lg-8">
                <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Saturación de Oxígeno</p>
              </div>
              <div class="col-6 col-lg-4">
                <input type="number" class="form-control input-form" name="medidas[]resultado[]" placeholder=""  > <!-- required -->
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row d-flex align-items-center">
              <div class="col-6 col-lg-8">
                <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Porcentaje de Agua</p>
              </div>
              <div class="col-6 col-lg-4">
                <div class="input-group">
                  <input type="number" class="form-control input-form" name="medidas[]resultado[]" placeholder=""  > <!-- required -->
                  <span class="input-span">%</span>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row d-flex align-items-center">
              <div class="col-6 col-lg-8">
                <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Porcentaje de Grasa Visceral</p>
              </div>
              <div class="col-6 col-lg-4">
                <div class="input-group">
                  <input type="number" class="form-control input-form" name="medidas[]resultado[]" placeholder=""  > <!-- required -->
                  <span class="input-span">%</span>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row d-flex align-items-center">
              <div class="col-6 col-lg-8">
                <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Huesos</p>
              </div>
              <div class="col-6 col-lg-4">
                <div class="input-group">
                  <input type="number" class="form-control input-form" name="medidas[]resultado[]" placeholder=""  > <!-- required -->
                  <span class="input-span">mm</span>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row d-flex align-items-center">
              <div class="col-6 col-lg-8">
                <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Metabolismo</p>
              </div>
              <div class="col-6 col-lg-4">
                <div class="input-group">
                  <input type="number" class="form-control input-form" name="medidas[]resultado[]" placeholder=""  > <!-- required -->
                  <span class="input-span">tmb</span>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row d-flex align-items-center">
              <div class="col-6 col-lg-8">
                <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Porcentaje de Proteínas</p>
              </div>
              <div class="col-6 col-lg-4">
                <div class="input-group">
                  <input type="number" class="form-control input-form" name="medidas[]resultado[]" placeholder=""  > <!-- required -->
                  <span class="input-span">%</span>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row d-flex align-items-center">
              <div class="col-6 col-lg-8">
                <p><i class="bi bi-box-arrow-in-right" style="zoom:120%"></i> Edad del cuerpo</p>
              </div>
              <div class="col-6 col-lg-4">
                <div class="input-group">
                  <input type="number" class="form-control input-form" name="medidas[]resultado[]" placeholder=""  > <!-- required -->
                  <span class="input-span">años</span>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </form>
    </div>
  </div>


  <div class="col-9 d-flex justify-content-center align-items-center" id='loaderDivSignos' style="max-height: 75vh; display:none">
    <div class="preloader" id="loader-Signos"></div>
  </div>
</div>
<style media="screen">
  #TablaSignos_filter{
    display: none
  }
</style>