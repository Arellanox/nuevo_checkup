$('#form-resultados-somatometria').submit(function (event) {
  // if (selectListaMuestras['MUESTRA_TOMADA'] == 0) {
  event.preventDefault();
  var form = document.getElementById("form-resultados-somatometria");
  var formData = new FormData(form);
  formData.set('id_turno', selectListaSignos['ID_TURNO'])
  formData.set('medidas[3]', $('#masaCorporal').val())

  formData.set('api', 3);

  Swal.fire({
    title: "¿Está seguro que todos los datos están correctos?",
    text: "¡No podrá cambiar estos datos!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Aceptar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        data: formData,
        url: "../../../api/somatometria_api.php",
        type: "POST",
        processData: false,
        contentType: false,
        success: function (data) {
          data = jQuery.parseJSON(data);
          if (mensajeAjax(data)) {
            Toast.fire({
              icon: "success",
              title: "¡Signos vitales guardados!",
              timer: 2000,
            });
            tablaSignos.ajax.reload();
          }
        },
      });

    }
  });
  // }
})

// Control de turnos
$('#omitir-paciente').on('click', function () {
  omitirPaciente(3); //case 3
})

$('#llamar-paciente').on('click', function () {
  llamarPaciente(3); //case 2
})

$('#liberar-paciente').on('click', function () {
  if (selectListaSignos) {
    liberarPaciente(3, selectListaSignos['ID_TURNO']); //case 1
  } else {
    alertMensaje('info', 'Paciente no seleccionado', 'Necesita seleccionar el paciente actual para liberar su turno')
  }
})

// // cambiar fecha de la Lista
// $('#fechaListadoAreaMaster').change(function () {
//   dataListaPaciente = { api: 5, fecha_agenda: $(this).val(), area_id: 1 }
//   tablaSignos.ajax.reload();
//   // getPanelLab('Out', 0)
// })


// cambiar fecha de la Lista
$('#fechaListadoAreaMaster').change(function () {
  recargarVistaLab();
})

$('#checkDiaAnalisis').click(function () {
  if ($(this).is(':checked')) {
    recargarVistaLab(0)
    $('#fechaListadoAreaMaster').prop('disabled', true)
  } else {
    recargarVistaLab();
    $('#fechaListadoAreaMaster').prop('disabled', false)
  }
})

function recargarVistaLab(fecha = 1) {
  dataListaPaciente = {
    api: 5,
    area_id: 2
  }
  if (fecha) dataListaPaciente['fecha_busqueda'] = $('#fechaListadoAreaMaster').val();

  tablaSignos.ajax.reload();
  getPanelLab('Out', 0)
}
