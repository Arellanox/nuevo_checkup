<?php
if (
    $_SESSION['id_cliente'] == 15
) : ?>
    <li class="nav-item">
        <a href="<?php echo "$https$url/$appname/vista/menu/principal";
                    /*echo $https . $url . '/' . /$appname . '/vista/menu/principal/';*/ ?>">
            <i class="bi bi-window"></i> Ir a bimo checkups
        </a>
    </li>
<?php endif; ?>


<li class="nav-item">
    <a href="" data-bs-toggle="offcanvas" data-bs-target="#offCanvaMenuPrincipal" aria-controls="offCanvaMenuPrincipal">
        <i class="bi bi-layout-sidebar-inset"></i> Menú
    </a>
</li>