<?php $menu = $_POST['menu']; ?>
<?php if ($menu == "Recepción" || $menu == "Laboratorio"): ?>
  <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-editar">
    <i class="bi bi-pencil-square"></i> Editar paciente
  </button>
  <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-perfil">
    <i class="bi bi-image"></i> Subir imagen
  </button>
<?php endif; ?>
<?php if ($menu == "Administración | Usuarios"): ?>
  <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal" data-bs-target="#ModalRegistrarPaciente" >
    <i class="bi bi-person-plus-fill"></i> Agregar nuevo
  </button>
  <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal" data-bs-target="#ModalRegistrarPaciente" >
    <i class="bi bi-list-nested"></i> Permisos
  </button>
  <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal" data-bs-target="#ModalRegistrarPaciente" >
    <i class="bi bi-list-nested"></i> Cargos
  </button>
<?php endif; ?>
<?php if ($menu == "Preregistro"): ?>
  <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal" data-bs-target="#ModalRegistrarPaciente" >
    <i class="bi bi-person-plus-fill"></i> Registrar mi información
  </button>
<?php endif; ?>
