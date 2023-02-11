<?php
$menu = $_POST['menu'];
$tip = $_POST['tip'];
session_start();
?>
<?php switch ($menu) {
  case 'Prerregistro':
?>
    <nav class="navbar border-3 border-bottom border-dark bg-navbar">
      <div class="container-fluid d-flex justify-content-center">
        <a href="#" class="navbar-brand" id="img"> <img src="https://bimo-lab.com/archivos/sistema/bimo_banner.png" id="logo_empresa_login" /> </a>
      </div>
    </nav>
    <div class="px-3 py-2 border-bottom mb-3">
      <div class="container d-flex flex-wrap">
        <div class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto">
          <h2 class="text-center"><?php echo $menu; ?></h2> <!-- Dinamico -->
        </div>
        <div class="text-center" id="botones-menu-js">
          <?php
          if ($tip != 'pie') {
            include "botones.php";
          }
          ?>
        </div>
      </div>
    </div>
  <?php
    break;
  case 'Login'
  ?>
  <nav class="navbar border-3 border-bottom border-dark bg-navbar">
    <div class="container-fluid d-flex justify-content-center">
      <a href="#" class="navbar-brand" id="img"> <img src="https://bimo-lab.com/archivos/sistema/bimo_banner.png" id="logo_empresa_login" /> </a>
    </div>
  </nav>
<?php
    break;
  case 'validador':
?>
  <nav class="navbar border-3 border-bottom border-dark bg-navbar">
    <div class="container-fluid d-flex justify-content-center">
      <a href="#" class="navbar-brand" id="img"> <img src="https://bimo-lab.com/archivos/sistema/bimo_banner.png" id="logo_empresa_login" /> </a>
    </div>
  </nav>
<?php
    break;
  default:
?>
  <nav class="navbar navbar-expand-lg border-3 border-bottom border-dark bg-navbar">
    <div class="container-fluid">
      <a href="https://bimo-lab.com/index.php" class="navbar-brand"> <img src="https://bimo-lab.com/archivos/sistema/bimo_banner.png" id="logo_empresa" /> </a>
      <button class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">
        <!-- onclick="openNav()" -->
        <i class="bi bi-list"></i>
      </button>
      <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav" id="navbar-js">
          <?php include "navbar-menu/navlink-normales.php"; ?>
          <?php if ($menu != null) : ?>
            <li class="nav-item Recepción">
              <div class="dropdown ">
                <a class="dropdown-toggle" id="dropadmin" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-window-stack"></i> Áreas
                </a>
                <!-- Estos botones se cargan en el servidor desde el archivo del include -->
                <ul class="dropdown-menu bg-navbar-drop drop-areas" aria-labelledby="dropadmin">
                  <?php include "navbar-menu/navlink-droplist-areas.php"; ?>
                </ul>
              </div>
            </li>
          <?php endif; ?>
        </ul>
        <ul class="nav navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <a data-bs-toggle="dropdown" type="button" class="dropdown-toggle"><i class="bi bi-person-circle" style="zoom:190%"></i></a>
            <ul class="dropdown-menu dropdown-menu-lg-end bg-navbar-drop">
              <?php include "navbar-menu/navlink-dropuser.php"; ?>
            </ul>
          </li>
        </ul>

      </div>
    </div>
  </nav>
<?php include "offcanvas.php";
    break;
} ?>

<script type="text/javascript">
  $('.dropdown-menu').on('click', function(e) {
    e.stopPropagation();
  });
</script>