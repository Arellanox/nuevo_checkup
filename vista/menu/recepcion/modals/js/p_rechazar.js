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
   $.ajax({
     data: formData,
     url: "../../../",
     type: "POST",
     processData: false,
     contentType: false,
     success: function(data) {
       data = jQuery.parseJSON(data);
       if (mensajeAjax(data)) {
         // Mensaje
       }
   });
   event.preventDefault();
 });
