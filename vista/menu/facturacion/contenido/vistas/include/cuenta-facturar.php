<!-- información y busqueda del estado de cuenta -->
<div class="col-3">
  <div class="m-2 card">
    <div class="m-3">
      <h4>Datos Generales</h4>
      <!-- Tipo de estado de cuenta -->
      <div class="row">
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
      </div>
      <!-- Buscar el estado de cuenta -->
      <div class="">
        <div class="" id="selectDisabled">
          <label for="inputBuscarEstadoCuenta">Numero:</label>
          <input type="number" class="form-control input-form" id="inputBuscarEstadoCuenta">
          <button class="btn btn-sm btn-confirmar" type="button" id="BuscarNumeroCuenta"><i class="bi bi-binoculars"></i> Buscar</button>
          <button class="btn btn-sm btn-confirmar" type="button" id="LimpiarNumeroCuenta"><i class="bi bi-eraser"></i> Limpiar</button>
        </div>
      </div>
      <div class="row vistaCargosFacturar" id="informacionCargosFacturar">
        <div class="mt-2" id="panel-informacion"></div>
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
  </div>
</div>



<!-- Vista de cargos -->
<div class="col-9 vistaCargosFacturar" id="vistaCargosFacturar" style="display: none">
  <div class="m-2 card">
    <div class="row m-3">
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
      <div class="col-12" id="TablaCargosVista" style="display:none">
        <!-- Tabla de cargos -->
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
      <div class="col-12" id="FormularioFacturarPaciente" style="display:none">
        <!-- facturar paciente -->
      </div>
      <div class="col-12" id="FormularioFacturarCliente" style="display:none">
        <!-- facturar cliente -->
      </div>
      <!-- Carga de pantalla -->
      <div class="col-12 d-flex justify-content-center align-items-center" id='loaderDivEstadoCuenta' style="max-height: 75vh;">
        <div class="preloader" id="loader-EstadoCuenta"></div>
      </div>

    </div>
    <!-- Tabla de servicios y formulario de facturar el paciente

    ¿¿¿ información de facturacion ??? -->
  </div>
</div>
