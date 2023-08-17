<?php

include 'buttons/lab-buttons.php';

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

<?php if ($_SESSION['vista']['REGISTRO_TEMPERATURA'] == 1) : ?>
    <li class="nav-item">
        <a class="dropdown-a align-items-center" target="_blank" type="button" href="<?php echo "$https$url/$appname/vista/menu/temperatura"; ?>">
            <i class="bi bi-thermometer-high"></i> Temperatura
        </a>
    </li>
<?php endif; ?>