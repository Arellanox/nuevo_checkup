<?php
date_default_timezone_set('America/Mexico_City');
if ($_SESSION['vista']['SERVICIOS'] == 1  || $_SESSION['vista']['SERVICIOS (EQUIPOS)'] == 1 || $_SESSION['vista']['SERVICIOS (GRUPOS)'] == 1 || $_SESSION['vista']['SERVICIOS (SERVICIOS)'] == 1) : ?>
  <!-- Administrativos -->
  <a class="dropdown-a align-items-center rounded collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-servicios" aria-expanded="false">
    <i class="bi bi-clipboard-heart"></i> Servicios
  </a>
  <div class="collapse" id="board-servicios">
    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small shadow">
      <?php if ($_SESSION['vista']['SERVICIOS (SERVICIOS)'] == 1 || $_SESSION['vista']['SERVICIOS'] == 1) : ?>
        <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/servicios/#Estudios'; ?>"><i class="bi bi-dot"></i> Estudios</a></li>
      <?php endif; ?>
      <?php if ($_SESSION['vista']['SERVICIOS (GRUPOS)'] == 1 || $_SESSION['vista']['SERVICIOS'] == 1) : ?>
        <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/servicios/#Grupos'; ?>"><i class="bi bi-dot"></i> Grupos de examenes</a></li>
      <?php endif; ?>
      <?php if ($_SESSION['vista']['SERVICIOS (EQUIPOS)'] == 1 || $_SESSION['vista']['SERVICIOS'] == 1) : ?>
        <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/servicios/#Equipos'; ?>"><i class="bi bi-dot"></i> Equipos</a></li>
      <?php endif; ?>
    </ul>
  </div>
  <li>
    <hr class="dropdown-divider">
  </li>
<?php endif; ?>


<?php if (true) : ?>
  <!-- Administrativos -->
  <!-- <a class="dropdown-a align-items-center rounded collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-laboratorio-servicios" aria-expanded="false">
    <i class="bi bi-clipboard-heart"></i> Estudios laboratorio
  </a>
  <div class="collapse" id="board-laboratorio-servicios">
    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small shadow">
        <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/laboratorio-servicios/#Estudios'; ?>"><i class="bi bi-dot"></i> Estudios</a></li>
        <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/laboratorio-servicios/#Grupos'; ?>"><i class="bi bi-dot"></i> Grupos de examenes</a></li>
    </ul>
  </div>
  <li><hr class="dropdown-divider"></li> -->
<?php endif; ?>


<?php if ($_SESSION['vista']['FACTURACIÓN'] == 1) : ?>
  <!-- Facturacion -->
  <a class="dropdown-a align-items-center rounded collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-facturacion" aria-expanded="false">
    <i class="bi bi-calculator"></i> Facturación
  </a>
  <div class="collapse" id="board-facturacion">
    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small shadow">
      <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/facturacion/#Estados-Cuentas'; ?>"><i class="bi bi-dot"></i> Estados de cuentas</a></li>
      <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/facturacion/#Cuentas-usuarios'; ?>"><i class="bi bi-dot"></i> Cuentas usuarios</a></li>
    </ul>
  </div>
  <li>
    <hr class="dropdown-divider">
  </li>
<?php endif; ?>
<?php if ($_SESSION['vista']['LISTA DE PRECIOS'] == 1) : ?>
  <!-- Contaduria -->
  <a class="dropdown-a align-items-center rounded collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-listaprecios" aria-expanded="false">
    <i class="bi bi-tag"></i> Lista de precios
  </a>
  <div class="collapse" id="board-listaprecios">
    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small shadow">
      <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/lista-precio/#PaquetesClientes'; ?>"><i class="bi bi-dot"></i> Paquetes</a></li>
      <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/lista-precio/#PreciosEstudios'; ?>"><i class="bi bi-dot"></i> Estudios</a></li>
    </ul>
  </div>
  <li>
    <hr class="dropdown-divider">
  </li>
<?php endif; ?>
<?php if ($_SESSION['vista']['ADMINISTRACIÓN'] == 1 || $_SESSION['vista']['CLIENTES'] == 1) : ?>
  <a class="dropdown-a align-items-center rounded collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-admin" aria-expanded="false">
    <i class="bi bi-person-check"></i> Administración
  </a>
  <div class="collapse" id="board-admin">
    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
      <?php if ($_SESSION['vista']['CLIENTES'] == 1) : ?>
        <li>
          <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/clientes/'; ?>">
            <i class="bi bi-dot"></i> Clientes
          </a>
        </li>
      <?php endif; ?>
      <?php if ($_SESSION['vista']['CURSOS BIMO'] == 1) : ?>
        <li>
          <a href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/cursos-bimo/'; ?>" class="dropdown-a" type="button">
            <i class="bi bi-dot"></i> Cursos
          </a>
        </li>
      <?php endif; ?>
      <?php if ($_SESSION['perfil'] == 1) : ?>
        <li>
          <a href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/administracion/#USUARIOS'; ?>" class="dropdown-a" type="button">
            <i class="bi bi-dot"></i> Usuarios
          </a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
  <li>
    <hr class="dropdown-divider">
  </li>
<?php endif; ?>
<a href="#LogOut" class="dropdown-a"><i class="bi bi-box-arrow-up"></i> Cerrar Sesión</a>