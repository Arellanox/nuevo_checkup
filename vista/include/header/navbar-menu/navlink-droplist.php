<?php if ($menu == "Recepción" || $menu == "Consultorio" || $menu == "Usuarios" || $menu == "Laboratorio"): ?>
  <a class="dropdown-a align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#board-consultorio" aria-expanded="false">
    <i class="bi bi-clipboard2-pulse"></i> Consultorio
  </a>
  <div class="collapse" id="board-consultorio">
    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small shadow">
      <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/consultorio/'; ?>"><i class="bi bi-dot"></i> Consultorio</a></li>
      <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/mesometria/'; ?>"><i class="bi bi-dot"></i> Mesometria</a></li>
    </ul>
  </div>
<?php endif; ?>
