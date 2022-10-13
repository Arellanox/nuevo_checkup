<?php if ($menu != null) : ?>
  <a class="dropdown-a align-items-center rounded collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-consultorio" aria-expanded="false">
    <i class="bi bi-clipboard2-pulse"></i> Consultorio
  </a>
  <div class="collapse" id="board-consultorio">
    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small shadow">
      <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/consultorio/'; ?>"><i class="bi bi-dot"></i> Consultorio</a></li>
      <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/mesometria/'; ?>"><i class="bi bi-dot"></i> Mesometria</a></li>
    </ul>
  </div>

  <a class="dropdown-a align-items-center rounded collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-servicios" aria-expanded="false">
    <i class="bi bi-clipboard-heart"></i> Servicios
  </a>
  <div class="collapse" id="board-servicios">
    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small shadow">
      <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/servicios/#Estudios'; ?>"><i class="bi bi-dot"></i> Estudios</a></li>
      <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/servicios/#Grupos'; ?>"><i class="bi bi-dot"></i> Grupos de examenes</a></li>
      <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/servicios/#Equipos'; ?>"><i class="bi bi-dot"></i> Equipos</a></li>
    </ul>
  </div>


  <a class="dropdown-a align-items-center rounded collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-listaprecios" aria-expanded="false">
    <i class="bi bi-tag"></i> Lista de precios
  </a>
  <div class="collapse" id="board-listaprecios">
    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small shadow">
      <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/lista-precio/#PaquetesClientes'; ?>"><i class="bi bi-dot"></i> Paquetes</a></li>
      <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/lista-precio/#PreciosEstudios'; ?>"><i class="bi bi-dot"></i> Precios de estudio</a></li>
    </ul>
  </div>


  <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/clientes/'; ?>">
    <i class="bi bi-briefcase"></i> Clientes</a>
  </a>
<?php endif; ?>
