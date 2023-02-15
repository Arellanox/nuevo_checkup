<?php
date_default_timezone_set('America/Mexico_City');
if ($_SESSION['vista']['CONSULTORIO'] == 1) : ?>
  <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/consultorio/'; ?>">
    <i class="bi bi-clipboard2-pulse"></i> Historia Clínica
  </a>
<?php endif; ?>
<?php if ($_SESSION['vista']['SOMATOMETRIA'] == 1) : ?>
  <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/somatometria/'; ?>">
    <i class="bi bi-heart-pulse"></i> Somatometría | Signos vitales
  </a>
<?php endif; ?>
<!-- <a class="dropdown-a align-items-center rounded collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-consultorio" aria-expanded="false">
    <i class="bi bi-clipboard2-pulse"></i> Consultorio
  </a>
  <div class="collapse" id="board-consultorio">
    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small shadow">
      <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/consultorio/'; ?>"><i class="bi bi-dot"></i> Consultorio</a></li>
      <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/somatometria/'; ?>"><i class="bi bi-dot"></i> Somatometría</a></li>
    </ul>
  </div> -->


<?php if ($_SESSION['vista']['LABORATORIO'] == 1) : ?>
  <!-- Laboratorio -->
  <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/laboratorio/'; ?>">
    <i class="bi bi-heart-pulse"></i> Laboratorio
  </a>
  <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/muestras/'; ?>">
    <i class="bi bi-droplet-half"></i> Toma de muestras
  </a>
<?php endif; ?>


<!-- Areas master -->
<?php if ($_SESSION['vista']['ULTRASONIDO'] == 1) : ?>
  <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/area-master/#ULTRASONIDO'; ?>">
    <i class="bi bi-person-video"></i> Ultrasonido
  </a>
<?php endif; ?>
<?php if ($_SESSION['vista']['ULTRASONIDOTOMA'] == 1) : ?>
  <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/area-master/#ULTRASONIDOTOMA'; ?>">
    <i class="bi bi-person-video"></i> Ultrasonido (Imagenes)
  </a>
<?php endif; ?>
<?php if ($_SESSION['vista']['RX'] == 1) : ?>
  <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/area-master/#RX'; ?>">
    <i class="bi bi-universal-access"></i> Rayos X
  </a>
<?php endif; ?>
<?php if ($_SESSION['vista']['RXTOMA'] == 1) : ?>
  <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/area-master/#RXTOMA'; ?>">
    <i class="bi bi-universal-access"></i> Rayos X (Imagenes)
  </a>
<?php endif; ?>
<?php if ($_SESSION['vista']['ELECTROCARDIOGRAMA'] == 1) : ?>
  <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/area-master/#ELECTROCARDIOGRAMA'; ?>">
    <i class="bi bi-activity"></i> Electrocardiograma
  </a>
<?php endif; ?>
<?php if ($_SESSION['vista']['ESPIROMETRIA'] == 1) : ?>
  <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/area-master/#ESPIROMETRIA'; ?>">
    <i class="bi bi-lungs"></i> Espirometría
  </a>
<?php endif; ?>
<?php if ($_SESSION['vista']['AUDIOMETRIA'] == 1) : ?>
  <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/area-master/#AUDIOMETRIA'; ?>">
    <i class="bi bi-ear"></i> Audiometría
  </a>
<?php endif; ?>
<?php if ($_SESSION['vista']['OFTALMOLOGIA'] == 1) : ?>
  <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/area-master/#OFTALMOLOGIA'; ?>">
    <i class="bi bi-eye"></i> Oftalmología
  </a>
<?php endif; ?>