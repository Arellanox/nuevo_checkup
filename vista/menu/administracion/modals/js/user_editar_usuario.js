const modalEditarRegistroUsuario = document.getElementById('ModalEditarRegistroUsuario')
modalEditarRegistroUsuario.addEventListener('show.bs.modal', event => {
  $("#Input-Constraseña-Edit").fadeToggle(1);
  $("#edit-usuario-contraseña").removeAttr( "name" );
  rellenarSelectUsuarios();
  // Colocar ajax
  $.ajax({
    url: "??",
    type: "POST",
    data:{id:array_paciente['DT_RowId']},
    success: function(data) {
      $('#usuario-cargos').val("data")
      $('#usuario-tipo').val("data")
      $('#edit-usuario-nombre').val("data")
      $('#edit-usuario-paterno').val("data")
      $('#edit-usuario-materno').val("data")
      $('#edit-usuario-usuario').val("data")
      $("#edit-usuario-contraseña").style.display = "none";
      $("#edit-usuario-contraseña").removeAttr( "name" );
      // $('#edit-usuario-contraseña').val("data")
      $('#edit-usuario-Profesión').val("data")
      $('#edit-usuario-cedula').val("data")
    }
  })
})
//Formulario de Preregistro
$("#formEditarUsuario").submit(function(event){
   event.preventDefault();
   /*DATOS Y VALIDACION DEL REGISTRO*/
   var form = document.getElementById("formEditarUsuario");
   var formData = new FormData(form);
   formData.set('id', array_paciente['DT_RowId']);
   formData.set('api', 1);
   console.log(formData);

   $.ajax({
     data: formData,
     url: "../../../api/usuarios_api.php",
     type: "POST",
     processData: false,
     contentType: false,
     success: function(data) {
       data = jQuery.parseJSON(data);
       console.log(data);
       switch (data['response']['code'] == 1) {
         case 1:
           Toast.fire({
             icon: 'success',
             title: '¡Usuario actualizado!',
             timer: 2000
           });
           document.getElementById("formEditarUsuario").reset();
           $("#ModalEditarRegistroUsuario").modal('hide');
         break;
         case 2:
           Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: '¡Ha ocurrido un error!',
              footer: 'Codigo: '+data['response']['msj']
           })
         break;
         default:
           Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Hubo un problema!',
              footer: 'Reporte este error con el personal :)'
           })
       }
     },
   });
   event.preventDefault();
 });
