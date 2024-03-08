<!-- No suar -->
<?php if ($_SESSION['vista']['MENU_MAQUILA'] == 1) : ?>
    <li class="nav-item">
        <a href="<?php echo "$https$url/$appname/vista/empresas/administracion"; ?>">
            <i class="bi bi-buildings"></i> Menú Principal
        </a>
    </li>
<?php endif; ?>

<?php if ($_SESSION['vista']['FRANQUICIAS'] == 1) :
?>
    <li class="nav-item Recepción">
        <div class="dropdown ">

            <a class="dropdown-toggle align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-menu-empresas" aria-expanded="false">
                <i class="bi bi-hospital"></i> Tomas Externas
            </a>

            <div class="collapse" id="board-menu-empresas">
                <ul style="padding-left: 15px;" class="btn-toggle-nav text-black list-unstyled fw-normal pb-1 small shadow">

                    <?php if ($_SESSION['vista']['FRANQUICIAS'] == 1) :
                    ?>
                        <a class="dropdown-a text-white align-items-center" type="button" href="<?php echo $https . $url . '/' . $appname . '/vista/procedencia/estudios-laboratorio/'; ?>">
                            <i class="bi bi-people"></i> Solicitud de Laboratorio
                        </a>

                    <?php endif;
                    ?>
                </ul>
            </div>
        </div>
    </li>
<?php endif;
?>