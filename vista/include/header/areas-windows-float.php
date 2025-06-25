<?php
if (
    $_SESSION['id_cliente'] == 15 || $_SESSION['franquiciario']
) : ?>
    <li class="nav-item">
        <a href="<?php echo "$https$url/$appname/vista/menu/principal"; ?>">
            <i class="bi bi-window"></i> Menú principal
        </a>
    </li>
<?php endif; ?>

<?php
if (
    $menu != 'Recepción' && $_SESSION['vista']['RECEPCIÓN'] == 1
) : ?>
    <li class="nav-item">
        <a href="<?php echo "$https$url/$appname/vista/menu/recepcion/"; ?>">
            <i class="bi bi-people-fill"></i> Recepción
        </a>
    </li>
<?php endif; ?>

<?php if ($_SESSION['vista']['MENU_MAQUILA'] == 1 && !$_SESSION['franquiciario']) : ?>
    <li class="nav-item">
        <a href="<?php echo "$https$url/$appname/vista/procedencia/pacientes/#UJAT"; ?>">
            <i class=" bi bi-thunderbolt"></i> UJAT
        </a>
    </li>
<?php endif; ?>

<?php if ($_SESSION['vista']['MEDICOS_TRATANTES'] == 1) : ?>
    <li class="nav-item">
        <a href="<?php echo "$https$url/$appname/vista/menu/medicos_tratantes/#PACIENTES"; ?>">
            <i class="bi bi-people"></i> Pacientes de médicos
        </a>
    </li>
<?php endif; ?>

<?php if (
    $_SESSION['vista']['AGENDA_PACIENTES'] == 1
    //Excepciones
    && $menu != 'Facturacion'
    && $menu != 'ListaPrecios'
) : ?>
    <li class="nav-item Recepción">
        <div class="dropdown ">
            <a class="dropdown-toggle align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-menu-agenda-checkups" aria-expanded="false">
                <i class="bi bi-calendar2-event"></i> Agenda Checkups
            </a>

            <div class="collapse" id="board-menu-agenda-checkups">
                <ul style="padding-left: 15px;" class="btn-toggle-nav text-black list-unstyled fw-normal pb-1 small shadow">
                    <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/agenda-estudios/#ULTRASONIDO'; ?>">
                        <i class="bi bi-dot"></i> Ultrasonido
                    </a>
                    <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/agenda-estudios/#BIOMOLECULAR'; ?>">
                        <i class="bi bi-dot"></i> Lab Biomolecular
                    </a>
                    <a class="dropdown-a align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/agenda-estudios/#CHECKUPS'; ?>">
                        <i class="bi bi-dot"></i> Checkups
                    </a>
                </ul>
            </div>
        </div>
    </li>
<?php endif; ?>

<!-- Laboratorio -->
<?php if (
    $_SESSION['vista']['LABORATORIO'] == 1 ||
    $_SESSION['vista']['LABORATORIO_MUESTRA_1'] == 1 ||
    $_SESSION['vista']['CORREOSLAB'] == 1 ||
    $_SESSION['vista']['LABORATORIO_ESTUDIOS'] == 1
) : ?>
    <li class="nav-item Recepción">
        <div class="dropdown ">
            <a class="dropdown-toggle align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-menu-laboratorio" aria-expanded="false">
                <i class="bi bi-heart-pulse"></i> Laboratorio
            </a>

            <div class="collapse" id="board-menu-laboratorio">
                <ul style="padding-left: 15px;" class="btn-toggle-nav text-black list-unstyled fw-normal pb-1 small shadow">
                    <?php include "navbar-menu/navlink-droplist-laboratorio.php";
                    ?>
                </ul>
            </div>
        </div>
    </li>
<?php endif; ?>

<?php if (
    $_SESSION['vista']['ELECTROCARDIOGRAMA'] == 1 || $_SESSION['vista']['ELECTROCARDIOGRAMA_CAPTURAS'] == 1 ||
    $_SESSION['vista']['ESPIROMETRIA'] == 1 ||
    $_SESSION['vista']['AUDIOMETRIA'] == 1 ||
    $_SESSION['vista']['OFTALMOLOGIA'] == 1 ||
    $_SESSION['vista']['SOMATOMETRIA'] == 1 ||
    $_SESSION['vista']['CONSULTORIO'] == 1 ||
    $_SESSION['vista']['ULTRASONIDO'] == 1 || $_SESSION['vista']['ULTRASONIDOTOMA'] == 1 ||
    $_SESSION['vista']['RX'] == 1 || $_SESSION['vista']['RXTOMA'] == 1 ||
    $_SESSION['vista']['NUTRICION'] == 1 || $_SESSION['vista']['NUTRICION_CAPTURAS'] == 1 ||
    $_SESSION['vista']['ESTUDIOS_ULTRASONIDO'] == 1 || $_SESSION['vista']['ESTUDIOS_RAYOSX'] == 1 || $_SESSION['vista']['ESTUDIOS_AREAS'] == 1 ||
    $_SESSION['vista']['CONTROL_TURNOS_PANTALLA'] == 1 || $_SESSION['vista']['CONTROL_TURNOS'] == 1
) : ?>
    <li class="nav-item Recepción">
        <div class="dropdown ">
            <a class="dropdown-toggle align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-menu-checkups" aria-expanded="false">
                <i class="bi bi-window-stack"></i> Checkups
            </a>

            <div class="collapse" id="board-menu-checkups">
                <ul style="padding-left: 15px;" class="btn-toggle-nav text-black list-unstyled fw-normal pb-1 small shadow">
                    <?php include "navbar-menu/navlink-droplist-areas.php"; ?>
                </ul>
            </div>
        </div>
    </li>
<?php endif; ?>


