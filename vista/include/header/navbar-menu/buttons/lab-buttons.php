<?php if ($_SESSION['vista']['LABORATORIO_MUESTRA_1'] == 1 && $menu != 'muestras') : ?>
    <li class="nav-item">
        <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/muestras/#LABORATORIO_MUESTRA_1'; ?>">
            <i class="bi bi-droplet-half"></i> Toma de muestras
        </a>
    </li>
<?php endif; ?>
<?php if ($_SESSION['vista']['LABORATORIO'] == 1 && $menu != 'Laboratorio') : ?>
    <li class="nav-item">
        <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/laboratorio/#LABORATORIO'; ?>">
            <i class="bi bi-heart-pulse"></i> Laboratorio Clínico
        </a>
    </li>
<?php endif; ?>
<?php if ($_SESSION['vista']['ESTUDIOS_LABORATORIO'] == 1 && $menu != 'ServiciosLab') : ?>
    <li class="nav-item">
        <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/laboratorio-estudios/#EstudiosLab'; ?>">
            <i class="bi bi-box2-heart"></i> Estudios
        </a>
    </li>
<?php endif; ?>


<!-- Bio -->
<?php if ($_SESSION['vista']['LABORATORIO_MOLECULAR'] == 1) : ?>
    <li class="nav-item">
        <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/laboratorio/#LABORATORIO_MOLECULAR'; ?>">
            <i class="bi bi-virus"></i> Laboratorio Biomolecular
        </a>
    </li>
    <li class="nav-item">
        <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-master/#CITALOGIA'; ?>">
            <i class="bi bi-gender-female"></i> Citología
        </a>
    </li>
<?php endif; ?>