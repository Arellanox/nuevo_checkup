<?php $menu = $_POST['menu']; ?>

<!-- RECEPCIÓN -->
<?php if ($menu == "Recepción"): ?>
  <li class="nav-item">
    <a href="" data-bs-toggle="modal" data-bs-target="#ModalRegistrarPaciente">
      Nuevo Paciente
    </a>
  </li>
<?php endif; ?>
<?php if ($menu == "Recepción"): ?>
  <li class="nav-item">
    <a href="" data-bs-toggle="modal" data-bs-target="#ModalRegistrarPrueba">
      Nuevo Registro
    </a>
  </li>
<?php endif; ?>
<!-- FIN DE RECEPCIÓN -->


<!-- CONSULTORIO -->
<?php if ($menu == "Recepción" || $menu == "Consultorio"): ?>
  <li class="nav-item Recepción">
    <div class="dropdown ">
      <a class="dropdown-toggle" href="#" id="dropadmin" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Consultorio
      </a>
      <ul class="dropdown-menu bg-navbar-drop" aria-labelledby="dropadmin">
        <li><a class="dropdown-a" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#">Consultorio</a></li>
        <li><a class="dropdown-a" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#">Mesometria</a></li>
      </ul>
    </div>
  </li>
<?php endif; ?>
