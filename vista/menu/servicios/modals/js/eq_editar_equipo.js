const ModalEditarEquipo = document.getElementById('ModalEditarEquipo')
ModalEditarEquipo.addEventListener('show.bs.modal', event => {
    $('#edit-claveInv-equipo').val(array_selected['NOMBRE']);
    $('#edit-uso-equipo').val(array_selected['NOMBRE']);
    $('#edit-serie-equipo').val(array_selected['NOMBRE']);
    $('#edit-freMante-equipo').val(array_selected['NOMBRE']);
    $('#edit-npruebasMante-equipo').val(array_selected['NOMBRE']);
    $('#edit-cali-equipo').val(array_selected['NOMBRE']);
    $('#edit-npruebasCali-equipo').val(array_selected['NOMBRE']);
    $('#edit-fechaIngreso-equipo').val(array_selected['NOMBRE']);
    $('#edit-fechaInicio-equipo').val(array_selected['NOMBRE']);
    $('#edit-valorEquipo-equipo').val(array_selected['NOMBRE']);
    $('#edit-descripcion-equipo').val(array_selected['NOMBRE']);
    $('#edit-marca-equipo').val(array_selected['NOMBRE']);
    $('#edit-modelo-equipo').val(array_selected['NOMBRE']);
    $('#edit-foto-equipo').val(array_selected['NOMBRE']);
    $('#edit-estatus-equipo').val(array_selected['NOMBRE']);
})

//Formulario de Preregistro
$("#formEditarEquipo").submit(function(event){
   event.preventDefault();
   /*DATOS Y VALIDACION DEL REGISTRO*/
   var form = document.getElementById("formEditarEquipo");
   var formData = new FormData(form);

    formData.set('api', 1);

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

      }
    })
   event.preventDefault();
 });
