<?php if ($_SESSION['vista']['LABORATORIO_MUESTRA'] == 1) : ?>
    <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/muestras/'; ?>">
        <i class="bi bi-droplet-half"></i> Toma de muestras
    </a>
<?php endif; ?>
<?php if ($_SESSION['vista']['LABORATORIO'] == 1) : ?>
    <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/laboratorio/#LABORATORIO'; ?>">
        <i class="bi bi-heart-pulse"></i> Laboratorio Clínico
    </a>
<?php endif; ?>
<!-- Bio -->
<?php if ($_SESSION['vista']['LABORATORIO_MOLECULAR'] == 1) : ?>
    <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/laboratorio/#LABORATORIO_MOLECULAR'; ?>">
        <i class="bi bi-virus"></i> Laboratorio Biomolecular
    </a>
<?php endif; ?>


<?php if ($_SESSION['vista']['CORREOSLAB'] == 1) : ?>
    <a class="dropdown-a align-items-center rounded collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-validacionCorreoLab" aria-expanded="false">
        <i class="bi bi-envelope-paper"></i> Validación de Reportes
    </a>
    <div class="collapse" id="board-validacionCorreoLab">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small shadow">
            <li>
                <a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/correos/#CORREOSLAB'; ?>">
                    <!-- <i class="bi bi-heart-pulse"></i> -->
                    <i class="bi bi-dot"></i>
                    Laboratorio Clínico
                </a>
            </li>
            <li>
                <a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/laboratorio-biomolecular/'; ?>">
                    <!-- <i class="bi bi-virus"></i> -->
                    <i class="bi bi-dot"></i>
                    Laboratorio Biomolecular
                </a>
            </li>
        </ul>
    </div>
<?php endif; ?>

<?php if ($_SESSION['vista']['LABORATORIO_ESTUDIOS'] == 1) : ?>
    <a class="dropdown-a align-items-center rounded" type="button" href="<?php echo $https . $url . '/nuevo_checkup/vista/menu/laboratorio-estudios/#EstudiosLab'; ?>" data-bs-dismiss="offcanvas">
        <i class="bi bi-envelope-paper"></i> Estudios
    </a>
<?php endif; ?>