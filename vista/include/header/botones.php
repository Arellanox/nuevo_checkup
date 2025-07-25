<style>
    .animated-button {
        animation: shake 0.3s ease infinite;
        /* Agrega la animación "shake" */
    }

    .animated-button-normal {
        cursor: pointer;
    }

    @keyframes shake {
        0% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-5px);
            /* Mueve el botón a la izquierda */
        }

        50% {
            transform: translateX(5px);
            /* Mueve el botón a la derecha */
        }

        75% {
            transform: translateX(-5px);
            /* Mueve el botón a la izquierda */
        }

        100% {
            transform: translateX(0);
            /* Regresa a la posición original */
        }
    }
</style>

<?php
session_start();
date_default_timezone_set('America/Mexico_City');


$menu = $_POST['menu']; ?>


<?php if ($menu == "Menú principal" ||
    $menu == "Reporte de Excel" ||
    $menu == "Reporte de Excel Laboratorios"
) : ?>
    <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal"
            data-bs-target="#modalFiltrarTabla">
        <i class="bi bi-archive"></i> Filtro
    </button>
<?php endif; ?>

<?php if ($menu == "Pacientes Tratantes") : ?>
    <button type="button" class="btn btn-hover me-2 filtro_paciente_tratnte" style="margin-bottom:4px"
            data-bs-toggle="modal" data-bs-target="#modalFiltrarTablaPacientes"
            title="Filtre los paciente dependiendo de la fecha">
        <i class=" bi bi-person-lines-fill"></i> Ampliar pacientes
    </button>
<?php endif; ?>

<?php if ($menu == "Reporte epidemiológico") : ?>
    <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal"
            data-bs-target="#modalFiltrarTablaReporteEpidemio">
        <i class="bi bi-archive"></i> Filtro
    </button>
<?php endif; ?>

<?php if ($menu == "Recepción | Espera" || $menu == "Recepción | Aceptados" || $menu == "Recepción | Rechazados") : ?>
    <div class="btn-group">
        <button type="button" class="btn btn-hover dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                data-bs-toggle="tooltip" data-bs-placement="top" title="Registra o Agenda un nuevo paciente">
            <i class="bi bi-person-square"></i> Registrar | Agendar | Solicitar
        </button>
        <ul class="dropdown-menu">
            <li>
        <span data-bs-toggle="modal" data-bs-target="#ModalRegistrarPaciente">
          <button type="button" class="btn btn-hover dropdown-item" style="margin-bottom:4px" data-bs-toggle="tooltip"
                  data-bs-placement="left" title="Registra y agenda un paciente particular">
            <i class="bi bi-person-plus"></i> Registrar
          </button>
        </span>
            </li>
            <li>
        <span data-bs-toggle="modal" data-bs-target="#ModalRegistrarPrueba">
          <button type="button" class="btn btn-hover dropdown-item" style="margin-bottom:4px" data-bs-toggle="tooltip"
                  data-bs-placement="left" title="Agenda un paciente ya existente">
            <i class="bi bi-person-lines-fill"></i> Agendar
          </button>
        </span>
            </li>
            <li>
        <span data-bs-toggle="modal" data-bs-target="#modalSolicitudIngresoParticulares"
              id="solicitudIngresoParticulares">
          <button type="button" class="btn btn-hover dropdown-item" data-bs-toggle="tooltip" data-bs-placement="left"
                  title="Envia un correo con un token de registro para particulares">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at"
                 viewBox="0 0 16 16">
              <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
              <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648Zm-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
            </svg> Solicitud
          </button>
        </span>
            </li>
        </ul>
    </div>

    <?php if (!$_SESSION["franquiciario"]): ?>
        <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" onclick="pasarPaciente()"
                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Manda a un paciente a una area disponible">
            <i class="bi bi-arrow-repeat"></i> Optimizar Turnero
        </button>

        <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="get-modal-qr-clientes"
                data-bs-toggle="tooltip" data-bs-placement="bottom" title="QR de Clientes">
            <i class="bi bi-qr-code"></i> QR
        </button>

        <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="EstudiosInfo"
                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Información de estudios">
            <i class="bi bi-search"></i> Estudios
        </button>

        <!-- Boton para recibir notificaciones de reportes no enviados(abre un modal a una vista previa de los reportes no enviados) -->
        <button type="button" class="btn btn-hover position-relative me-2" style="margin-bottom:4px"
                id="btn-modalNotificacionesReportes" data-bs-toggle="tooltip" data-bs-placement="bottom"
                title="Notificacion de reportes no entregados">
            <i class="bi bi-bell-fill"></i> No entregado
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                  id="numReportes" style="display: none;">
      <span class="visually-hidden">unread messages
      </span>
    </span>
        </button>
    <?php endif; ?>
