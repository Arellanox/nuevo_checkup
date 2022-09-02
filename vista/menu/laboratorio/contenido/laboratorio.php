<div class="table-responsive">
  <div class="text-center" style="margin-top:4px;">
    <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-aceptar">
      <i class="bi bi-check"></i> Aceptar paciente
    </button>
    <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-rechazar">
      <i class="bi bi-x"></i> Rechazar paciente
    </button>
  </div>

  <table class="table display responsive" id="TablaLaboratorio" style="width: 100%">
    <thead class="">
      <tr>
        <th scope="col d-flex justify-content-center" class="all">#</th>
        <th scope="col d-flex justify-content-center" class="all">Nombre</th>
        <th scope="col d-flex justify-content-center" class="min-tablet">Numero de kit</th>
        <th scope="col d-flex justify-content-center" class="min-tablet">Fecha de ingreso</th>
        <th scope="col d-flex justify-content-center" class="desktop">FOLIO de kit</th>
        <th scope="col d-flex justify-content-center" class="min-tablet">Ingreso</th>
      </tr>
    </thead>
    <tbody>
      <?php  for ($i=1; $i <= 11; $i++) { ?>
        <tr id="<?php echo "row_".$i; ?>">
            <th><?php echo $i ?></th>
            <td> CUEVAS GONZÁLEZ LUIS GERARDO </td>
            <td>2022SJ29AJ20</td>
            <td>SLCHUMBERGER</td>
            <td></td>
            <td>2022-04-01</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
