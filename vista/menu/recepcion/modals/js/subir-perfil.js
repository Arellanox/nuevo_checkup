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
       if (mensajeAjax(data)) {
         Toast.fire({
           icon: 'success',
           title: 'Imagen guardada con exito :)',
           timer: 2000
         });
         $('#modalPacientePerfil').modal('hide');
       }
     }
   });
   event.preventDefault();
 });
