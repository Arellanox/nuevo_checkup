<?php
$menu = $_POST['menu'];
$tip = $_POST['tip'];
$appname = 'nuevo_checkup';
session_start();
?>

<?php

switch ($menu) {
    case 'Pre-registro':
    case 'Login':
    case 'Temperatura_movil':
    case 'lista_servicios':
        ?>
        <nav class="navbar border-3 border-bottom border-dark bg-navbar">
            <div class="container-fluid d-flex justify-content-center">
                <a href="#" class="navbar-brand" id="img"> <img
                            src="https://bimo-lab.com/archivos/sistema/bimo_banner.png" id="logo_empresa_login"/> </a>
            </div>
        </nav>
        <?php
        break;
    case 'TURNERO':
        ?>
        <nav class="navbar border-dark row">
            <div class="col-5 text-center">
                <span style="font-size: 26px; color: rgb(000, 078, 89); font-weight: 900;">Pacientes</span>
            </div>
            <div class="col-7 text-end px-5">
                <a href="#" class="navbar-brand" id="">
                    <img src="https://bimo-lab.com/archivos/sistema/bimo_banner.png"
                         style="height: 40px;border-radius: 6px;"/>
                </a>
            </div>
        </nav>
        <?php
        break;
    case 'Validar Certificación':
        ?>
        <nav class="navbar border-dark row" style="background: rgb(000, 078, 89); padding: 20px 8px">
            <div class="col-5 text-center">
                <span style="font-size: 26px; color: white; font-weight: 900;">Certificado Bimo</span>
            </div>
            <div class="col-7 text-end px-5">
                <a href="#" class="navbar-brand" id="">
                    <img src="https://bimo-lab.com/archivos/sistema/bimo_banner.png"
                         style="height: 40px;border-radius: 6px;"/>
                </a>
            </div>
        </nav>
        <?php
        break;
    default:
        ?>
        <nav class="navbar navbar-expand-lg border-3 border-bottom border-dark bg-navbar navbar-menu"
             id="navbar_principal">
            <div class="container-fluid">
                <?php if ($menu != 'procedencia'): ?>
                    <a href="https://bimo-lab.com/index.php" class="navbar-brand">
                        <img src="https://bimo-lab.com/archivos/sistema/bimo_banner.png" id="logo_empresa"/>
                        <?= ($_SESSION['URLACTUAL'] == 'drjb.com.mx' && $menu != 'procedencia') ? "| Vista de Capacitación" : ''; ?>
                    </a>
                <?php else: ?>
                    <img src="https://bimo-lab.com/archivos/sistema/bimo_banner.png" id="logo_empresa" width=""/>
                <?php endif; ?>
                <?php if (false && $_SESSION['id_cliente'] == 15) : ?>
                    <img src="https://bimo-lab.com/nuevo_checkup/1724986_dbc8d.gif"
                         style="width: 90px; z-index: 99; position: absolute; left: 40px; top: 12px; transform: rotate(0.04turn);"
                         id="decoration-cumple"/>
                    <div class="contenido-extra-cumple">
                        <a href="#" class="btn-flotante-cumple" id="btn-flotante-cumple" data-bs-toggle="modal"
                           data-bs-target="#modalCardCumpleaños">
                            <!-- <i class="bi bi-question-diamond"></i> -->
                            <img src="https://bimo-lab.com/nuevo_checkup/931950.png" alt="" id="paste-cumple"
                                 style="height: 30px;">
                        </a>

                        <div class="modal fade" id="modalCardCumpleaños" tabindex="-1" aria-labelledby="filtrador"
                             aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered ">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div id="tsparticles"></div>
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <div style="position: relative; width: 100%; height: 0; padding-top: 177.7778%;
     padding-bottom: 0; box-shadow: 0 2px 8px 0 rgba(63,69,81,0.16); margin-top: 1.6em; margin-bottom: 0.9em; overflow: hidden;
     border-radius: 8px; will-change: transform;">
                                                    <iframe loading="lazy"
                                                            style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; border: none; padding: 0;margin: 0;"
                                                            src="https:&#x2F;&#x2F;www.canva.com&#x2F;design&#x2F;DAF7Ua8eJDI&#x2F;watch?embed"
                                                            allowfullscreen="allowfullscreen" allow="fullscreen">
                                                    </iframe>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div style="position: relative; width: 100%; height: 0; padding-top: 177.7778%;
     padding-bottom: 0; box-shadow: 0 2px 8px 0 rgba(63,69,81,0.16); margin-top: 1.6em; margin-bottom: 0.9em; overflow: hidden;
     border-radius: 8px; will-change: transform;">
                                                    <iframe loading="lazy"
                                                            style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; border: none; padding: 0;margin: 0;"
                                                            src="https:&#x2F;&#x2F;www.canva.com&#x2F;design&#x2F;DAF9dxd8ZVI&#x2F;4QbixsXdjdBYkNxBKaaVdg&#x2F;watch?embed"
                                                            allowfullscreen="allowfullscreen" allow="fullscreen">
                                                    </iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <style>
                        #paste-cumple {
                            transition: height 0.8s cubic-bezier(0.165, 0.84, 0.44, 1)
                        }

                        #btn-flotante-cumple {
                            transition: opacity 1s cubic-bezier(0.165, 0.84, 0.44, 1);
                        }

                        video::-webkit-media-controls {
                            display: none;
                        }
                    </style>
                    <script>
                        // autoHeightDiv('#container-card-cumple', 120)

                        // Obtener la imagen por su ID
                        const imagen = document.getElementById('paste-cumple');
                        const contenedor = document.getElementById('btn-flotante-cumple')

                        // Definir el tamaño final de la imagen
                        const alturaFinal = 40;

                        // Definir la opacidad inicial de la imagen
                        const opacidadFinal = 1;

                        // Calcular el tamaño y la opacidad de la imagen en cada paso de la transición
                        const alturaActual = imagen.offsetHeight;
                        const alturaPaso = (alturaActual - alturaFinal) / 50;
                        const opacidadActual = parseFloat(getComputedStyle(contenedor).opacity);
                        const opacidadPaso = (opacidadFinal - opacidadActual) / 50;

                        // Función para reducir gradualmente el tamaño de la imagen
                        function reducirImagen() {
                            const altura = imagen.offsetHeight;
                            const nuevaAltura = altura - alturaPaso * Math.pow((1 - altura / alturaFinal), 2.5);
                            const opacidad = parseFloat(getComputedStyle(contenedor).opacity);
                            const opacidadRestante = opacidadFinal - opacidad;
                            const nuevaOpacidad = opacidad + opacidadRestante * 0.05;
                            if (nuevaAltura > alturaFinal) {
                                imagen.style.height = `${nuevaAltura}px`;
                                contenedor.style.opacity = nuevaOpacidad;
                            } else {
                                imagen.style.height = `${alturaFinal}px`;
                                contenedor.style.opacity = opacidadFinal;
                                clearInterval(intervalo);
                            }
                        }

                        $(document).ready(async function () {
                            await loadFull(tsParticles);

                            $("#tsparticles")
                                .particles()
                                .ajax("https://bimo-lab.com/nuevo_checkup/vista/menu/principal/particles.json", function (container) {
                                    // container is the particles container where you can play/pause or stop/start.
                                    // the container is already started, you don't need to start it manually.
                                });
                        });
                    </script>
                <?php endif; ?>
                <div class="d-lg-none">
                    <button class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop"
                            aria-controls="offcanvasWithBackdrop" style="color: white;border-color: #ffffff54;">
                        <!-- onclick="openNav()" -->
                        <i class="bi bi-list"></i>
                    </button>
                    <div class="promociones promociones-block promociones_btn" style="display: none;">
                        <span>%</span>
                    </div>
                </div>
                <div id="navbarCollapse" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav" id="navbar-js">
                        <?php
                        if ($menu != 'procedencia') {
                            include "navbar-menu/navlink-normales.php";
                            $tip = 'floting';
                            include "navbar-menu/navlink-areas.php";
                            // include "areas-windows-float.php";
                        }
                        ?>

                    </ul>
                    <ul class="nav navbar-nav ms-auto user-profile-navbar">

                        <!-- Botones alado de los usuarios -->
                        <li class="nav-item dropstart d-flex justify-content-center align-items-center m">
                            <?php
                            if ($menu != 'procedencia' && $_SESSION['id_cliente'] == 15) {
                                include "header-menu/buttons.php";
                            }
                            ?>
                        </li>

                        <li class="nav-item dropstart flex-grow-1">
                            <!-- <a data-bs-toggle="dropdown" type="button" class="dropdown-toggle"><i class="bi bi-person-circle" style="zoom:190%"></i></a> -->
                            <a data-bs-toggle="dropdown" type="button" class="promociones_event">
                                <div class=" container-avatar">
                                    <img src="<?php echo $_SESSION['AVATAR']; ?>" alt="Avatar" class="image-avatar">
                                    <div class="overlay-avatar">
                                        <div class="text-avatar"><?php echo strtok($_SESSION['nombre'], " "); ?></div>
                                    </div>
                                    <div class="promociones promociones-block" style="display: none;">
                                        <span class="span-lg">%</span>
                                    </div>
                                </div>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-lg-end bg-navbar-drop"
                                style="background-color: #ffffff00; padding:0px">
                                <div class="" style="width: 100%">
                                    <div class="profile-card-4"><img src="<?php echo $_SESSION['AVATAR']; ?>"
                                                                     class="img img-responsive">
                                        <div class="profile-content">
                                            <div class="profile-name text-center"> <?php echo "$_SESSION[nombre] $_SESSION[apellidos]"; ?>
                                                <p><?php echo "$_SESSION[cargo_descripcion]"; ?></p>
                                            </div>
                                            <div class="profile-description text-center">Hola, ¡buen día! :)</div>

                                            <a href="" class="btn-promociones promociones-block" style="display: none;"
                                               data-bs-toggle="modal" data-bs-target="#modalPromociones">
                                                <i class="bi bi-tag-fill"></i> Promociones
                                            </a>

                                            <?php if ($menu != 'procedencia' && $_SESSION['id_cliente'] == 15) : ?>
                                                <div class="profile-description text-center">
                                                    <a href="<?php echo $_SESSION['newsletter']['button_usuario']['url'] ?>"
                                                       target="_blank" class="a-hover">
                                                        <i class="bi bi-newspaper"></i>
                                                        <?php echo $_SESSION['newsletter']['button_usuario']['tittle_button'] ?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <div class="row" style="padding-right: 5%; padding-left: 5%;">
                                                <?php include "navbar-menu/navlink-dropuser.php"; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <?php
        include "offcanvas.php";
        include "menu-principal.php";
        ?>
        <?php break; ?>
    <?php
}
?>


