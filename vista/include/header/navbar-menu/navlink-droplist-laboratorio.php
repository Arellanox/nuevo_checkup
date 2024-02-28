<?php if ($_SESSION['vista']['LABORATORIO_MUESTRA_1'] == 1 && $menu != 'muestras') : ?>
    <li class="nav-item">
        <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/muestras/#LABORATORIO_MUESTRA_1'; ?>">
            <i class="bi bi-droplet-half"></i> Toma de muestras
        </a>
    </li>
<?php endif; ?>

<!-- Laboratorio clinico -->
<?php if ($_SESSION['vista']['LABORATORIO'] == 1) : ?>
    <a class="dropdown-a align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-laboratorioClinico" aria-expanded="false">
        <i class="bi bi-heart-pulse"></i> Laboratorio Clínico
    </a>
    <div class="collapse" id="board-laboratorioClinico">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small shadow">
            <?php if ($_SESSION['vista']['LABORATORIO'] == 1) : ?>
                <li>
                    <a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/laboratorio/#LABORATORIO'; ?>">
                        <!-- <i class="bi bi-heart-pulse"></i> -->
                        <i class="bi bi-dot"></i>
                        Resultados
                    </a>
                </li>

            <?php endif; ?>
            <?php if ($_SESSION['vista']['REGISTRO_TEMPERATURA'] == 1) : ?>
                <li>
                    <a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/temperatura/#LABORATORIO'; ?>">
                        <!-- <i class="bi bi-virus"></i> -->
                        <i class="bi bi-dot"></i>
                        Temperatura
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- <li class="nav-item">
        <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/laboratorio/#LABORATORIO'; ?>">
            <i class="bi bi-heart-pulse"></i> Laboratorio Clínico
        </a>
    </li> -->
<?php endif; ?>


<?php if ($_SESSION['vista']['ESTUDIOS_LABORATORIO'] == 1 && $menu != 'ServiciosLab') : ?>
    <li class="nav-item">
        <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/laboratorio-estudios/#EstudiosLab'; ?>">
            <i class="bi bi-box2-heart"></i> Estudios
        </a>
    </li>
<?php endif; ?>


<!-- Laboratorio Biomolecular -->
<?php if ($_SESSION['vista']['LABORATORIO_MOLECULAR'] == 1) : ?>
    <a class="dropdown-a align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-laboratorioBiomolecular" aria-expanded="false">
        <i class="bi bi-virus"></i> Laboratorio Biomolecular
    </a>
    <div class="collapse" id="board-laboratorioBiomolecular">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small shadow">
            <?php if ($_SESSION['vista']['LABORATORIO_MOLECULAR'] == 1) : ?>
                <li>
                    <a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/laboratorio/#LABORATORIO_MOLECULAR'; ?>">
                        <!-- <i class="bi bi-heart-pulse"></i> -->
                        <i class="bi bi-dot"></i>
                        Resultados
                    </a>
                </li>

            <?php endif; ?>
            <?php if ($_SESSION['vista']['REGISTRO_TEMPERATURA'] == 1) : ?>
                <li>
                    <a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/temperatura/#BIOMOLECULAR'; ?>">
                        <!-- <i class="bi bi-virus"></i> -->
                        <i class="bi bi-dot"></i>
                        Temperatura
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- <li class="nav-item">
        <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/laboratorio/#LABORATORIO_MOLECULAR'; ?>">
            <i class="bi bi-virus"></i> Laboratorio Biomolecular
        </a>
    </li> -->
    <li class="nav-item">
        <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/area-master/#CITALOGIA'; ?>">
            <i class="bi bi-gender-female"></i> Citología
        </a>
    </li>
<?php endif; ?>

<?php


if ($_SESSION['vista']['CORREOSLAB'] == 1 || $_SESSION['vista']['CORREOSLABBIOMOLECULAR'] == 1) : ?>
    <a class="dropdown-a align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-validacionCorreoLab" aria-expanded="false">
        <i class="bi bi-envelope-paper"></i> Validación de Reportes
    </a>
    <div class="collapse" id="board-validacionCorreoLab">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small shadow">
            <?php if ($_SESSION['vista']['CORREOSLAB'] == 1) : ?>
                <li>
                    <a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/correos/#CORREOSLAB'; ?>">
                        <!-- <i class="bi bi-heart-pulse"></i> -->
                        <i class="bi bi-dot"></i>
                        Laboratorio Clínico
                    </a>
                </li>

            <?php endif; ?>
            <?php if ($_SESSION['vista']['CORREOSLABBIOMOLECULAR'] == 1) : ?>
                <li>
                    <a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/correos/#CORREOSLABBIOMOLECULAR'; ?>">
                        <!-- <i class="bi bi-virus"></i> -->
                        <i class="bi bi-dot"></i>
                        Laboratorio Biomolecular
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
<?php endif; ?>


<?php if ($_SESSION['vista']['RECEPCION_MUESTRAS'] == 1) : ?>
    <li class="nav-item">
        <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/recepcion-muestras/#RECEPCIONMUESTRAS'; ?>">
            <i class="bi bi-journal-medical"></i> Recepción de muestras
        </a>
    </li>
<?php endif; ?>



<?php if ($_SESSION['vista']['REGISTRO_TEMPERATURA'] == 1) : ?>
    <!-- <li class="nav-item">
    <a class="dropdown-a align-items-center" target="_blank" type="button"
        href="<?php //echo "$https$url/$appname/vista/menu/temperatura"; 
                ?>">
        <i class="bi bi-thermometer-high"></i> Temperatura
    </a>
</li> -->
<?php endif; ?>