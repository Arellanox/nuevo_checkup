tablaListaPaciente = $('#TablaLaboratorio').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
  },
  lengthChange: false,
  info: false,
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
      loader("In")
    },
    complete: function () {
      loader("Out")
      loaderDiv("Out", null, "#loader-Lab", '#loaderDivLab', 0);
      $('.informacion-labo').fadeOut()
    },
    dataSrc: 'response.data'
  },
  createdRow: function (row, data, dataIndex) {
    if (data.CONFIRMADO == 1) {
      $(row).addClass('bg-success text-white');
    } else {
      $(row).addClass('bg-warning');
    }
  },
  columns: [{
      data: 'ID_PACIENTE',
      render: function (data) {
        return '';
      }
    },
    {
      data: 'NOMBRE_COMPLETO'
    },
    {
      data: 'PREFOLIO',
      render: function (data, type, full, meta) {
        return "20221014JMC412";
      },
    },
    {
      data: 'EDAD'
    },
    {
      data: 'EDAD'
    },
    // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [{
    "width": "10px",
    "targets": 0
  }, ],

})
loaderDiv("Out", null, "#loader-Lab", '#loaderDivLab');

selectDatatable('TablaLaboratorio', tablaListaPaciente, 0, 0, 0, 0, function (selectTR = null, array = null) {
  selectListaLab = array;
  if (selectTR == 1) {
    getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab', selectListaLab, 'In', async function (divClass) {
      await obtenerPanelInformacion(selectListaLab['ID_PACIENTE'], 'pacientes_api', 'paciente_lab')
      await generarHistorialResultados(selectListaLab['ID_PACIENTE'])
      await generarFormularioPaciente(selectListaLab['ID_TURNO'])

      if (selectListaLab.CONFIRMADO == 1) {
        $('button[type="submit"][form="formAnalisisLaboratorio"]').prop('disabled', true)
        $('#formAnalisisLaboratorio :input').prop('disabled', true)
      } else {
        $('button[type="submit"][form="formAnalisisLaboratorio"]').prop('disabled', false)
        $('#formAnalisisLaboratorio :input').prop('disabled', false)
      }


      bugGetPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab')

    });
    // getPanelLab('In', selectListaLab['ID_TURNO'], selectListaLab['ID_PACIENTE'])
  } else {
    // console.log('rechazado')
    getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab', selectListaLab, 'Out')
    // getPanelLab('Out', 0, 0)
  }
})

$("#BuscarTablaListaLaboratorio").keyup(function () {
  tablaListaPaciente.search($(this).val()).draw();
});

function generarHistorialResultados(id) {
  return new Promise(resolve => {
    // $('#accordionResultadosAnteriores').html('')
    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/turnos_api.php",
      type: "POST",
      dataType: 'json',
      data: {
        id_paciente: id,
        api: 6,
        id_area: 6
      },
      success: function (data) {
        row = data.response.data;
        console.log("Haciendo el historial de resultados")
        console.log(data.response.data)
        console.log(row)
        let itemStart = '<div class="accordion-item bg-acordion">';
        let itemEnd = '</div>';

        let bodyStart = '<div class="accordion-body">' +
          '<div class="row">';
        let bodyEnd = '</div>' +
          '</div>';
        let html = '';

        for (var i = 0; i < row.length; i++) {
          html += itemStart;
          html += '<h2 class="accordion-header" id="collap-historial-estudios' + i + '">' +
            '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-estudio' + i + '-Target" aria-expanded="false" aria-controls="accordionEstudios">' +
            '<div class="row">' +
            '<div class="col-12">' +
            '<i class="bi bi-box-seam"></i> &nbsp;&nbsp;&nbsp; Cargado: <strong>' + row[i]['NOMBRE_COMPLETO'] + '</strong>' +
            '</div>' +
            '<div class="col-12">' +
            '<i class="bi bi-calendar3"></i> &nbsp;&nbsp;&nbsp; Fecha: <strong>' + formatoFecha2(row[i]['FECHA_CONFIRMADO']) + '</strong> ' + //<strong>12:00 '+i+'</strong>
            '</div>' +
            '</div>' +
            '</button>' +
            '</h2>' +
            '<div id="collapse-estudio' + i + '-Target" class="accordion-collapse collapse overflow-auto" aria-labelledby="collap-historial-estudios' + i + '" style="max-height: 70vh"> ';
          html += '<p class="none-p" style="margin: 12px 0px 0px 15px;">Ver <a href="' + row[i]['servicios']['URL'] + '">RESULTADO</a> aquí</p>';
          html += bodyStart;
          for (var l = 0; l < row[i]['servicios'].length; l++) {
            html += '<div class="col-8 text-start info-detalle"><p>' + row[i]['servicios'][l]['SERVICIO'] + ':</p></div><div class="col-4 text-start d-flex align-items-center">' + row[i]['servicios'][l]['RESULTADO'] + ' ' + row[i]['servicios'][l]['MEDIDA_ABREVIATURA'] + '</div> <hr style="margin: 3px"/>'; //
          }
          html += bodyEnd + '</div>';
          html += itemEnd;
        }
        $('#accordionResultadosAnteriores').html(html);

      },
      complete: function () {
        resolve(1);
      }
    });
  });
}