<?php if (
    $_SESSION['vista']['CLIENTES'] == 1 ||
    $_SESSION['vista']['SERVICIOS (EQUIPOS)'] == 1 ||
    $_SESSION['vista']['FACTURACIÓN'] == 1 ||
    $_SESSION['vista']['LISTA_PRECIOS'] == 1 || $_SESSION['vista']['PAQUETES_ESTUDIOS'] == 1 || $_SESSION['vista']['COTIZACIONES_ESTUDIOS'] == 1 ||
    $_SESSION['vista']['CURSOS BIMO'] == 1 ||
    $_SESSION['vista']['REGISTRO_TEMPERATURA'] == 1 ||
    $_SESSION['vista']['MEDICOS_TRATANTES'] == 1 ||
    $_SESSION['vista']['CAJA'] == 1 ||
    $_SESSION['vista']['CAJA_CHICA'] == 1 ||
    $_SESSION['vista']['RECURSOS_HUMANOS'] == 1
) : ?>
    <li class="nav-item Recepción">
        <div class="dropdown ">
            <!-- <a class="dropdown-toggle" id="dropadmin" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 <i class="bi bi-briefcase"></i> Administración
             </a> -->

            <a class="dropdown-toggle align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-menu-administracion" aria-expanded="false">
                <i class="bi bi-briefcase"></i> Administración
            </a>

            <div class="collapse" id="board-menu-administracion">
                <ul style="padding-left: 15px;" class="btn-toggle-nav text-black list-unstyled fw-normal pb-1 small shadow">
                    <?php include "navbar-menu/navlink-droplist-admin.php"; ?>
                </ul>
            </div>


            <!-- Estos botones se cargan en el servidor desde el archivo del include -->
            <ul style="padding-left: 15px;" class="dropdown-menu bg-navbar-drop drop-areas" aria-labelledby="dropadmin">
                <?php include "navbar-menu/navlink-droplist-admin.php";
                ?>
            </ul>
        </div>
    </li>
<?php endif; ?>


<?php if ($_SESSION['vista']['ESTUDIOS_CALIDAD_EXCEL'] == 1) : ?>
    <li class="nav-item Recepción">
        <div class="dropdown ">
            <!-- <a class="dropdown-toggle" id="dropTI" role="button" data-bs-toggle="dropdown" aria-expanded="false">

             </a> -->

            <a class="dropdown-toggle align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-menu-calidad" aria-expanded="false">
                <i class="bi bi-suit-heart"></i> Calidad
            </a>

            <!-- Estos botones se cargan en el servidor desde el archivo del include -->
            <!-- <ul style="padding-left: 15px;" class="dropdown-menu bg-navbar-drop drop-areas" aria-labelledby="dropTI"> -->
            <div class="collapse" id="board-menu-calidad">
                <ul style="padding-left: 15px;" class="btn-toggle-nav text-black list-unstyled fw-normal pb-1 small shadow">

                    <?php if ($_SESSION['vista']['ESTUDIOS_CALIDAD_EXCEL'] == 1) : ?>
                        <a class="dropdown-a text-white align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/documentacion/reporte-epidemiologico/'; ?>">
                            <i class="bi bi-journal-text"></i> Reporte epidemiológico
                        </a>

                    <?php endif; ?>
                </ul>
            </div>
            <!-- </ul> -->
        </div>
    </li>
<?php endif; ?>

<?php if ($_SESSION['vista']['FRANQUICIAS'] == 1) :?>
    <li class="nav-item Recepción">
        <div class="dropdown ">

            <a class="dropdown-toggle align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-menu-empresas" aria-expanded="false">
                <i class="bi bi-hospital"></i> Tomas Externas
            </a>

            <div class="collapse" id="board-menu-empresas">
                <ul style="padding-left: 15px;" class="btn-toggle-nav text-black list-unstyled fw-normal pb-1 small shadow">
                    <?php if ($_SESSION['vista']['FRANQUICIAS'] == 1 && !$_SESSION['franquiciario']) :?>
                        <a class="dropdown-a text-white align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/procedencia/estudios-laboratorio/'; ?>">
                            <i class="bi bi-people"></i> Solicitud de Laboratorio <?= $_SESSION['franquiciario'] ?>
                        </a>
                    <?php endif; ?>

                    <a class="dropdown-a text-white align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/procedencia/solicitud-franquicia-laboratorio/'; ?>">
                        <i class="bi bi-journal-medical"></i> Solicitud de Franquicia
                    </a>
                </ul>
            </div>
        </div>
    </li>
<?php endif;
?>

<?php if ($_SESSION['perfil'] == 1) : ?>
    <li class="nav-item Recepción">
        <div class="dropdown ">
            <a class="dropdown-toggle align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-menu-ti" aria-expanded="false">
                <i class="bi bi-motherboard"></i> TI
            </a>

            <!-- Estos botones se cargan en el servidor desde el archivo del include -->
            <!-- <ul style="padding-left: 15px;" class="dropdown-menu bg-navbar-drop drop-areas" aria-labelledby="dropTI"> -->
            <div class="collapse" id="board-menu-ti">
                <ul style="padding-left: 15px;" class="btn-toggle-nav text-black list-unstyled fw-normal pb-1 small shadow">
                    <a class="dropdown-a text-white align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/administracion/#USUARIOS'; ?>">
                        <i class="bi bi-person-fill-gear"></i> Usuarios
                    </a>
                    <a class="dropdown-a text-white align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/menu/soporte_ti/#SoporteTI'; ?>">
                        <i class="bi bi-wrench-adjustable-circle"></i> Soporte TI
                    </a>
                </ul>
            </div>
            <!-- </ul> -->
        </div>
    </li>
<?php endif; ?>