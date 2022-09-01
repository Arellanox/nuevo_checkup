<?php if ($menu == "Recepción"): ?>
  <li class="nav-item">
    <a href="" data-bs-toggle="modal" data-bs-target="#ModalRegistrarPaciente" data-bs-dismiss="offcanvas">
      <i class="bi bi-person-plus"></i> Nuevo Paciente
    </a>
  </li>
  <li class="nav-item">
    <a href="" data-bs-toggle="modal" data-bs-target="#ModalRegistrarPrueba" data-bs-dismiss="offcanvas">
      <i class="bi bi-person-lines-fill"></i> Nuevo Registro
    </a>
  </li>
  <li class="nav-item">
    <a href="" data-bs-toggle="modal" data-bs-target="#modalExample" data-bs-dismiss="offcanvas">
      <i class="bi bi-person-x-fill"></i> Pacientes Rechazados
    </a>
  </li>
<?php endif; ?>
<?php if ($menu == "Administración | Usuarios"): ?>
  <li class="nav-item">
    <a href="<?php echo $https.$url.'/nuevo_checkup/vista/menu/recepcion/'; ?>" data-bs-dismiss="offcanvas">
      <i class="bi bi-people-fill"></i> Recepción
    </a>
  </li>
  <li class="nav-item">
    <a href="#Usuarios" data-bs-dismiss="offcanvas">
      <i class="bi bi-person-lines-fill"></i> Usuarios
    </a>
  </li>
  <li class="nav-item">
    <a href="#Clientes" data-bs-dismiss="offcanvas">
      <i class="bi bi-person-lines-fill"></i> Clientes
    </a>
  </li>
  <li class="nav-item">
    <a href="#Servicios" data-bs-dismiss="offcanvas">
      <i class="bi bi-box"></i> Servicios
    </a>
  </li>
<?php endif; ?>
