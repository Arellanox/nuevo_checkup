const modalEditarRegistroUsuario = document.getElementById('ModalEditarRegistroUsuario')
modalEditarRegistroUsuario.addEventListener('show.bs.modal', event => {
  $("#Input-Constraseña-Edit").hide();
  $("#edit-usuario-contraseña").removeAttr( "name" );
  rellenarSelect('usuario-cargos-edit','../../../api/cargos_api.php', 2);
  rellenarSelect('usuario-tipo-edit','../../../api/tipos_usuarios_api.php', 2);
  // Colocar ajax
  $.ajax({
    url: "??",
    type: "POST",
    data:{id:array_paciente['DT_RowId']},
    success: function(data) {
      $('#usuario-cargos-edit').val("data")
      $('#usuario-tipo-edit').val("data")
      $('#edit-usuario-nombre').val("data")
      $('#edit-usuario-paterno').val("data")
      $('#edit-usuario-materno').val("data")
      $('#edit-usuario-usuario').val("data")
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
