$('#formAnalisisLaboratorio').submit(function(event){
   event.preventDefault();
   var form = document.getElementById("formAnalisisLaboratorio");
   var formData = new FormData(form);
   formData.set('EstudiosID', idsEstudios);
   formData.set('api', 1);
   console.log(formData);

   Swal.fire({
    title: '¿Estás seguro de confirmar los resultados?',
    text: 'Use su contraseña para confirmar',
    showCancelButton: true,
    confirmButtonText: 'Confirmar',
    cancelButtonText: 'Cancelar',
    showLoaderOnConfirm: true,
    html: `<input type="password" id="password-confirmar" class="swal2-input" name="confirm-password" autocomplete="off" placeholder="">`,
    confirmButtonText: 'Sign in',
    focusConfirm: false,
    preConfirm: () => {
      const password = Swal.getPopup().querySelector('#password-confirmar').value
      return fetch(http+servidor+"/nuevo_checkup/api/usuarios_api.php?api=9&password="+password)
        .then(response => {
          if (!response.ok) {
            throw new Error(response.statusText)
          }
          return response.json()
        })
        .catch(error => {
          Swal.showValidationMessage(
            `Request failed: ${error}`
          )
        })
    },
    allowOutsideClick: () => !Swal.isLoading()
  }).then((result) => {
    if (result.isConfirmed) {
      if (result.value.status == 1) {
        alert('si')
      }else{
        alert('No')
      }
    }
  })

})

// cambiar fecha de la Lista
$('#fechaListadoLaboratorio').change(function(){

  dataListaPaciente.fecha = $(this).val();
  tablaListaPaciente.ajax.reload();
})
