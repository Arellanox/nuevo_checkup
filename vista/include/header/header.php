<?php $menu = $_POST['menu']; ?>
<nav class="navbar navbar-expand-sm border-3 border-bottom border-dark bg-navbar">
    <div class="container-fluid">
        <a href="https://bimo-lab.com/index.php" class="navbar-brand"> <img src="https://bimo-lab.com/archivos/sistema/bimo_banner.png"  id="logo_empresa" style="width=120%"> </a>
        <button class="navbar-toggler btn-navbar" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" id="abrir-cerrar" name="abrir-cerrar" type="checkbox"> <!-- onclick="openNav()" -->
            <i class="bi bi-list"></i>
        </button>
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav" id="navbar-js">
              <?php include "navbar-menu.php"; ?>
            </ul>
            <ul class="nav navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a href="#" data-bs-toggle="dropdown"><i class="bi bi-person-circle" style="zoom:190%"></i></a>
                    <div class="dropdown-menu dropdown-menu-end bg-navbar-drop">
                        <a class="dropdown-a" href="#">Example</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-a">Cerrar Sesión</a>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</nav>
<div class="px-3 py-2 border-bottom mb-3">
  <div class="container d-flex flex-wrap">
    <div class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto">
      <h2 class="text-center">Menú <?php echo $menu; ?></h2> <!-- Dinamico -->
    </div>
    <div class="text-center" id="botones-menu-js">
      <?php include "botones.php" ?>
    </div>
  </div>
</div>
