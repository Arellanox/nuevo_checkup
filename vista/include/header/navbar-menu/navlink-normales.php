<?php if ($menu != "Recepción") : ?>
  <li class="nav-item">
    <a href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/recepcion/'; ?>" data-bs-dismiss="offcanvas">
      <i class="bi bi-people-fill"></i> Recepción
    </a>
  </li>
<?php endif; ?>
<!-- <?php if ($menu == "Mesometria") : ?>
  <li class="nav-item">
    <a href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/consultorio/'; ?>" data-bs-dismiss="offcanvas">
      <i class="bi bi-clipboard"></i> Consultorio
    </a>
  </li>
<?php endif; ?> -->


<?php if ($menu == "Recepción") : ?>
  <li class="nav-item">
    <a href="" data-bs-toggle="modal" data-bs-target="#ModalRegistrarPaciente" data-bs-dismiss="offcanvas">
      <i class="bi bi-person-plus"></i> Registrar paciente
    </a>
  </li>
  <li class="nav-item">
    <a href="" data-bs-toggle="modal" data-bs-target="#ModalRegistrarPrueba" data-bs-dismiss="offcanvas">
      <i class="bi bi-person-lines-fill"></i> Agendar registro
    </a>
  </li>
  <li class="nav-item">
    <a href="" data-bs-toggle="modal" data-bs-target="#modalSolicitudIngresoParticulares" data-bs-dismiss="offcanvas">
      <i class="bi bi-person-lines-fill"></i> Solicitud de registro
    </a>
  </li>
  <li class="nav-item">
    <a href="#pendientes" type="button" data-bs-dismiss="offcanvas">
      <i class="bi bi-person-x-fill"></i> Pacientes en espera
    </a>
  </li>
  <li class="nav-item">
    <a href="#rechazados" type="button" data-bs-dismiss="offcanvas">
      <i class="bi bi-person-x-fill"></i> Pacientes Rechazados
    </a>
  </li>
  <li class="nav-item">
    <a href="#ingresados" type="button" data-bs-dismiss="offcanvas">
      <i class="bi bi-person-x-fill"></i> Pacientes Ingresados
    </a>
  </li>
<?php endif; ?>

<?php if ($menu == "Usuarios" && $_SESSION['perfil'] == 1) : ?>
  <li class="nav-item">
    <a href="" data-bs-dismiss="offcanvas" data-bs-toggle="modal" data-bs-target="#modalRegistrarCargo">
      <i class="bi bi-briefcase"></i> Nuevo cargo
    </a>
  </li>
  <li class="nav-item">
    <a href="#Usuarios" data-bs-dismiss="offcanvas" class="">
      <i class="bi bi-person-lines-fill"></i> Usuarios
    </a>
  </li>
<?php endif; ?>

<?php if ($menu == "Servicios" || $menu == "ServiciosLab") : ?>
  <?php if ($_SESSION['vista']['LABORATORIO'] == 1): ?>
    <li class="nav-item">
      <a href="" data-bs-toggle="modal" data-bs-target="#ModalVistaMetodos" data-bs-dismiss="offcanvas">
        <i class="bi bi-box"></i> Metodos
      </a>
    </li>
  <?php endif; ?>
  <?php if ($_SESSION['vista']['LABORATORIO'] == 1): ?>
    <li class="nav-item">
      <a href="#Estudios" data-bs-dismiss="offcanvas">
        <i class="bi bi-box"></i> Estudios
      </a>
    </li>
  <?php endif; ?>
  <?php if ($_SESSION['vista']['LABORATORIO'] == 1): ?>
    <li class="nav-item">
      <a href="#Grupos" data-bs-dismiss="offcanvas">
        <i class="bi bi-collection"></i> Grupos de examenes
      </a>
    </li>
  <?php endif; ?>
  <?php if ($_SESSION['vista']['SERVICIOS (EQUIPOS)'] == 1 || true): ?>
    <li class="nav-item">
      <a href="#Equipos" data-bs-dismiss="offcanvas">
        <i class="bi bi-thunderbolt"></i> Equipos
      </a>
    </li>
  <?php endif; ?>
<?php endif; ?>

<?php if ($menu == "ListaPrecios") : ?>
  <li class="nav-item">
    <a href="#PreciosEstudios" data-bs-dismiss="offcanvas">
      <i class="bi bi-thunderbolt"></i> Precios Estudio
    </a>
  </li>
  <li class="nav-item">
    <a href="#PaquetesClientes" data-bs-dismiss="offcanvas">
      <i class="bi bi-thunderbolt"></i> Paquetes Estudios
    </a>
  </li>
<?php endif; ?>

<?php if ($menu == "Consultorio") : ?>
  <li class="nav-item">
    <a href="#Main" type="button">
      <i class="bi bi-thunderbolt"></i> Consultorio
    </a>
  </li>
  <li class="nav-item">
    <a href="#Perfil" data-bs-dismiss="offcanvas">
      <i class="bi bi-thunderbolt"></i> Perfil paciente
    </a>
  </li>
  <li class="nav-item">
    <a href="#Consultorio" data-bs-dismiss="offcanvas">
      <i class="bi bi-thunderbolt"></i> Consultorio
    </a>
  </li>
<?php endif; ?>

<?php if ($menu == 'Facturacion'): ?>
  <li class="nav-item">
    <a href="#Estados-Cuentas" data-bs-dismiss="offcanvas">
      <i class="bi bi-thunderbolt"></i> Cuentas
    </a>
  </li>
<?php endif; ?>
