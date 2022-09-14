<div class="col-12 loader" id="loader" style="">
  <div class="preloader" id="preloader"> </div>
</div>
<div class="row">
  <div class="col-12 col-lg-3">
    <div class="row" style="margin-top: 43px">
      <div class="col-3">
        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="perfil" class="imagen-perfil">
      </div>
      <div class="col-9">
        <p id="nombre-persona">Nombre completo del paciente</p>
        <p id="nacimiento-persona" style="margin-top:-10px">08/12/2000 | X años</p>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-9">
    <div class="table-responsive">
      <div class="text-center" style="margin-top:4px;">
        <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-aceptar">
          <i class="bi bi-check"></i> Aceptar paciente
        </button>
        <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-rechazar">
          <i class="bi bi-x"></i> Rechazar paciente
        </button>
      </div>

      <table class="table table-hover display responsive" id="TablaEjemplo" style="width: 100%">
        <thead class="">
          <tr>
            <th scope="col d-flex justify-content-center" class="all">#</th>
            <th scope="col d-flex justify-content-center" class="all">Nombre</th>
            <th scope="col d-flex justify-content-center" class="min-tablet">Prefolio</th>
            <th scope="col d-flex justify-content-center" class="min-tablet">Procedencia</th>
            <th scope="col d-flex justify-content-center" class="desktop">Segmento</th>
            <th scope="col d-flex justify-content-center" class="min-tablet">Ingreso</th>
            <th scope="col d-flex justify-content-center" class="none">Sexo</th>
          </tr>
        </thead>
        <tbody>
          <?php  for ($i=1; $i <= 40; $i++) { ?>
            <tr id="<?php echo "row_".$i; ?>">
                <th><?php echo $i ?></th>
                <td> CUEVAS GONZÁLEZ LUIS GERARDO </td>
                <td>2022SJ29AJ20</td>
                <td>SLCHUMBERGER</td>
                <td></td>
                <td>2022-04-01</td>
                <td>EJEMPLO</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
