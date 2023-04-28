<!-- Imagenologia -->
<?php if ($_SESSION['vista']['ULTRASONIDO'] == 1) : ?>
    <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-master/#ULTRASONIDO'; ?>">
        <i class="bi bi-person-video"></i> Ultrasonido
    </a>
<?php endif; ?>
<?php if ($_SESSION['vista']['ULTRASONIDOTOMA'] == 1) : ?>
    <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-master/#ULTRASONIDOTOMA'; ?>">
        <i class="bi bi-person-bounding-box"></i> Capturas de Ultrasonido
    </a>
<?php endif; ?>
<?php if ($_SESSION['vista']['RX'] == 1) : ?>
    <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-master/#RX'; ?>">
        <i class="bi bi-universal-access"></i> Rayos X
    </a>
<?php endif; ?>
<?php if ($_SESSION['vista']['RXTOMA'] == 1) : ?>
    <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-master/#RXTOMA'; ?>">
        <i class="bi bi-universal-access-circle"></i> Capturas de Rayos X
    </a>
<?php endif; ?>


<?php if ($_SESSION['vista']['ESTUDIOS_RAYOSX'] == 1) : ?>
    <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-servicios/#ESTUDIOS_RAYOSX'; ?>">
        <i class="bi bi-box2-heart"></i> Estudios de Rayos X
    </a>
<?php endif; ?>
<?php if ($_SESSION['vista']['ESTUDIOS_ULTRASONIDO'] == 1) : ?>
    <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-servicios/#ESTUDIOS_ULTRASONIDO'; ?>">
        <i class="bi bi-box2-heart"></i> Estudios de Ultrasonido
    </a>
<?php endif; ?>