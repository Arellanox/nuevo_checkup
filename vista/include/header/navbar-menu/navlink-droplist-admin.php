<?php
date_default_timezone_set('America/Mexico_City');
?>
<?php if ($_SESSION['vista']['CAJA'] == 1) : ?>
    <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/corte_caja/#CORTECAJA'; ?>">
        <i class="bi bi-cash-stack"></i> Corte de caja
    </a>
<?php endif; ?>

<?php if ($_SESSION['vista']['ADMIN_MEDICOS'] == 1 ||  $_SESSION['vista']['TRACKER_MEDICOS'] == 1) : ?>
    <!-- Administrativos -->
    <a class="dropdown-a align-items-center  collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-medicos_tratantes" aria-expanded="false">
        <i class="bi bi-person-lines-fill"></i> Médicos
    </a>
    <div class="collapse" id="board-medicos_tratantes">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <?php if ($_SESSION['vista']['TRACKER_MEDICOS'] == 1) : ?>
                <li>
                    <a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/track-medicos/'; ?>">
                        <i class="bi bi-dot"></i> Tracking de Médicos
                    </a>
                </li>
            <?php endif; ?>

            <?php if ($_SESSION['vista']['VENDEDORES_COMISIONADOS'] == 1) : ?>
                <li>
                    <a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/administracion/#VENDEDORES'; ?>">
                        <i class="bi bi-dot"></i> Vendedores
                    </a>
                </li>
            <?php endif; ?>
            
            <?php if ($_SESSION['vista']['ADMIN_MEDICOS'] == 1) : ?>
                <li>
                    <a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/administracion/#MEDICOS'; ?>">
                        <i class="bi bi-dot"></i> Médicos Tratantes
                    </a>
                </li>
            <?php endif; ?>
            <hr class="dropdown-divider">
        </ul>
    </div>
<?php endif; ?>


<?php if ($_SESSION['vista']['CLIENTES'] == 1) : ?>
    <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/clientes/'; ?>">
        <i class="bi bi-people-fill"></i> Clientes
    </a>
<?php endif; ?>

<?php
if ($_SESSION['vista']['SERVICIOS (EQUIPOS)'] == 1) : ?>
    <!-- Administrativos -->
    <a class="dropdown-a align-items-center  collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-servicios" aria-expanded="false">
        <i class="bi bi-clipboard-heart"></i> Servicios
    </a>
    <div class="collapse" id="board-servicios">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <?php if ($_SESSION['vista']['SERVICIOS (EQUIPOS)'] == 1 || $_SESSION['vista']['SERVICIOS'] == 1) : ?>
                <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/servicios/#Equipos'; ?>"><i class="bi bi-dot"></i> Equipos</a></li>
            <?php endif; ?>
            <li><a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/' . $appname . '/vista/pacientes/servicios-disponibles/'; ?>"><i class="bi bi-dot"></i> Precios (Particulares)</a></li>

            <hr class="dropdown-divider">
        </ul>
    </div>

<?php endif; ?>




