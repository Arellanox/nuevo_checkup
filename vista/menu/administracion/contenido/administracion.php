<div class="col-12 d-flex align-items-center justify-content-center noloader" id="loader" style="display:none;">
  <div class="" id="preloader"> </div>
</div>
<div class="table-responsive " id="ContenidoHTML">
  <div class="text-center" style="margin-top:4px;zoom:95%">
    <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-aceptar">
      <i class="bi bi-eye"></i> Vistas
    </button>
    <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-rechazar">
      <i class="bi bi-list-check"></i> Permisos
    </button>
    <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-rechazar">
      <i class="bi bi-pencil"></i> Editar
    </button>
    <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-rechazar">
      <i class="bi bi-person-badge"></i> Estado
    </button>
  </div>

  <table class="table display responsive" id="TablaUsuariosAdmin" style="width: 100%">
    <thead class="">
      <tr>
        <th scope="col d-flex justify-content-center" class="all">#</th>
        <th scope="col d-flex justify-content-center" class="all">Nombre</th>
        <th scope="col d-flex justify-content-center" class="all">Usuario</th>
        <th scope="col d-flex justify-content-center" class="min-tablet">Cargo</th>
        <th scope="col d-flex justify-content-center" class="desktop">Tipo</th>
        <th scope="col d-flex justify-content-center" class="min-tablet">Estado</th>
        <th scope="col d-flex justify-content-center" class="none">Profesión</th>
        <th scope="col d-flex justify-content-center" class="none">Cédula</th>
      </tr>
    </thead>
    <tbody>
      <?php  for ($i=1; $i <= 11; $i++) { ?>
        <tr id="<?php echo "row_".$i; ?>">
            <th><?php echo $i ?></th>
            <td> CUEVAS GONZÁLEZ LUIS GERARDO </td>
            <td>Ger</td>
            <td>Programador</td>
            <td>Administrador</td>
            <td>ACTIVO</td>
            <td>EJEMPLO</td>
            <td>EJEMPLO</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