function generarFormularioPaciente(id) {
  return new Promise(resolve => {
    // $('#accordionResultadosAnteriores').html('')
    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/turnos_api.php",
      type: "POST",
      dataType: 'json',
      data: {
        id_turno: id,
        api: 8,
        id_area: 6,
        tipo: 1
      },
      success: function (data) {
        data = data.response.data;

        let colStart = '<div class="col-auto col-lg-6">';
        let endDiv = '</div>';
        let colreStart = '<div class="col-auto col-lg-6 d-flex justify-content-end align-items-center">';
        let html = '';

        // <ul class = "list-group m-4 overflow-auto hover-list info-detalle"
        // style = "max-width: 100%; max-height: 70vh;margin-bottom:10px;"
        // id = "list-group-form-resultado-laboro" >

        //   </ul>

        for (var i = 0; i < data.length; i++) {
          console.log('FOR')
          let row = data[i]
          // console.log(row)
          var count = Object.keys(row).length;
          console.log(count);
          html += '<ul class = "list-group card hover-list info-detalle" style="margin: 15px;padding: 15px;" >';
          html += '<h4 style="border-radius: 8px;font-size: 20px !important;font-weight: 600 !important;background: rgb(0 0 0 / 5%);width: 100%;padding: 10px 0px 10px 0px;text-align: center;"">' + row['NombreGrupo'] + '</h4>';
          for (var k in row) {
            console.log(k, row[k])
            if (Number.isInteger(parseInt(k))) {
              // console.log(2)
              html += '<li class="list-group-item">';
              html += '<div class="row d-flex align-items-center">';
              html += colStart;
              html += '<p><i class="bi bi-box-arrow-in-right" style=""></i> ' + row[k]['DESCRIPCION_SERVICIO'] + '</p>';
              html += endDiv;
              html += colreStart;
              html += '<div class="input-group">';

              //Formulario
              if (row[k]['RESULTADO'] == null) {
                html += '<input type="number" step="0.000000000000000001" class="form-control input-form text-end" name="servicios[' + row[k]['ID_SERVICIO'] + '][RESULTADO]" required autocomplete="off">';
              } else {
                html += '<input type="number" step="0.000000000000000001" class="form-control input-form text-end" name="servicios[' + row[k]['ID_SERVICIO'] + '][RESULTADO]" required value="' + row[k]['RESULTADO'] + '" autocomplete="off">';
              }

              if (row[k]['MEDIDA']) {
                if ((row[k]['TIENE_VALOR_ABSOLUTO'] == 1)) {
                  html += '<span class="input-span">%</span>';
                } else {
                  html += '<span class="input-span">' + row[k]['MEDIDA'] + '</span>';
                }
              }

              html += '</div>';
              html += endDiv;

              //Valor Absoluto
              if (row[k]['TIENE_VALOR_ABSOLUTO'] == 1) {
                html += colStart;
                html += '<p  style="padding-left: 40px;"><i class="bi bi-box-arrow-in-right"></i> Valor absoluto</p>';
                html += endDiv;
                html += colreStart;
                html += '<div class="input-group">';
                if (row[k]['RESULTADO'] == null) {
                  html += '<input type="number" step="0.000000000000000001" class="form-control input-form text-end" name="servicios[' + row[k]['ID_SERVICIO'] + '][VALOR]" required autocomplete="off">';
                } else {
                  html += '<input type="number" step="0.000000000000000001" class="form-control input-form text-end" name="servicios[' + row[k]['ID_SERVICIO'] + '][VALOR]" required value="' + row[k]['VALOR_ABSOLUTO'] + '" autocomplete="off">';
                }
                if (row[k]['MEDIDA']) {
                  html += '<span class="input-span">' + row[k]['MEDIDA'] + '</span>';
                }
                html += '</div>';
                html += endDiv;
              }
              html += endDiv;
              html += '</li>';

              if (row[k]['LLEVA_COMENTARIO'] == true) {
                if (row[k]['OBSERVACIONES'] == null) {
                  row[k]['OBSERVACIONES'] = '';
                }
                html += '<div class="d-flex justify-content-center"><div style="padding-top: 15px;">' +
                  '<p style = "/* font-size: 18px; */" > Observaciones:</p>' +
                  '<textarea name="observacionesServicios[' + row[k]['ID_SERVICIO'] + ']" rows="2;" cols="90" class="input-form" value="">' + row[k]['OBSERVACIONES'] + '</textarea></div ></div > ';

              }
            }

          }
          if (row['ID_GRUPO'] != null) {
            if (row['OBSERVACIONES'] == null) {
              row['OBSERVACIONES'] = '';
            }
            html += '<div class="d-flex justify-content-center"><div style="padding-top: 15px;">' +
              '<p style = "/* font-size: 18px; */" > Observaciones:</p>' +
              '<textarea name="observacionesGrupos[' + row['ID_GRUPO'] + ']" rows="2;" cols="90" class="input-form">' + row['OBSERVACIONES'] + '</textarea></div ></div > ';
          }
          html += '</ul>';

          // idsEstudios.push[data[i]['ID_SERVICIO']]
        }
        $('#formulario-estudios').html(html)
      },
      complete: function () {
        resolve(1);
      }
    });
  });
}