<?php if (
    $_SESSION['vista']['FACTURACIÓN'] == 1 ||
    $_SESSION['vista']['FACTURACION_EXCEL'] ==
    1 ||
    $_SESSION['vista']['COTIZACIONES_ESTUDIOS'] == 1
) : ?>
    <!-- Facturacion -->
    <a class="dropdown-a align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-facturacion" aria-expanded="false">
        <i class="bi bi-calculator"></i> Facturación
    </a>
    <div class="collapse" id="board-facturacion">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <?php if ($_SESSION['vista']['FACTURACIÓN'] == 1) : ?>
                <a class="dropdown-a align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-cuentasFacturacion" aria-expanded="false">
                    <i class="bi bi-dot"></i> Cuentas
                </a>
                <div class="collapse" id="board-cuentasFacturacion">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">


                        <li> <a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/facturacion/#CONTADO'; ?>">
                                <i class="bi bi-dot"></i> De Contado
                            </a> </li>

                        <li> <a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/facturacion/#CREDITO'; ?>">
                                <i class="bi bi-dot"></i> De Crédito
                            </a> </li>

                        <hr class="dropdown-divider">
                    </ul>
                </div>
            <?php endif; ?>


            <?php if ($_SESSION['vista']['FACTURACION_EXCEL'] == 1) : ?>
                <a class="dropdown-a align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-ExcelFacturacion" aria-expanded="false">
                    <i class="bi bi-dot"></i> Reportes
                </a>
                <div class="collapse" id="board-ExcelFacturacion">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <?php if ($_SESSION['vista']['FACTURACION_EXCEL'] == 1) : ?>
                            <li>
                                <a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/' . $appname . '/vista/documentacion/reporte-paciente/'; ?>">
                                    <i class="bi bi-dot"></i> Pacientes
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/' . $appname . '/vista/documentacion/reporte-ventas/'; ?>">
                                    <i class="bi bi-dot"></i> Ventas
                                </a>
                            </li>
                        <?php endif; ?>
                        <hr class="dropdown-divider">
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ($_SESSION['vista']['COTIZACIONES_ESTUDIOS'] == 1) : ?>
                <li>
                    <a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/lista-precio/#COTIZACIONES_ESTUDIOS'; ?>">
                        <i class="bi bi-dot"></i> Cotizaciones
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
<?php endif; ?>


<?php if (
    $_SESSION['vista']['LISTA_PRECIOS'] == 1 ||
    $_SESSION['vista']['PAQUETES_ESTUDIOS'] == 1
) : ?>
    <!-- Contaduria -->
    <a class="dropdown-a align-items-center  collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-listaprecios" aria-expanded="false">
        <i class="bi bi-tag"></i> Lista de Estudios
    </a>
    <div class="collapse" id="board-listaprecios">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <?php if ($_SESSION['vista']['LISTA_PRECIOS'] == 1) : ?>
                <li>
                    <a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/lista-precio/#LISTA_PRECIOS'; ?>">
                        <i class="bi bi-dot"></i> Listado de precios
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($_SESSION['vista']['PAQUETES_ESTUDIOS'] == 1) : ?>
                <li>
                    <a class="dropdown-a" type="button" class="btn btn-primary" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/lista-precio/#PAQUETES_ESTUDIOS'; ?>">
                        <i class="bi bi-dot"></i> Paquetes
                    </a>
                </li>
            <?php endif; ?>
            <hr class="dropdown-divider">
        </ul>
    </div>

<?php endif; ?>

<?php if ($_SESSION['vista']['PROMOCIONALES_BIMO'] == 1) : ?>
    <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/promociones_bimo/'; ?>">
        <i class="bi bi-percent"></i> Promociones
    </a>
<?php endif; ?>


<?php if ($_SESSION['vista']['CURSOS BIMO'] == 1) : ?>
    <a class="dropdown-a align-items-center  collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-TALENTOHUMANO" aria-expanded="false">
        <i class="bi bi-people"></i> Talento Humano
    </a>
    <div class="collapse" id="board-TALENTOHUMANO">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <?php if ($_SESSION['vista']['CURSOS BIMO'] == 1) : ?>
                <li>
                    <a href="<?php echo $https . $url . '/' . $appname . '/vista/menu/cursos-bimo/'; ?>" class="dropdown-a" type="button">
                        <i class="bi bi-dot"></i> Cursos
                    </a>
                </li>
            <?php endif; ?>
            <hr class="dropdown-divider">
        </ul>
    </div>

<?php endif; ?>

<?php if($_SESSION['vista']['CAJA_CHICA'] == 1):  ?>
    <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/caja_chica/#CAJACHICA'; ?>">
        <i class="bi bi-piggy-bank"></i> Caja chica
    </a>
<?php endif; ?>

<?php if($_SESSION['vista']['REQUISICION_MAQUILAS'] == 1):  ?>
    <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/maquilas/'; ?>">
        <i class="bi bi-file-earmark-break"></i> Maquilas
    </a>
<?php endif; ?>
