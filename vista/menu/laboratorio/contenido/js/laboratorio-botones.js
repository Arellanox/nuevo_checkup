$('#formAnalisisLaboratorio').submit(function (event) {
  event.preventDefault();

  if (selectListaLab['CONFIRMADO'] == 0) {
    let confirmar = 0;
    var form = document.getElementById("formAnalisisLaboratorio");
    var formData = new FormData(form);
    formData.set('id_turno', selectListaLab['ID_TURNO']);
    formData.set('id_area', 6)
    formData.set('api', 9);
    // console.log(formData);
    if ($('button[type="submit"][form="formAnalisisLaboratorio"]:focus').attr('data-attribute') == 'confirmar') {
      formData.set('confirmar', true);
    }

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
        return fetch(http + servidor + "/nuevo_checkup/api/usuarios_api.php?api=9&password=" + password)
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
            beforeSend: function () {
              alertMensaje('info', 'Espere un momento', 'Guardando resultados...')
            },
            success: function (data) {
              data = jQuery.parseJSON(data);
              if (mensajeAjax(data)) {
                alertSelectTable('¡Resultados guardados!', 'success')
                // dataListaPaciente = {api:5, fecha_busqueda: $('#fechaListadoLaboratorio').val(), area_id: 6}
                tablaListaPaciente.ajax.reload();
                getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab', selectListaLab, 'Out')
              }
            },
          });
        } else {
          alertSelectTable('¡Contraseña incorrecta!', 'error')
        }
      }
    })
  }
})

// $('#btn-guardar-resultados').click(function(){
//   alert("button guardar")
//   console.log($(this))
//   $('#formAnalisisLaboratorio').submit()
//
// })

// $('#btn-confirmar-resultados').click(function(){
//   alert("button confirmar")
//   console.log($(this))
//   // enviarInformacion(1)
//   $('#formAnalisisLaboratorio').submit()
// })
//
//
// $('#formAnalisisLaboratorio').on('submit')

function enviarInformacion(tip) {

}




function formpassword() {
  //No submit form with enter
}

// cambiar fecha de la Lista
$('#fechaListadoLaboratorio').change(function () {
  dataListaPaciente = {
    api: 5,
    fecha_busqueda: $(this).val(),
    area_id: 6
  }
  tablaListaPaciente.ajax.reload();
  getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab', selectListaLab, 'Out')
})