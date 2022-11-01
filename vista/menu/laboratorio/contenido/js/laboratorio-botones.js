$('#formAnalisisLaboratorio').submit(function(event){
   event.preventDefault();
   // if ($(".subir-resultado-lab").attr("data-attribute") == "guardar"){
   //   alert('Guardar')
   // }else{
   //   alert('confirmar')
   // }


   var form = document.getElementById("formAnalisisLaboratorio");
   var formData = new FormData(form);
   formData.set('id_turno', selectListaLab['ID_TURNO']);
   formData.set('id_area', 6)
   formData.set('api', 9);
   console.log(formData);
   Swal.fire({
    title: '¿Estás seguro de guardar los resultados?',
    text: 'Use su contraseña para confirmar',
    showCancelButton: true,
    confirmButtonText: 'Confirmar',
    cancelButtonText: 'Cancelar',
    showLoaderOnConfirm: true,
    // inputAttributes: {
    //   autocomplete: false
    // },
    // input: 'password',
    html: '<form autocomplete="off" onsubmit="formpassword(); return false;"><input type="password" id="password-confirmar" class="form-control input-color" autocomplete="off" placeholder=""></form>',
    // confirmButtonText: 'Sign in',
    focusConfirm: false,
    preConfirm: () => {
      const password = Swal.getPopup().querySelector('#password-confirmar').value;
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
        $.ajax({
          data: formData,
           url: "../../../api/turnos_api.php",
          type: "POST",
          processData: false,
          contentType: false,
          beforeSend:function(){
            alertMensaje('info', 'Espere un momento', 'Guardando resultados...')
          },
          success: function (data) {
            data = jQuery.parseJSON(data);
            if (mensajeAjax(data)) {
              alertSelectTable('¡Resultado confirmado!', 'success')
              // dataListaPaciente = {api:5, fecha_busqueda: $('#fechaListadoLaboratorio').val(), area_id: 6}
              tablaListaPaciente.ajax.reload();
              getPanelLab('Out', 0)
            }
          },
        });
      }else{
        alertSelectTable('¡Contraseña incorrecta!', 'error')
      }
    }
  })

})



function formpassword(){
  //No submit form with enter
}

// cambiar fecha de la Lista
$('#fechaListadoLaboratorio').change(function(){
  dataListaPaciente = {api:5, fecha_busqueda: $(this).val(), area_id: 6}
  tablaListaPaciente.ajax.reload();
  getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab',selectListaLab, 'Out')
})
