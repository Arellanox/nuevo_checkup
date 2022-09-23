const ModalVistaMetodos = document.getElementById('ModalVistaMetodos')
ModalVistaMetodos.addEventListener('show.bs.modal', event => {
  
})

//Formulario de Preregistro
$("#formRegistrarServicio").submit(function(event){
   event.preventDefault();
   /*DATOS Y VALIDACION DEL REGISTRO*/
   var form = document.getElementById("formRegistrarServicio");
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


select2('select_metodos', 'ModalVistaMetodos')
