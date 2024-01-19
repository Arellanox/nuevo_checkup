
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
  console.log(fecha)
  dataListaPaciente['fecha_busqueda'] = null
  if (fecha) dataListaPaciente['fecha_busqueda'] = $('#fechaListadoAreaMaster').val();

  TablaContenidoPaciCertificados.ajax.reload()
}




//Mapeo de la procedencia de los botones
let btnProcedencia = {
  1: {
    // ID de particular
    1: {
      cualquiera: 'particular_ambos',
      formulario: 'form_particular.html'
    },
    // ID de SLB
    16: {
      MASCULINO: 'slb_masculino', //MASCULINO menor a 40
      FEMENINO: 'slb_femenino', //FEMENINO menor a 40
      VEJEZ: 'slb_vejez', //Persona mayor a 40
      formulario: 'form_slb.html', // Formulario a elegir de SLb
    },
    // ID de VINCO
    27: {
      cualquiera: 'vinco_general',
      formulario: 'form_vinco_general.html'
    },
    // ID de Expro
    22: {
      cualquiera: 'expro_general',
      formulario: 'form_expro_general.html'
    }
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
    console.log(pdf_format, cliente_certificado, config.cliente);
    let form_html = ifnull(pdf_format, 'form_particular.html', ['formulario']);

    switch (cliente_certificado) {
      case 'SLB':
        pdf_format = pdf_format[tipo_format]; // Obtiene el formato a utilizar de SLB 
        break;

      default:
        pdf_format = ifnull(pdf_format, 'particular_ambos', ['cualquiera']) // Obtener el formato a utilizar de cualquiera
        break;
    }

    // 
    $(`#${'cliente_certificado'}`).html(pdf_format == 'particular_ambos' ? 'PARTICULAR' : config.cliente_label);

    // Reinicia el formulario cada vez
    $(`#${'cuerpo_certificado_form'}`).html(''); // Limpiar el cuerpo de HTML
    $.post(`modals/formularios/${form_html}`, function (html) {
      $(`#${'cuerpo_certificado_form'}`).html(html);
    }).done(() => {
      // El codigo sigue si se necesita crear mas cosas o validar mas cosas
      // En cierto caso puede usarse un case

      // Reajusta los textarea para su tamaño si es necesario
      autosize(document.querySelectorAll('textarea'));
      if (certificado_tipo.certificacion == 'POE')
        $('#consultar-caratula-actual').fadeOut();
      ajaxAwait(
        {
          api: 2,
          cliente_id: datalist['CLIENTE_ID'],
          turno_id: datalist['ID_TURNO'],
          tipo_certificado: pdf_format
        }, 'certificados_api', { callbackAfter: true }, false, function (data) {
          dataPaciente = data.response.data

          if (ifnull(dataPaciente[0], false, ['CUERPO'])) {
            setFormData('cuerpo_certificado_form', { 'cuerpo': dataPaciente[0]['CUERPO'] })
          }
          // Cambia el estado del formulario

          // Valida quien es el medico actual del paciente, ya sea que no hay
          // guardado o sea el guardado quien esta trantando la interpretación
          // console.log(dataPaciente[0]);
          dataSelect.array['url_reporte'] = dataPaciente[0]['RUTA_REPORTE'];


          if (certificado_tipo.certificacion == 'POE') {
            $('#consultar-caratula-actual').attr('data-url', dataPaciente[0]['RUTA_REPORTE']);
            $('#consultar-caratula-actual').attr('data-nombre-pdf', dataPaciente[0]['ARCHIVO_CARATULA']);
            $('#consultar-caratula-actual').fadeIn();
          }
          informacionMedica(dataPaciente);
          resolve(1)
        })

    });
  });
}

//Click para entrar al modal dependiendo del boton
$(document).on('click', '#btn-carga_certificado', function () {
  $(`#${'MoldaCertificadoMaster'}`).modal('show')
})

$(document).on('click', '#btn-caratulaPoe', function () {

  let api = encodeURIComponent(window.btoa('caratula_poe'));
  let turno = encodeURIComponent(window.btoa(dataSelect.array['turno']));
  let area = encodeURIComponent(window.btoa('-5'));
  let preview = encodeURIComponent(window.btoa('poe_general'));

  let url = `${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${turno}&area=${area}&preview=${preview}`;

  window.open(url, "_blank");
});



// Función para establecer los valores en el formulario
function setFormData(formId, data, path = '') {
  const form = document.getElementById(formId);
  if (!form) {
    console.error('Formulario no encontrado');
    return;
  }

  // Limpia el formulario
  // limpiarForm(formId);

  let log_error = false;
  // Recorre cada entrada de datos
  Object.entries(data).forEach(([key, value]) => {
    // Construye el path del input
    const newPath = path ? `${path}[${key}]` : key;
    if (typeof value === 'object' && value !== null && !Array.isArray(value)) {
      // Si es un objeto no nulo y no es un array, continua la recursión
      setFormData(formId, value, newPath);
    } else {
      // Si no es un objeto (es decir, un valor concreto), establece el valor del input
      const inputName = newPath; // Usa el path construido
      const input = form.querySelector(`[name='${inputName}']`);
      if (input) {
        switch (input.type) {
          case 'textarea':
          case 'text':
          case 'date':
          case 'select-one':
            // Establece el valor del input
            input.value = value;
            break;
          default:

            if (input.type === 'radio' || input.type === 'checkbox') {
              // Busca el input específico que tenga el valor correspondiente
              const specificInput = form.querySelector(`[name='${inputName}'][value='${value}']`);
              if (specificInput) {
                specificInput.checked = true;
              } else {
                console.error('No se encontró el input de tipo ' + input.type + ' con el valor ' + value);
              }
            }
        }
      } else {
        console.error('Input no encontrado con el nombre:', inputName);
        log_error = true
      }
    }
  });

  if (log_error)
    alertToast('Algunos campos no fueron encontrados', 'info', 4000);
}



// Descargar Caratula del certificado POE
function btnPoe() {
  return `

  `;
}

function certificadosPoe(config = { turno: '', api: '', area: '-5', preview: '', tipo: '' }) {
  return new Promise((resolve, reject) => {
    if (config.tipo === 1) return;
    // Div padre
    let div = $('#divPoe');
    // Obtnemos el boton para mostrar la caratula del certificado poe
    let btn = btnPoe();
    // Renderizamos el boton dentro del contendor padre
    div.html(btn);




    resolve(1)
  })
}