<?php endif; ?>

<?php if ($menu == "Usuarios") : ?>
    <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal"
            data-bs-target="#ModalRegistrarUsuario">
        <i class="bi bi-person-plus-fill"></i> Agregar nuevo
    </button>
    <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal"
            data-bs-target="#ModalFormUsuario" data-bs-whatever="new">
        <i class="bi bi-person-plus-fill"></i> Nuevo Usuario
    </button>
<?php endif; ?>

<?php if ($menu == "Pre-registro") : ?>
    <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal"
            data-bs-target="#ModalRegistrarPaciente">
        <i class="bi bi-person-plus-fill"></i> Registrar mi información
    </button>
<?php endif; ?>

<?php if ($menu == "Pre-registration") : ?>
    <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal"
            data-bs-target="#ModalRegistrarPaciente">
        <i class="bi bi-person-plus-fill"></i> Register my information
    </button>
<?php endif; ?>

<?php if (
    $menu == "Estudios - Laboratorio" ||
    $menu == "Estudios" ||
    $menu == "Grupos de estudios - Laboratorio" ||
    $menu == "Grupos de estudios" ||
    $menu == "Estudios de Rayos X" ||
    $menu == 'Estudios de Ultrasonido' ||
    $menu == "Estudios Checkup"
) : ?>
    <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-agregar-estudio">
        <i class="bi bi-plus-square"></i> Agregar
    </button>
<?php endif; ?>

<?php if ($menu == "Equipos") : ?>
    <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal"
            data-bs-target="#ModalRegistrarEquipo">
        <i class="bi bi-plus-square"></i> Agregar equipo
    </button>
<?php endif; ?>

<?php if ($menu == "Segmentos") : ?>
    <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal"
            data-bs-target="#ModalRegistrarSegmentos">
        <i class="bi bi-plus-square"></i> Agregar nuevo segmento
    </button>
<?php endif; ?>

<?php if ($menu == "Somatometría") : ?>
    <button type="submit" class="btn btn-hover me-2" form="form-resultados-somatometria" style="margin-bottom:4px">
        <i class="bi bi-save"></i> Guardar resultados
    </button>
    <button type="submit" data-attribute="confirmar" class="btn btn-hover" id="omitir-paciente"
            style="margin-bottom:4px">
        <i class="bi bi-clipboard-x"></i> Saltar paciente
    </button>
<?php endif; ?>

<?php if ($menu == "Paquetes de clientes") : ?>
    <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal"
            data-bs-target="#ModalRegistrarPaquete">
        <i class="bi bi-save"></i> Crear Nuevo Paquete
    </button>
<?php endif; ?>

<?php if ($menu == 'Estado actual del paciente') : ?>
    <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="recargarTabla">
        <i class="bi bi-arrow-clockwise"></i> Re-cargar tabla
    </button>
<?php endif; ?>

<?php if ($menu == "Clientes") : ?>
    <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal"
            data-bs-target="#ModalRegistrarCliente">
        <i class="bi bi-people"></i> Agregar Nuevo Cliente
    </button>
