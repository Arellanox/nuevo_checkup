
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
  1: {
    'Particular': {
      cualquiera: 'particular_ambos',
      formulario: 'form_particular.html'
    },
    'SLB': {
      MASCULINO: 'slb_masculino', //MASCULINO menor a 40
      FEMENINO: 'slb_femenino', //FEMENINO menor a 40
      VEJEZ: 'slb_vejez', //Persona mayor a 40
      formulario: 'form_slb.html', // Formulario a elegir de SLb
    },
    'VINCO': {
      cualquiera: 'vinco_general',
      formulario: 'form_vinco_general.html'
    },
  },
  2: {
    "POE": {
      cualquiera: 'poe_general',
      formulario: 'form_poe_general.html'
    }
  }
}

//funcion para llamar a los botones dependiendo de la procedencia
function btnCertificados(config) {
  return new Promise(resolve => {

    let cliente_certificado = certificado_tipo['certificacion'] ? certificado_tipo['certificacion'] : config.cliente;

    let tipo_format = config.edad >= 40 ? 'VEJEZ' : config.genero; // Obtienes el tipo de formato
    pdf_format = ifnull(btnProcedencia[certificado_tipo['tipo']], [], [cliente_certificado]) // Obtienes los valores del cliente

    let form_html = ifnull(pdf_format, 'form_particular.html', ['formulario']);

    switch (cliente_certificado) {
      case 'SLB':
        pdf_format = pdf_format[tipo_format]; // Obtiene el formato a utilizar de SLB 
        break;

      default:
        pdf_format = ifnull(pdf_format, 'particular_ambos', ['cualquiera']) // Obtener el formato a utilizar de cualquiera
        break;
    }


    $(`#${'cuerpo_certificado_form'}`).html(''); // Limpiar el cuerpo de HTML
    $.post(`modals/formularios/${form_html}`, function (html) {
      $(`#${'cuerpo_certificado_form'}`).html(html);
    }).done(() => {
      // El codigo sigue si se necesita crear mas cosas o validar mas cosas
      // En cierto caso puede usarse un case

      // Reajusta los textarea para su tamaño si es necesario
      autosize(document.querySelectorAll('textarea'));

      ajaxAwait(
        {
          api: 2,
          cliente_id: datalist['CLIENTE_ID'],
          turno_id: datalist['ID_TURNO']
        }, 'certificados_api', { callbackAfter: true }, false, function (data) {
          dataPaciente = data.response.data
          console.log(dataPaciente)

          // Valida quien es el medico actual del paciente, ya sea que no hay
          // guardado o sea el guardado quien esta trantando la interpretación
          if (true) {
            $('#Nom_medico').html(`${session['nombre']} ${session['apellidos']}`)
            $('#cedula').html(session['CEDULA'])
          } else {
            $('#Nom_medico').html(`${session['nombre']} ${session['apellidos']}`)
            $('#cedula').html(session['CEDULA'])
          }

          // colocar todos los datos faltantes
          // datosPaciente(datPaciente, config.cliente)

          resolve(1)
        })

    });
  });
}

//Click para entrar al modal dependiendo del boton
$(document).on('click', '#btn-carga_certificado', function () {
  $(`#${'MoldaCertificadoMaster'}`).modal('show')
})

