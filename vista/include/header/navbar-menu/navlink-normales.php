
<?php if ($menu == "Usuarios" || $menu == "Mesometria" || $menu == "Servicios"): ?>
  <li class="nav-item">
    <a href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/recepcion/'; ?>" data-bs-dismiss="offcanvas">
      <i class="bi bi-people-fill"></i> Recepción
    </a>
  </li>
<?php endif; ?>
<!-- <?php if ($menu == "Mesometria"): ?>
  <li class="nav-item">
    <a href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/consultorio/'; ?>" data-bs-dismiss="offcanvas">
      <i class="bi bi-clipboard"></i> Consultorio
    </a>
  </li>
<?php endif; ?> -->


<?php if ($menu == "Recepción") : ?>
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

<?php if ($menu == "Usuarios" && $_SESSION['perfil'] == 1) : ?>
  <li class="nav-item">
    <a href="" data-bs-dismiss="offcanvas" data-bs-toggle="modal" data-bs-target="#modalRegistrarCargo">
      <i class="bi bi-briefcase"></i> Nuevo cargo
    </a>
  </li>
  <!-- <li class="nav-item">
      <a href="" data-bs-dismiss="offcanvas" data-bs-toggle="modal" data-bs-target="#ModalRegistrarTipoUser">
        <i class="bi bi-person-lines-fill"></i> Nuevo tipo usuario
      </a>
    </li> -->
  <li class="nav-item">
    <a href="#Usuarios" data-bs-dismiss="offcanvas" class="">
      <i class="bi bi-person-lines-fill"></i> Usuarios
    </a>
  </li>
  <!-- <li class="nav-item">
    <a href="#Servicios" data-bs-dismiss="offcanvas">
      <i class="bi bi-box"></i> Servicios
    </a>
  </li> -->
  <li class="nav-item">
    <a href="#Segmentos" data-bs-dismiss="offcanvas">
      <i class="bi bi-box"></i> Segmentos
    </a>
  </li>
<?php endif; ?>

<?php if ($menu == "Servicios"): ?>
  <li class="nav-item">
    <a href="#Estudio" data-bs-dismiss="offcanvas">
      <i class="bi bi-box"></i> Estudios
    </a>
  </li>
  <li class="nav-item">
    <a href="#Paquetes" data-bs-dismiss="offcanvas">
      <i class="bi bi-box"></i> Paquetes
    </a>
  </li>
  <li class="nav-item">
    <a href="#Precios" data-bs-dismiss="offcanvas">
      <i class="bi bi-box"></i> Precios
    </a>
  </li>
<?php endif; ?>
