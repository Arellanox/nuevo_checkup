 <!-- Laboratorio -->
 <?php if ($_SESSION['vista']['LABORATORIO'] == 1) : ?>
     <li class="nav-item Recepción">
         <div class="dropdown ">
             <a class="dropdown-toggle" id="dropLaboratorio" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 <i class="bi bi-heart-pulse"></i> Laboratorio
             </a>
             <!-- Estos botones se cargan en el servidor desde el archivo del include -->
             <ul class="dropdown-menu bg-navbar-drop drop-areas" aria-labelledby="dropLaboratorio">
                 <?php include "navbar-menu/navlink-droplist-laboratorio.php"; ?>
             </ul>
         </div>
     </li>
 <?php endif; ?>

 <!-- Imagenologia -->
 <?php if (
        $_SESSION['vista']['ULTRASONIDO'] == 1 ||
        $_SESSION['vista']['ULTRASONIDOTOMA'] == 1 ||
        $_SESSION['vista']['RX'] == 1 ||
        $_SESSION['vista']['RXTOMA'] == 1
    ) : ?>
     <li class="nav-item Recepción">
         <div class="dropdown ">
             <a class="dropdown-toggle" id="dropImagenologia" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 <i class="bi bi-person-bounding-box"></i> Imagenología
             </a>
             <!-- Estos botones se cargan en el servidor desde el archivo del include -->
             <ul class="dropdown-menu bg-navbar-drop drop-areas" aria-labelledby="dropImagenologia">
                 <?php include "navbar-menu/navlink-droplist-imagenologia.php"; ?>
             </ul>
         </div>
     </li>
 <?php endif; ?>

 <?php if (
        $menu != null ||
        $_SESSION['vista']['ELECTROCARDIOGRAMA'] == 1 ||
        $_SESSION['vista']['ESPIROMETRIA'] == 1 ||
        $_SESSION['vista']['AUDIOMETRIA'] == 1 ||
        $_SESSION['vista']['OFTALMOLOGIA'] == 1 ||
        $_SESSION['vista']['SOMATOMETRIA'] == 1 ||
        $_SESSION['vista']['CONSULTORIO'] == 1
    ) : ?>
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