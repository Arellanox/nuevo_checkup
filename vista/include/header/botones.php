<?php $menu = $_POST['menu']; ?>
<?php if ($menu == "Recepción | Pacientes en espera" || $menu =="Recepción | Pacientes captados" || $menu =="Recepción | Pacientes rechazados") : ?>
  <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-editar">
    <i class="bi bi-pencil-square"></i> Actualizar información del paciente
  </button>
  <!-- <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-perfil">
    <i class="bi bi-image"></i> Subir imagen
  </button> -->
<?php endif; ?>



<?php if ($menu == "Usuarios") : ?>
  <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal" data-bs-target="#ModalRegistrarUsuario">
    <i class="bi bi-person-plus-fill"></i> Agregar nuevo
  </button>
  <!-- <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal" data-bs-target="#ModalMostrarPermisosCargos">
    <i class="bi bi-list-nested"></i> Permisos y Cargos
  </button> -->
<?php endif; ?>


<?php if ($menu == "Preregistro") : ?>
  <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal" data-bs-target="#ModalRegistrarPaciente">
    <i class="bi bi-person-plus-fill"></i> Registrar mi información
  </button>
<?php endif; ?>


<?php if ($menu == "Estudios") : ?>
  <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal" data-bs-target="#ModalRegistrarEstudio">
    <i class="bi bi-plus-square"></i> Agregar nuevo estudio
  </button>
<?php endif; ?>

<?php if ($menu == "Grupos de examenes") : ?>
  <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal" data-bs-target="#ModalRegistrarGrupo">
    <i class="bi bi-plus-square"></i> Agregar nuevo grupo
  </button>
<?php endif; ?>

<?php if ($menu == "Equipos") : ?>
  <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal" data-bs-target="#ModalRegistrarEquipo">
    <i class="bi bi-plus-square"></i> Agregar nuevo equipo
  </button>
<?php endif; ?>


<?php if ($menu == "Segmentos") : ?>
  <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal" data-bs-target="#ModalRegistrarSegmentos">
    <i class="bi bi-plus-square"></i> Agregar nuevo segmento
  </button>
<?php endif; ?>


<?php if ($menu == "Mesometría") : ?>
  <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal" data-bs-target="#ModalRegistrarSegmentos">
    <i class="bi bi-save"></i> Guardar resultados
  </button>
<?php endif; ?>



<?php if ($menu == "Paquetes de clientes") : ?>
  <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal" data-bs-target="#ModalRegistrarPaquete">
    <i class="bi bi-save"></i> Crear Nuevo Paquete
  </button>
  <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal" data-bs-target="#ModalCrearRelacion">
    <i class="bi bi-arrow-down-up"></i> Relacionar Paquete-Cliente
  </button>
<?php endif; ?>




<?php if ($menu == "Clientes") : ?>
  <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal" data-bs-target="#ModalRegistrarCliente">
    <i class="bi bi-people"></i> Agregar Nuevo Cliente
  </button>
<?php endif; ?>

<?php if ($menu == 'Resultados de laboratorio') : ?>
  <div class="row">
    <div class="col-auto">
      <label for="fechaListadoLaboratorio" class="form-label">Día de análisis</label>
    </div>
    <div class="col-auto">
      <input type="date" class="form-control input-form" name="fechaListadoLaboratorio" value="<?php echo date('Y-m-d') ?>" required id="fechaListadoLaboratorio">
    </div>
  </div>
<?php endif; ?>

<?php if ($menu == 'Resultados de Imagenología' || $menu == 'Resultados de Rayos X' || $menu == 'Resultados de Espirometría' || $menu == 'Resultados de Audiometría' || $menu == 'Resultados de Oftalmología') : ?>
  <div class="row">
    <div class="col-auto">
      <label for="fechaListadoLaboratorio" class="form-label">Día de análisis</label>
    </div>
    <div class="col-auto">
      <input type="date" class="form-control input-form" name="fechaListadoLaboratorio" value="<?php echo date('Y-m-d') ?>" required id="fechaListadoAreaMaster" onchange="recargartabla()">
    </div>
  </div>
<?php endif; ?>
