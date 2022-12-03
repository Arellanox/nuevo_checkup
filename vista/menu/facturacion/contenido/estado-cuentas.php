<div class="row">
  <div class="col-12">
    <ul class="nav nav-tabs mt-2">
      <!-- Vista areas -->
      <li class="nav-item">
        <a class="nav-link VistaEstadoCuenta active disabled" aria-current="page" type="button" data-ds="1">Facturar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link VistaEstadoCuenta" type="button" data-ds="2">Grupos de cuentas</a>
      </li>
    </ul>
  </div>

  <!-- Div de todas las vistas -->
  <section class="row vistaArea" id="VistaFacturarEstadoCuenta" style="display:none">
    <!-- información y busqueda del estado de cuenta -->
    <div class="col-3">
      <div class="m-2 card p-3">
        <h4>Datos Generales</h4>
        <!-- Tipo de estado de cuenta -->
        <div class="row" id="selectDisabled">
          <div class="col-6">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="radioParticular" checked>
              <label class="form-check-label" for="radioParticular">
                Particular
              </label>
            </div>
          </div>
          <div class="col-6">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="radioGrupos">
              <label class="form-check-label" for="radioGrupos">
                Grupos
              </label>
            </div>
          </div>
          <label for="inputBuscarEstadoCuenta">Numero:</label>
          <input type="number" class="form-control input-form" id="inputBuscarEstadoCuenta">
        </div>
        <!-- Buscar el estado de cuenta -->
        <div>
          <button class="btn btn-sm btn-confirmar" type="button" id="BuscarNumeroCuenta"><i class="bi bi-binoculars"></i> Buscar</button>
          <button class="btn btn-sm btn-confirmar" type="button" id="LimpiarNumeroCuenta"><i class="bi bi-eraser"></i> Limpiar</button>
        </div>
      </div>


      <!-- Información del paciente -->
      <div class="m-2 row vistaCargosFacturar" id="informacionCargosFacturar">
        <!-- Paciente -->
        <div class="mt-2 card p-2" id="panel-informacion"></div>
        
        <!-- Datos de los cargos -->
        <div class="col-12 pt-2" id="informacionCargos" style="display:none">
          <div class="row">
            <div class="col-12 text-center">
              <h5>Cargos</h5>
            </div>
            <div class="col-6 text-start info-detalle">
              <p>Descuento:</p>
            </div>
            <div class="col-6" id="subtotal-costo-paquete"></div>
            <div class="col-6 text-start info-detalle">
              <p>Subtotal:</p>
            </div>
            <div class="col-6" id="subtotal-costo-paquete"></div>
            <div class="col-6 text-start info-detalle">
              <p>IVA:</p>
            </div>
            <div class="col-6"> 16%</div>
            <div class="col-6 text-start info-detalle">
              <p>Total facturación:</p>
            </div>
            <div class="col-6" id="subtotal-precioventa-paquete"></div>
            <div class="col-6 text-start info-detalle">
              <p>Pagos:</p>
            </div>
            <div class="col-6" id="total-paquete"></div>
            <div class="col-6 text-start info-detalle">
              <p>Total a pagar:</p>
            </div>
            <div class="col-6" id="total-paquete"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Vista de cargos -->
    <div class="col-9 vistaCargosFacturar" id="vistaCargosFacturar" style="display: none">
      <div class="m-2 card">
        <div class="row m-3">

          <!-- Navegador del area -->
          <div class="col-12">
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a type="button" class="nav-link vistaFacturar active disabled" data-ds="1">Cargos</a>
              </li>
              <li class="nav-item">
                <a type="button" class="nav-link vistaFacturar" data-ds="2">Factura paciente</a>
              </li>
              <li class="nav-item">
                <a type="button" class="nav-link vistaFacturar disabled" data-ds="3">Factura cliente</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Consulta factura</a>
              </li> -->
            </ul>
          </div>



          <!-- Tabla de cargos -->
          <div class="col-12 vistaFacturarSeccion" id="TablaCargosVista" style="display:none"> 
            <div class="col-12 d-flex align-items-center d-flex justify-content-end">
              <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="guardar-contenido-paquete">
                <i class="bi bi-person-plus-fill"></i> Guardar
              </button>
            </div>
            <table class="table table-hover display responsive " id="TablaListaCargos" style="width: 100%;">
              <thead style="width: 100%">
                <tr>
                  <th scope="col d-flex justify-content-center" class="all">Servicio</th>
                  <th scope="col d-flex justify-content-center" class="all">Precio</th>
                  <th scope="col d-flex justify-content-center" class="min-tablet">Cant.</th>
                  <th scope="col d-flex justify-content-center" class="min-tablet">Importe</th>
                  <th scope="col d-flex justify-content-center" class="min-tablet">Descuento</th>
                  <th scope="col d-flex justify-content-center" class="min-tablet">Subtotal</th>
                  <th scope="col d-flex justify-content-center" class="min-tablet">IVA</th>
                  <th scope="col d-flex justify-content-center" class="min-tablet">Monto Total</th>
                  <th scope="col d-flex justify-content-center" class="all" style="display:none">ID</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>



          <!-- facturar paciente -->
          <div class="col-12 vistaFacturarSeccion" id="FormularioFacturarPaciente" style="display:none">
            formulario
          </div>



          <!-- facturar cliente -->
          <div class="col-12 vistaFacturarSeccion" id="FormularioFacturarCliente" style="display:none">
            formulario facturar cliente
          </div>



        </div>


        <!-- Tabla de servicios y formulario de facturar el paciente

        ¿¿¿ información de facturacion ??? -->
      </div>
    </div>


    <div class="col-9 d-flex justify-content-center align-items-center" id='loaderDivestadoCuenta' style="max-height: 75vh; display:none !important">
      <div class="preloader" id="loader-estadoCuenta"></div>
    </div>
  </section>


  <section class="row vistaArea" id="vistaFacturarGrupoCuenta" style="display:none">
    <!-- Vista de grupos -->
    Grupos
  </section>
</div>
