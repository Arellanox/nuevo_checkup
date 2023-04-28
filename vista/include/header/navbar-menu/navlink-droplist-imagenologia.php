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


<?php if ($_SESSION['vista']['ESTUDIOS_ULTRASONIDO'] == 1 || $_SESSION['vista']['ESTUDIOS_RAYOSX'] == 1) : ?>
    <a class="dropdown-a align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-validacionCorreoLab" aria-expanded="false">
        <i class="bi bi-box2-heart"></i> Estudios
    </a>
    <div class="collapse" id="board-validacionCorreoLab">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small shadow">
            <?php if ($_SESSION['vista']['ESTUDIOS_RAYOSX'] == 1) : ?>
                <li>
                    <a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-servicios/#ESTUDIOS_ULTRASONIDO'; ?>">
                        <i class="bi bi-dot"></i> Ultrasonido
                    </a>
                </li>

            <?php endif; ?>
            <?php if ($_SESSION['vista']['ESTUDIOS_ULTRASONIDO'] == 1) : ?>
                <li>
                    <a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-servicios/#ESTUDIOS_RAYOSX'; ?>">
                        <i class="bi bi-dot"></i> Rayos X
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
<?php endif; ?>