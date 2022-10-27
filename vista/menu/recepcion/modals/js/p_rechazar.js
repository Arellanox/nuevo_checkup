// Obtener datos del paciente seleccionado
const modalPacienteRechazar = document.getElementById('modalPacienteRechazar')
modalPacienteRechazar.addEventListener('show.bs.modal', event => {
  document.getElementById("title-paciente_rechazar").innerHTML = "Rechazar al paciente:<br />"+array_selected['NRE_COMPLETO'];

})

//Rechazados
$("#formRechazarPaciente").submit(function(event){
   event.preventDefault();
   document.getElementById("btn-rechazar-paciente").disabled = true;
   /*DATOS Y VALIDACION DEL REGISTRO*/
   var form = document.getElementById("formRechazarPaciente");
   var formData = new FormData(form);
   formData.set('id_turno', array_selected['ID_TURNO']);
   formData.set('estado', 1)
   formData.set('api', 2);
   console.log(formData);
   $.ajax({
     data: formData,
     url: "../../../api/recepcion_api.php",
     type: "POST",
     processData: false,
     contentType: false,
     success: function(data) {
       data = jQuery.parseJSON(data);
       if (mensajeAjax(data)) {
         // Mensaje
         {
              alertSelectTable('¡Resultado confirmado!', 'success')
            }
       }
     }
   });
   event.preventDefault();
 });
