<nav class="navbar navbar-expand-sm border-3 border-bottom border-dark bg-navbar">
    <div class="container-fluid">
        <a href="https://bimo-lab.com/index.php" class="navbar-brand"> <img src="https://bimo-lab.com/archivos/sistema/bimo_banner.png"  id="logo_empresa" style="width=120%"> </a>
        <button class="navbar-toggler btn-navbar" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" id="abrir-cerrar" name="abrir-cerrar" type="checkbox"> <!-- onclick="openNav()" -->
            <i class="bi bi-list"></i>
        </button>
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                  <a href="" data-bs-toggle="modal" data-bs-target="#">
                    Plantilla
                  </a>
                </li>
                <li class="nav-item">
                  <a href="" data-bs-toggle="modal" data-bs-target="#">
                    Example
                  </a>
                </li>
                <li class="nav-item">
                  <div class="dropdown">
                    <a class="dropdown-toggle" href="#" id="dropadmin" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Example
                    </a>
                    <ul class="dropdown-menu bg-navbar-drop" aria-labelledby="dropadmin">
                      <li><a class="dropdown-a" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#">Example</a></li>
                      <li><a class="dropdown-a" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#">Example</a></li>
                    </ul>
                  </div>
                </li>
            </ul>
            <ul class="nav navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a href="#" data-bs-toggle="dropdown"><i class="bi bi-person-circle" style="zoom:190%"></i></a>
                    <div class="dropdown-menu dropdown-menu-end bg-navbar-drop">
                        <a class="dropdown-a" href="#">Example</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-a" href="#">Example</a>
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
      <h2 class="text-center">Menú Plantilla</h2> <!-- Dinamico -->
    </div>
    <div class="text-center" >
      <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px"
        data-bs-toggle="modal" data-bs-target="#modalExample" >
        <i class="bi bi-file-earmark-spreadsheet"></i> Example
      </button>
      <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px"
        data-bs-toggle="modal" data-bs-target="#">
        <i class="bi bi-person-lines-fill"></i> Example
      </button>
    </div>
  </div>
</div>
<?php include "modal.html"; ?>
