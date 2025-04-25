tablaContenido = $('#TablaContenidoResultados').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
  },
  lengthChange: false,
  // info: false,
  paging: false,
  scrollY: "55vh",
  scrollCollapse: true,
  ajax: {
    dataType: 'json',
    data: function (d) {
      return $.extend(d, dataListaPaciente);
    },
    method: 'POST',
    url: '../../../api/turnos_api.php',
    beforeSend: function () {
      loader("In"), limpiarCampos(), selectListaLab = null;
    },
    complete: function () {
      loader("Out")
    },
    dataSrc: 'response.data'
  },
  columns: [
    { data: 'COUNT' },
    { data: 'NOMBRE_COMPLETO' },
    { data: 'PREFOLIO' },
    { data: 'CLIENTE' },
    { data: 'SEGMENTO' },
    { data: 'turno' },
    { data: 'GENERO' },
    { data: 'EXPEDIENTE' },
    // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [
    { "width": "10px", "targets": 0 },
  ],

})

selectDatatable('TablaContenidoResultados', tablaContenido, 0, 0, 0, 0, function (selectTR = null, array = null) {
  let url;
  botonesResultados('desactivar')

  selectPacienteArea = array;

  if (selectTR === 1) {
    obtenerPanelInformacion(selectPacienteArea['ID_TURNO'], 'pacientes_api', 'paciente', '#panel-informacion', '_lab')
    if (areaActiva === 3) {
      url = 'oftalmologia_api';
      data = {
        turno_id: selectPacienteArea['ID_TURNO'],
        api: 3
      }
    } else {
      data = {
        api: 11,
        id_turno: selectPacienteArea['ID_TURNO'],
        id_area: areaActiva
      }
      url = 'servicios_api'
    }
    $.ajax({
      url: `${http}${servidor}/${appname}/api/${url}.php`,
      data: data,
      type: "POST",
      datatype: 'json',
      success: function (data) {
        data = jQuery.parseJSON(data)
        selectEstudio = new GuardarArreglo(data.response.data);
        panelResultadoPaciente(data.response.data);
        botonesResultados('activar', areaActiva)
      },
      complete: function () {

      }
    })
  } else {
    limpiarCampos()
  }
})

function limpiarCampos() {
  selectEstudio = new GuardarArreglo();
  botonesResultados('desactivar')
  obtenerPanelInformacion(0, 0, 'paciente')
  obtenerPanelInformacion(0, null, 'resultados-areaMaster', '#panel-resultadosMaster')
  $('#TablaContenidoResultados').removeClass('selected');
}

async function panelResultadoPaciente(row, area = areaActiva) {
  await obtenerPanelInformacion(1, null, 'resultados-areaMaster', '#panel-resultadosMaster')
  if (row['area_id'] == 3) {
    let html = '<hr> <div class="row" style="padding-left: 15px;padding-right: 15px;">' + +
      '<p style="padding-bottom: 10px">Of:</p>' + //'+row[i]['SERVICIO']+'
      '<div class="col-12 d-flex justify-content-center">' +
      '<a type="button"a target="_blank" class="btn btn-borrar me-2" href="' + row['url'] + '" style="margin-bottom:4px" id="btn-analisis-pdf">' +
      '<i class="bi bi-file-earmark-pdf"></i> Interpretación' +
      '</a>' +
      '</div>' +
      '</div> <hr>';
    $('#resultadosServicios-areas').append(html);
  } else {
    for (var i = 0; i < row.length; i++) {
      // console.log(row)
      if (row[i]['INTERPRETACION']) {
        let html = '<hr> <div class="row" style="padding-left: 15px;padding-right: 15px;">' +
          '<p style="padding-bottom: 10px">' + row[i]['SERVICIO'] + ':</p>' +
          '<p class="none-p">(' + formatoFecha2(row[i]['FECHA_INTERPRETACION']) + '):<br> ' + row[i]['COMENTARIOS'] + '</p>' +
          '<div class="col-7 d-flex justify-content-center">' +
          '<a type="button"a target="_blank" class="btn btn-borrar me-2" href="' + row[i]['INTERPRETACION'] + '" style="margin-bottom:4px">' +
          '<i class="bi bi-file-earmark-pdf"></i> Interpretación' +
          '</a>' +
          '</div>';
        if (row[i]['IMAGENES'].length > 0) {
          html += '<div class="col-5 d-flex justify-content-center">' +
            '<button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#CapturasdeArea" style="margin-bottom:4px">' +
            '<i class="bi bi-images"></i> Capturas' +
            '</button>' +
            '</div>';
        }
        html += '</div> <hr>';
        $('#resultadosServicios-areas').append(html);
      }
    }
  }

}

function botonesResultados(estilo) {
  switch (estilo) {
    case 'desactivar':
      $('#btn-analisis-pdf').prop('disabled', true)
      $('#btn-capturas-pdf').prop('disabled', true)
      break;
    case 'activar':
      $('#btn-analisis-pdf').prop('disabled', false)
      $('#btn-capturas-pdf').prop('disabled', false)
      break;
    default:

  }
}

// selectDatatable("TablaContenidoResultados", tablaContenido, 1, "pacientes_api", 'paciente')