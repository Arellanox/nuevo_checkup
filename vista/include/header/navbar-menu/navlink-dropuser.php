<?php if ($_SESSION['perfil'] == 1): ?>
  <a class="dropdown-a align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#board-admin" aria-expanded="false">
    <i class="bi bi-person-check"></i> Adminitración
  </a>
  <div class="collapse" id="board-admin">
    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
      <li><a href="<?php echo $https.$url.'/nuevo_checkup/vista/menu/administracion/#Usuarios'; ?>" class="dropdown-a"><i class="bi bi-dot"></i> Usuario</a></li>
      <li><a href="<?php echo $https.$url.'/nuevo_checkup/vista/menu/administracion/#Segmentos'; ?>" class="dropdown-a"><i class="bi bi-dot"></i> Segmentos</a></li>
    </ul>
  </div>
  <li><hr class="dropdown-divider"></li>
<?php endif; ?>
<a href="#LogOut" class="dropdown-a"><i class="bi bi-box-arrow-up"></i> Cerrar Sesión</a>
