<h5>Genere su nueva cita</h5>
<!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
<hr>

<div class="row">
  <div class="col-12 col-lg-4">
    <label for="nombre" class="form-label">Nombre(s)</label>
    <input type="text" name="nombre" value="" class="form-control required input-form" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
  </div>
  <div class="col-6 col-lg-4">
    <label for="paterno" class="form-label">Apellido paterno</label>
    <input type="text" name="paterno" value="" class="form-control required input-form" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
  </div>
  <div class="col-6 col-lg-4">
    <label for="materno" class="form-label">Apellido materno</label>
    <input type="text" name="materno" value="" class="form-control required input-form" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
  </div>
  <div class="col-8 col-lg-4">
    <label for="nacimiento" class="form-label">Fecha de nacimiento</label>
    <input type="date" class="form-control required input-form" name="nacimiento" placeholder="" onchange="$(`input[class='form-control required input-form agenda']`).val(calcularEdad(this.value))">
  </div>
  <div class="col-4 col-lg-4">
    <label for="edad" class="form-label">Edad</label>
    <div class="input-group">
      <input type="number" class="form-control required input-form agenda" id="numericEdad" step="0.01" name="edad" placeholder="años" min="0" max="150">
      <!-- <span class="input-span">años</span> -->
    </div>
  </div>
  <div class="col-12 col-lg-4">
    <label for="correo" class="form-label">Correo electronico</label>
    <input type="email" class="form-control input-form" name="correo" placeholder="@hotmail.com" required data-bs-toggle="tooltip" data-bs-placement="top" title="Se requiere un correo para envio de resultados">
    <!-- <input type="email" class="form-control input-form" name="correo_2" placeholder="Segundo Correo" data-bs-toggle="tooltip" data-bs-placement="top" title="Se requiere un correo para envio de resultados"> -->
  </div>
  <!-- <div class="col-12 col-lg-4">
    <label for="curp" class="form-label">Fecha de agenda</label>
    <input type="date" name="fechaAgenda" value="<?php echo date('Y-m-d') ?>" class="form-control required input-form" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" id="fecha-agenda">
  </div> -->
</div>


<?php
date_default_timezone_set('America/Mexico_City'); ?>