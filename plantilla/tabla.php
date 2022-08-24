<div class="table-responsive" id="ContenidoAntigeno">
  <table class="table table-sm table-hover display responsive" id="TablaEjemplo" style="width: 100%">
    <thead class="">
      <tr>
        <th scope="col d-flex justify-content-center" class="all">#</th>
        <th scope="col d-flex justify-content-center" class="all">Nombre</th>
        <th scope="col d-flex justify-content-center" class="min-tablet">Prefolio</th>
        <th scope="col d-flex justify-content-center" class="desktop">Turno</th>
        <th scope="col d-flex justify-content-center" class="min-tablet">Procedencia</th>
        <th scope="col d-flex justify-content-center" class="desktop">Segmento</th>
        <th scope="col d-flex justify-content-center" class="desktop">Ingreso</th>
        <th scope="col d-flex justify-content-center" class="all">Acciones</th>
        <th scope="col d-flex justify-content-center" class="none">Editar</th>
        <th scope="col d-flex justify-content-center" class="none">Perfil</th>
        <th scope="col d-flex justify-content-center" class="none">Sexo</th>
      </tr>
    </thead>
    <tbody>
      <?php  for ($i=1; $i <= 10; $i++) { ?>
        <tr>
            <th><?php echo $i ?></th>
            <td> CUEVAS GONZÁLEZ LUIS GERARDO </td>
            <td>2022SJ29AJ20</td>
            <td>SLB12</td>
            <td>SLCHUMBERGER</td>
            <td></td>
            <td>2022-04-01</td>
            <td>
              <div class="row">
                <div class="col">
                <a class="btn-table" href="" data-bs-toggle="modal" data-bs-target="#">
                  <i class="bi bi-check"></i>Aceptar
                </a>
                </div>
                  <div class="col">
                  <a class="btn-table" href="" data-bs-toggle="modal" data-bs-target="#">
                    <i class="bi bi-x"></i>Rechazar
                  </a>
                  </div>
              </div>
            </td>
            <td>
              <a class="btn-table" href="" data-bs-toggle="modal" data-bs-target="#"> <i class="bi bi-pencil-square"></i> Editar </a>
            </td>
            <td>
              <a class="btn-table" href="" data-bs-toggle="modal" data-bs-target="#">
                <i class="bi bi-image"></i> Subir
              </a>
            </td>
            <td>EJEMPLO</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