<script type="text/javascript">
    $('.dropdown-menu').on('click', function (e) {
        e.stopPropagation();
    });
</script>

<!-- Modal de Bootstrap sin header ni footer -->
<div class="modal fade modal-xl" id="modalPromociones" tabindex="-1" aria-labelledby="modalPromocionesLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Contenido del Modal -->
            <div class="modal-body contentPromociones">
                <div class="row justify-content-center div-padre " id="vistaPromociones">

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript"></script>
<style>
    .card-container {
        padding: 100px 0px;
        -webkit-perspective: 1000;
        perspective: 1000;
    }

    .profile-card-4 {
        /* max-width: 300px; */
        background-color: #FFF;
        border-radius: 5px;
        box-shadow: 0px 0px 25px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: relative;
        /* margin: 10px auto; */
        /* cursor: pointer; */
    }

    .profile-card-4 img {
        transition: all 0.25s linear;
        width: 325px;
    }

    .profile-card-4 .profile-content {
        position: relative;
        padding: 15px;
        background-color: #FFF;
    }

    .profile-card-4 .profile-name {
        font-weight: bold;
        position: absolute;
        left: 0px;
        right: 0px;
        top: -70px;
        color: #FFF;
        font-size: 17px;
    }

    .profile-card-4 .profile-name p {
        font-weight: 600;
        font-size: 13px;
        letter-spacing: 1.5px;
    }

    .profile-card-4 .profile-description {
        color: #777;
        font-size: 12px;
        padding: 10px;
    }

    .profile-card-4 .profile-overview {
        padding: 15px 0px;
    }

    .profile-card-4 .profile-overview p {
        font-size: 10px;
        font-weight: 600;
        color: #777;
    }

    .profile-card-4 .profile-overview h4 {
        color: #273751;
        font-weight: bold;
    }

    .profile-card-4 .profile-content::before {
        content: "";
        position: absolute;
        height: 25px;
        top: -10px;
        left: 0px;
        right: 0px;
        background-color: #FFF;
        z-index: 0;
        transform: skewY(3deg);
    }

    .profile-card-4:hover img {
        transform: rotate(2deg) scale(1.04, 1.04);
        filter: brightness(60%);
    }


    /* Promociones en la barra de usuario */
    @keyframes vibrating {

        0%,
        100% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-1px);
        }

        50% {
            transform: translateX(1px);
        }

        75% {
            transform: translateX(-1px);
        }
    }

    .promociones {
        background-color: #ffb400;
        display: inline-block;
        animation: vibrating 0.5s infinite;
        /* crea animacion de temblor */
        width: 23px;
        height: 23px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 28px;
        left: -8px;
    }

    .promociones.promociones_offcanva {
        top: 40px;
        left: -2px;
        width: 26px;
        height: 26px;
    }

    .promociones.promociones_btn {
        background-color: #ffb400;
        /* display: inline-block; */
        animation: vibrating 0.5s infinite;
        /* width: 23px; */
        /* height: 23px; */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: unset;
        /* top: 28px; */
        /* left: -8px; */
        margin: -13px -9px;
    }

    .promociones span {
        color: #000;
        font-weight: bold;
    }

    .btn-promociones {
        background-color: #ffb400;
        border-radius: 10px;
        width: 118px;
        margin-left: 92px;
        margin-top: -1px;
        margin-bottom: -4px;
        animation: vibrating 0.6s infinite;
    }

    .contentPromociones {
        max-height: calc(100vh - 50px);
        overflow-y: auto;
    }
</style>