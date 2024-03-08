<div class="offcanvas offcanvas-start" tabindex="-1" id="offCanvaMenuPrincipal" aria-labelledby="offcanvasWithBackdropLabel">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-navbar" style="width: 100%;height:100%">
        <div class="offcanvas-header">
            <div class="d-flex align-items-center mb-md-0 me-md-auto text-white text-decoration-none">
                <img src="https://www.bimo-lab.com/archivos/sistema/LogoConFondoAppAndroid.png" style="height: 36px;margin-right: 20px;" />
                <span class="fs-4">¡Hola!</span>
            </div>
            <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <!-- <hr>
        <span class="fs-4 text-center" id="bienvenida-user">Bienvenido | <?php echo $_SESSION['nombre'] ?></span>
        <hr> -->

        <hr>

        <ul class="nav nav-pills mb-auto dropdown-lu overflow-auto" id="body-offcanva">

            <?php
            // navlink-list
            #include "navbar-menu/navlink-droplist-areas.php";
            if ($area_nav == 'interno') {
                include "areas-windows-float.php";
                // Areas externas
                include "areas-windows-float_externo.php";
            } else {
                include "areas-windows-float_externo.php";
            }
            ?>



        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 2px">

                <div class="container-avatar" style="zoom: 130%">
                    <img src="<?php echo $_SESSION['AVATAR']; ?>" alt="Avatar" class="image-avatar">
                </div>
                <p class="none-p text-white" style="margin-left: 10px"></p><?php echo $_SESSION['user'] ?></p>

            </a>
            <ul class="dropdown-menu text-small shadow bg-navbar-drop" aria-labelledby="dropdownUser1" style="padding: 1px;">
                <?php include "navbar-menu/navlink-dropuser.php"; ?>
            </ul>
        </div>
    </div>
</div>