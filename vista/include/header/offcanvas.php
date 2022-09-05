<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">
  <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-navbar" style="width: 100%;height:100%">
    <div class="offcanvas-header">
      <div class="d-flex align-items-center mb-md-0 me-md-auto text-white text-decoration-none">
        <img src="https://www.bimo-lab.com/archivos/sistema/LogoConFondoAppAndroid.png" style="height: 36px;margin-right: 20px;"/>
        <span class="fs-4">Bimo-lab</span>
      </div>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <hr>
    <span class="fs-4 text-center">Bienvenido | @Nombre</span>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto dropdown-lu">
      <?php // navlink-normales
        include "navbar-menu/navlink-normales.php"; ?><hr><?php
        // navlink-list
        include "navbar-menu/navlink-droplist.php"; ?>
    </ul>
    <hr>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-person-circle" style="zoom:110%; margin-right:30px;"></i>
        <strong>Perfil</strong>
      </a>
      <ul class="dropdown-menu text-small shadow bg-navbar-drop" aria-labelledby="dropdownUser1">
        <?php include "navbar-menu/navlink-dropuser.php"; ?>
      </ul>
    </div>
  </div>
</div>
