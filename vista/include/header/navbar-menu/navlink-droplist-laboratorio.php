  <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/muestras/'; ?>">
      <i class="bi bi-droplet-half"></i> Toma de muestras
  </a>
  <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/laboratorio/'; ?>">
      <i class="bi bi-heart-pulse"></i> Laboratorio Clínico
  </a>
  <?php if ($_SESSION['vista']['CORREOSLAB'] == 1) : ?>
      <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/correos/#CORREOSLAB'; ?>" data-bs-dismiss="offcanvas">
          <i class="bi bi-envelope-paper"></i> Validación Laboratorio Clínico
      </a>
  <?php endif; ?>