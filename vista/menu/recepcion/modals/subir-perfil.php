<div class="modal fade" id="modalPacientePerfil" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="title-paciente_perfil_imagen">?????</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="formPerfilPaciente">
          <div class="col-12 col-md-12 col-lg-12 col-xl-12">
              <label for="segmentosFiltro" class="form-label">Imagen de perfil para la identificación</label>
              <input type="file" name="img" value="" class="form-control input-form" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formPerfilPaciente" class="btn btn-confirmar" id="btn-subir-perfil-paciente">
          <i class="bi bi-person-x"></i> Subir foto
        </button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
// Obtener datos del paciente seleccionado
const modalPacientePerfil = document.getElementById('modalPacientePerfil')
modalPacientePerfil.addEventListener('show.bs.modal', event => {
  document.getElementById("title-paciente_perfil_imagen").innerHTML = "Imagen de perfil al paciente:<br />"+array_paciente[1];

})

//Rechazados
$("#formPerfilPaciente").submit(function(event){
   event.preventDefault();
   document.getElementById("btn-rechazar-paciente").disabled = true;
   /*DATOS Y VALIDACION DEL REGISTRO*/
   var form = document.getElementById("formPerfilPaciente");
   var formData = new FormData(form);
   formData.set('api', array_paciente['DT_RowId']);
   formData.set('api', 3);
   console.log(formData);
   $.ajax({
     data: formData,
     url: "",
     type: "POST",
     processData: false,
     contentType: false,
     success: function(data) {
       data = jQuery.parseJSON(data);
       if (data['codigo'] == 1) {
         Toast.fire({
           icon: 'success',
           title: 'Imagen guardada con exito :)',
           timer: 2000
         });
         $('#modalPacientePerfil').modal('hide');
        }else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Hubo un error, comunique el error al encargado',
            showCloseButton: true,
          });
        }
     }
   });
   event.preventDefault();
 });
</script>