<?php endif; ?>

<?php if (
$menu == 'Reportes de Laboratorio Clínico' ||
$menu == 'Validación de resultados de laboratorio' ||
$menu == 'Laboratorio Clínico' ||
$menu == 'Resultados de Laboratorio Clinico' ||
$menu == 'Resultados de Laboratorio Biomolecular' ||
$menu == 'Laboratorio Biomolecular'
) : ?>
<div class="row">
    <div class="col-auto d-flex gap-3 align-items-center">
        <div class="dropdown">
            <button
                    class="btn btn-primary position-relative gap-2" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"
            >
                <i class="fa fa-clock-o"></i> Pendientes
                <span id="badge_estudios_pendientes" data-bs-toggle="tooltip" title="Estudios pendientes"
                      class="position-absolute translate-middle badge rounded-pill bg-danger hidden"
                      style="right: -20px; font-weight: lighter !important;"
                >
                </span>
                <span id="badge_maquilas_pendientes" data-bs-toggle="tooltip" title="Maquilas pendientes"
                      class="position-absolute translate-middle badge rounded-pill hidden"
                      style="background: #cf6218; right: 5px; font-weight: lighter !important;"
                >
                </span>
            </button>

            <ul class="dropdown-menu">
                <li>
                    <button class="dropdown-item gap-2"
                            id="btn-maquilas-pendientes-notificacion"
                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Maquilas enviadas para aprobación"
                    >
                        <span>Maquilas enviadas</span>
                        <span id="badge_maquila_icon" class="block badge rounded-pill hidden" style="background: #cf6218">
                            <span id="badge_maquila_icon_total"></span>
                            <span class="visually-hidden" style="font-weight: lighter !important;">
                                Maquilas pendientes
                            </span>
                        </span>
                    </button>
                </li>
                <li>
                    <div class="dropdown-item gap-2"
                         id="btn-estudios-pendientes-notificacion"
                         data-bs-toggle="tooltip" data-bs-placement="bottom"
                         title="Estudios pendientes por realizar"
                    >
                        <span>Estudios pendientes</span>
                        <span id="badge_estudio_icon" class="block badge rounded-pill bg-danger hidden">
                            <span id="badge_estudio_icon_total"></span>
                            <span class="visually-hidden" style="font-weight: lighter !important;">
                                Estudios pendientes
                            </span>
                        </span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-auto d-flex align-items-center">
        <label for="fechaListadoLaboratorio" class="form-label">Día de análisis</label>
    </div>
    <div class="col-auto d-flex align-items-center">
        <input type="date" class="form-control input-form" name="fechaListadoLaboratorio"
               value="<?php echo date('Y-m-d') ?>"
               required id="fechaListadoLaboratorio" style="width: 130px">
    </div>
    <div class="col-auto d-flex align-items-center">
        <span class="form-label">al</span>
    </div>
    <div class="col-auto d-flex align-items-center">
        <input type="date" class="form-control input-form" name="fechaFinalListadoLaboratorio"
               value="<?php echo date('Y-m-d', strtotime('+30 days')) ?>"
               id="fechaFinalListadoLaboratorio" style="width: 130px">
    </div>
    <div class="col-auto d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="bottom"
         title="Visualiza todos los pacientes del area">
        <input class="form-check-input" type="checkbox" value="" id="checkDiaAnalisis" style="margin: 5px">
        <label class="form-check-label" for="checkDiaAnalisis">
            Todos
        </label>
    </div>

    <style>
        .hidden {
            display: none !important;
        }
    </style>

    <?php if ($menu == 'Resultados de Laboratorio Clinico'): ?>
        <!-- imprimir lista de trabajo con codigo de barras -->
        <div class="col-auto d-flex align-items-center">
            <div
                    class="col-auto d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    title="Imprimir lista de trabajo"
            >
                <button type="button" id="btn-lista-trabajo-barras" class="btn btn-danger me-2 text-xs">
                    <i class="bi bi-printer" style="margin-right: 2px"> </i> Imprimir LT
                </button>
            </div>
        </div>
        <!-- imprimir lista de trabajo con codigo de barras -->
    <?php endif; ?>

    <?php endif; ?>

    <?php if (
        $menu == 'Resultados de Ultrasonido'
        || $menu == 'Carga de imagenes de Ultrasonido'
        || $menu == 'Resultados de Rayos X'
        || $menu == 'Carga de placas de Rayos X'
        || $menu == 'Resultados de Espirometría'
        || $menu == 'Resultados de Audiometría'
        || $menu == 'Resultados de Oftalmología'
        || $menu == 'Resultados de Electrocardiograma'
        || $menu == 'Carga de Electrocardiograma'
        || $menu == 'Toma de muestras'
        || $menu == 'Somatometría | Signos Vitales'
        || $menu == 'Consultorio'
        || $menu == 'Estudio de Composición Corporal (InBody)'
        || $menu == 'Toma de muestras Checkups'
        || $menu == 'Toma de muestras 2'
    ) : ?>
        <div class="row">
            <div class="col-auto d-flex align-items-center">
                <label for="fechaListadoAreaMaster" class="form-label">Día de análisis</label>
            </div>
            <div class="col-auto d-flex align-items-center">
                <input type="date" class="form-control input-form" name="fechaListadoAreaMaster"
                       value="<?php echo date('Y-m-d') ?>" required id="fechaListadoAreaMaster">
            </div>
            <div class="col-auto d-flex align-items-center">
                <span class="form-label">al</span>
            </div>
            <div class="col-auto d-flex align-items-center">
                <input type="date" class="form-control input-form" name="fechaFinalListadoAreaMaster"
                       value="<?php echo date('Y-m-d', strtotime('+30 days')) ?>"
                       id="fechaFinalListadoAreaMaster">
            </div>
            <div class="col-auto d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="bottom"
                 title="Visualiza todos los pacientes del area">
                <input class="form-check-input" type="checkbox" value="" id="checkDiaAnalisis" style="margin: 5px">
                <label class="form-check-label" for="checkDiaAnalisis">
                    Todos
                </label>
            </div>
        </div>
    <?php endif; ?>

    <?php if (strpos($menu, 'Agenda de pacientes') !== false) : ?>
        <div class="row">
            <div class="col-auto d-flex align-items-center">
                <label for="fechaSelected" class="form-label">Día</label>
            </div>
            <div class="col-auto d-flex align-items-center">
                <input type="date" class="form-control input-form" name="fechaSelected"
                       value="<?php echo date('Y-m-d') ?>" required id="fechaSelected">
            </div>
            <div class="col-auto d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="bottom"
                 title="Visualiza todos los pacientes del area">
                <input class="form-check-input" type="checkbox" value="" id="checkDiaFechaSelected" style="margin: 5px">
                <label class="form-check-label" for="checkDiaFechaSelected">
                    Todos
                </label>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($menu == 'Pacientes (Crédito)') : ?>
        <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="modalGruposPacienteCredito">
            <i class="bi bi-archive"></i> Generar Grupo
        </button>
    <?php endif; ?>

    <?php if ($menu == "Registros de Temperatura" && $_SESSION['permisos']['SupTemp'] == 1) : ?>
        <div class="d-flex">
            <button type="button" data-bs-toggle='tooltip' data-bs-placement='left'
                    title="Liberar un rango de días  para la captura de temperaturas de los equipos"
                    class="btn btn-hover me-2" style="margin-bottom:4px; display:none" id="LibererDiaTemperatura">
                <i class="bi bi-arrow-down-circle-fill"></i> Liberar Dia
            </button>

            <div class="dropdown">
                <button class="btn btn-hover me-2 dropdown-toggle" type="button" style="margin-bottom:4px;"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-gear-fill"></i> Configuración
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <button class="btn dropdown-item" id="TermometrosbtnTemperaturas" data-bs-toggle='tooltip'
                                data-bs-placement='top'
                                title="Configuración de los termómetros asignados a los equipos">Termómetros
                        </button>
                    </li>
                    <li>
                        <button class="btn dropdown-item" id="ConfiguracionTemperaturasbtn" data-bs-toggle='tooltip'
                                data-bs-placement='right'
                                title="Configuración de los turnos y activar los días domingos">Más Configuración
                        </button>
                    </li>
                </ul>
            </div>

        </div>
    <?php endif; ?>

    <?php if ($menu == 'Cotizaciones de estudios') : ?>
        <div class="">
            <input type="radio" class="btn-check" name="selectPaquete" id="check-agregar" value="1" checked
                   autocomplete="off">
            <label class="btn btn-outline-success" for="check-agregar"><i class="bi bi-list"></i>
                Nuevo</label>

            <input type="radio" class="btn-check" name="selectPaquete" id="check-editar" value="2" autocomplete="off">
            <label class="btn btn-outline-success" for="check-editar"><i class="bi bi-list"></i>
                Mantenimiento
            </label>
        </div>

    <?php endif; ?>

    <?php if ($menu == "Corte de caja" && $_SESSION['permisos']['AdminCaja'] == 1) : ?>
        <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal"
                data-bs-target="#ModalAdministrarCajas">
            <i class="bi bi-box-seam"></i> Administrar cajas
        </button>
    <?php endif; ?>

    <?php if ($menu == "Pacientes | Empresas") : ?>
        <span data-bs-toggle="modal" data-bs-target="#ModalRegistrarPaciente">
        <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="tooltip"
                data-bs-placement="top" title="Registra y agenda un paciente particular"
        >
            <i class="bi bi-person-plus"></i> Registrar
        </button>
    </span>

        <span data-bs-toggle="modal" data-bs-target="#ModalRegistrarPrueba">
        <button
                type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="tooltip"
                data-bs-placement="top" title="Agenda un paciente ya existente"
        >
            <i class="bi bi-person-lines-fill"></i> Agendar
        </button>
    </span>
    <?php endif; ?>

    <?php if ($menu == "Vendedores") : ?>
        <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" onclick="btnModal('nuevo_vendedor')">
            <i class="bi bi-person-fill-add"></i> Nuevo vendedor
        </button>
    <?php endif; ?>

    <?php if (strtolower($menu) == "caja chica" && $_SESSION["permisos"]["CrearCajaChica"]): ?>
        <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal"
                data-bs-target="#ModalAdministrarCajas">
            <i class="bi bi-piggy-bank"></i> Administrar cajas
        </button>
    <?php endif; ?>

    <?php if($menu == "Requisición Maquilas"): ?>
        <div class="d-flex align-items-center justify-content-end">
            <button id="btn-aprobar-todos" type="button" role="button" class="btn btn-hover btn-aprobar-all">
                Aprobar todas
                <i class="bi bi-check-all fs-4"></i>
            </button>
            <button id="btn-select-fechas" type="button" role="button" class="btn btn-hover btn-aprobar-all">
                Seleccionar Rango de Fechas
                <i class="fa fa-calendar"></i>
            </button>
            <button id="btn-generar-reportes" type="button" role="button" class="btn btn-hover btn-generar-reporte">
                Generar Reporte
                <i class="fa fa-file-pdf-o"></i>
            </button>
        </div>
    <?php endif; ?>

    <script>
        // Abrir el dropdown al pasar el mouse
        $('.btn-group').on('mouseenter', '.dropdown-toggle', function () {
            $(this).dropdown('toggle');
        });

        // Opcional: Cerrar el dropdown al salir el mouse del menú
        $('.dropdown-menu').on('mouseleave', function () {
            ""
            $(this).closest('.btn-group').find('.dropdown-toggle').dropdown('toggle');
        });
    </script>
