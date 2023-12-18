
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
  'Particular': {

    formulario: 'form_particular.html'
  },
  'SLB': {
    MASCULINO: 'slb_masculino', //MASCULINO menor a 40
    FEMENINO: 'slb_femenino', //FEMENINO menor a 40
    VEJEZ: 'slb_vejez', //Persona mayor a 40
    formulario: 'form_slb.html',
  },
}

//funcion para llamar a los botones dependiendo de la procedencia
function btnCertificados(config) {
  return new Promise(resolve => {
    let tipo_format = config.EDAD >= 40 ? 'VEJEZ' : config.GENERO;
    let pdf_format = btnProcedencia[config.cliente][tipo_format];

    $(`#${'cuerpo_certificado'}`).html(''); // Limpiar el cuerpo de HTML
    $.post(`modals/formularios/${btnProcedencia[config.cliente]['formulario']}`, function (html) {
      $(`#${'cuerpo_certificado'}`).html(html);
    }).done(() => {
      // El codigo sigue si se necesita crear mas cosas o validar mas cosas
      // En cierto caso puede usarse un case

      ajaxAwait(
        {
          api: 2,
          cliente_id: datalist['CLIENTE_ID'],
          turno_id: datalist['ID_TURNO']
        }, 'certificados_api', { callbackAfter: true }, false, function (data) {
          datPaciente = data.response.data[0]
          datosPaciente(datPaciente, config.cliente)

          resolve(1)
        })

    });
  })
}

//Click para entrar al modal dependiendo del boton
$(document).on('click', '#btn-carga_certificado', function () {
  $(`#${'MoldaCertificadoMaster'}`).modal('show')
})

