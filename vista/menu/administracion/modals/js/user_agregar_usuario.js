const modalRegistrarUsuario = document.getElementById('ModalRegistrarUsuario')
modalRegistrarUsuario.addEventListener('show.bs.modal', event => {
  $("#Input-Constraseña-Edit").show();
  $("#edit-usuario-contraseña").attr( "name", "contraseña");
  rellenarSelectUsuarios();
})

//Formulario de Preregistro
$("#formRegistrarUsuario").submit(function(event){
   event.preventDefault();
   /*DATOS Y VALIDACION DEL REGISTRO*/
   var form = document.getElementById("formRegistrarUsuario");
   var formData = new FormData(form);
   formData.set('api', 1);
   console.log(formData);

   Swal.fire({
      title: '¿Está seguro que todos los datos están correctos?',
      text: "¡Guarde o recuerde la contraseña!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar',
      cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isConfirmed) {
        //$("#btn-registrarse").prop('disabled', true);
        // Esto va dentro del AJAX
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
                  title: '¡Usuario registrado!',
                  timer: 2000
                });
                document.getElementById("formRegistrarUsuario").reset();
                $("#ModalRegistrarUsuario").modal('hide');
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
      }
    })
   event.preventDefault();
 });
