<div class="modal fade" id="modalPacienteRechazar" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="title-paciente_rechazar">?????</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="formRechazarPaciente">
          <div class="col-12 col-md-12 col-lg-12 col-xl-12">
              <label for="segmentosFiltro" class="form-label">Comentario</label>
              <textarea name="name" class="input-form" rows="4" cols="40" placeholder="¿Problema? Escriba la situación" id="textarea-Comentario-rechazar"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formRechazarPaciente" class="btn btn-borrar" id="btn-rechazar-paciente">
          <i class="bi bi-person-x"></i> Rechazar paciente
        </button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
// Obtener datos del paciente seleccionado
const modalPacienteRechazar = document.getElementById('modalPacienteRechazar')
modalPacienteRechazar.addEventListener('show.bs.modal', event => {
  document.getElementById("title-paciente_rechazar").innerHTML = "Rechazar al paciente:<br />"+array_paciente[1];

})

//Rechazados
$("#formRechazarPaciente").submit(function(event){
   event.preventDefault();
   document.getElementById("btn-rechazar-paciente").disabled = true;
   /*DATOS Y VALIDACION DEL REGISTRO*/
   var form = document.getElementById("formRechazados");
   var formData = new FormData(form);
   formData.set('api', 3);
   console.log(formData);
   // $.ajax({
   //   data: formData,
   //   url: "php/api/cursos_conferencia_api.php",
   //   type: "POST",
   //   processData: false,
   //   contentType: false,
   //   success: function(data) {
   //     data = jQuery.parseJSON(data);
   //     if (data['codigo'] == 1) {
   //       Toast.fire({
   //         icon: 'success',
   //         title: 'Ponente Registrado :)',
   //         timer: 2000
   //       });
   //       tablaConferencia();
   //       $('#nuevo_modal').modal('hide');
   //      }else {
   //        Swal.fire({
   //          icon: 'error',
   //          title: 'Oops...',
   //          text: 'Hubo un error, comunique el error al encargado',
   //          showCloseButton: true,
   //        });
   //      }
   //   }
   // });
   event.preventDefault();
 });
</script>
