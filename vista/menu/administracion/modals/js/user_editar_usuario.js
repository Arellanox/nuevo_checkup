const modalEditarRegistroUsuario = document.getElementById('ModalEditarRegistroUsuario')
modalEditarRegistroUsuario.addEventListener('show.bs.modal', event => {
  $("#Input-Constraseña-Edit").hide();
  $("#edit-usuario-contraseña").removeAttr( "name" );
  rellenarSelect('usuario-cargos-edit','../../../api/cargos_api.php', 2);
  rellenarSelect('usuario-tipo-edit','../../../api/tipos_usuarios_api.php', 2);
  // Colocar ajax
  $.ajax({
    url: "../../../api/usuarios_api.php",
    type: "POST",
    data:{id:array_selected['ID_USUARIO'], api: 3},
    success: function(data) {
      data = jQuery.parseJSON(data);
      console.log(data);
      switch (data['response']['code']) {
        case 1:
          $('#usuario-cargos-edit').val(data['response']['data'][0]['CARGO_ID'])
          $('#usuario-tipo-edit').val(data['response']['data'][0]['TIPO_ID'])
          $('#edit-usuario-nombre').val(data['response']['data'][0]['NOMBRE'])
          $('#edit-usuario-paterno').val(data['response']['data'][0]['PATERNO'])
          $('#edit-usuario-materno').val(data['response']['data'][0]['MATERNO'])
          $('#edit-usuario-usuario').val(data['response']['data'][0]['USUARIO'])
          // $('#edit-usuario-contraseña').val("data")
          $('#edit-usuario-Profesión').val(data['response']['data'][0]['PROFESION'])
          $('#edit-usuario-cedula').val(data['response']['data'][0]['CEDULA'])
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
    }
  })
})
//Formulario de Preregistro
$("#formEditarUsuario").submit(function(event){
   event.preventDefault();
   /*DATOS Y VALIDACION DEL REGISTRO*/
   var form = document.getElementById("formEditarUsuario");
   var formData = new FormData(form);
   formData.set('id', array_selected['ID_USUARIO']);
   formData.set('api', 4);
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
       switch (data['response']['code']) {
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
