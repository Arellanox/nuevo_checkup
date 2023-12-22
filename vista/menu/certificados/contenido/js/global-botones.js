
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
    AMBOS: 'particular_ambos',
    formulario: 'form_particular.html'
  },
  'SLB': {
    MASCULINO: 'slb_masculino', //MASCULINO menor a 40
    FEMENINO: 'slb_femenino', //FEMENINO menor a 40
    VEJEZ: 'slb_vejez', //Persona mayor a 40
    formulario: 'form_slb.html', // Formulario a elegir de SLb
  },
  'VINCO': {
    AMBOS: 'vinco_general',
    formulario: 'form_vinco_general.html'
  },


}

//funcion para llamar a los botones dependiendo de la procedencia
function btnCertificados(config) {
  return new Promise(resolve => {

    let tipo_format = config.EDAD >= 40 ? 'VEJEZ' : config.GENERO; // Obtienes el tipo de formato
    let pdf_format = btnProcedencia[config.cliente] // Obtienes los valores del cliente

    switch (config.cliente) {
      case 'SLB':
        pdf_format = pdf_format[tipo_format]; // Obtiene el formato a utilizar de SLB 
        break;

      default:
        pdf_format = pdf_format['AMBOS'] // Obtener el formato a utilizar de cualquiera
        break;
    }


    $(`#${'cuerpo_certificado'}`).html(''); // Limpiar el cuerpo de HTML
    $.post(`modals/formularios/${btnProcedencia[config.cliente]['formulario']}`, function (html) {
      $(`#${'cuerpo_certificado'}`).html(html);
    }).done(() => {
      // El codigo sigue si se necesita crear mas cosas o validar mas cosas
      // En cierto caso puede usarse un case
      obtenerPanelInformacion(config.turno, 'consulta_api', 'listado_resultados', '#listado-resultados')

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

