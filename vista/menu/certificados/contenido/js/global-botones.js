
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
    api: 1
    // fecha_busqueda: $('#fechaListadoAreaMaster').val()
  }

  if (fecha) dataListaPaciente['fecha_busqueda'] = $('#fechaListadoAreaMaster').val();

  TablaContenidoPaciCertificados.ajax.reload()
}

//Mapeo de la procedencia de los botones
const btnProcedencia = {
  'Particular': '#btn-reporteParticular',
  'SLB': '#btn-reporteSlb',
  'EXPRO': '#btn-reporteExpro',
  'VINCO': '#btn-reporteVinco',
  'POE': '#btn-reportePoe'
}

//funcion para llamar a los botones dependiendo de la procedencia
function btnCertificados(procedencia, genero) {
  $(".btn-ocultar").hide(); //oculta todos los btn antes

  const btnSeleccion = btnProcedencia[procedencia] //Entra en el mapeto y busca lo que se trae desde la funcion
  if (btnSeleccion) {
    $(btnSeleccion).show()
  }
}

//Click para entrar al modal dependiendo del boton
$('.btn-confirmar').click(function () {
  const modalId = $(this).data('modal-id');

  //Recupera la informacion del paciente
  ajaxAwait(
    {
      api: 2,
      cliente_id: datalist['CLIENTE_ID'],
      turno_id: datalist['ID_TURNO']
    }, 'certificados_api', { callbackAfter: true }, false, function (data) {
      datPaciente = data.response.data[0]
      datosPaciente(datPaciente)
    })
    
  $(modalId).modal('show')
  
})

