$('#fechaListadoAreaMaster').change(function () {
  console.log(1)
  recargarVistaLab();
})

$('#checkDiaAnalisis').click(function () {
  console.log(1)
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
    // fecha_busqueda: $('#fechaListadoAreaMaster').val(),
    area_id: areaActiva
  }

  if (fecha) dataListaPaciente['fecha_busqueda'] = $('#fechaListadoAreaMaster').val();

  tablaContenido.ajax.reload()
}


$("#btn-analisis-pdf").click(function () {
  if (dataSelect.array['select']) {
    // $("#ModalSubirInterpretacion").modal("show");
    chooseEstudio(selectEstudio.array, '#ModalSubirInterpretacion', 1)
  } else {
    alertSelectTable();
  }
});

$('#btn-capturas-pdf').click(function () {
  if (dataSelect.array['select']) {
    // $("#ModalSubirCapturas").modal("show");
    chooseEstudio(selectEstudio.array, '#ModalSubirCapturas', 2)
  } else {
    alertSelectTable();
  }
})

$('#btn-analisis-oftalmo').click(function () {
  if (dataSelect.array['select']) {

    $("#ModalSubirInterpretacionOftalmologia").modal("show");
  } else {
    alertSelectTable();
  }
})

$('#abrirModalResultados').click(function () {
  // alert('Si')
  autosize(document.querySelectorAll('textarea'))
  setTimeout(() => {
    autosize.update(document.querySelectorAll('textarea'));
  }, 200);
  $('#modalSubirInterpretacion').modal('show')
})

$('#btn-ver-reporte').click(function () {
  switch (areaActiva) {
    case 3: case '3':
      area_nombre = 'oftalmo'
      break;
    case 8: case 11: case '8': case '11':
      area_nombre = 'imagenologia'
      break;

    default:
      break;
  }

  api = encodeURIComponent(window.btoa(area_nombre));
  turno = encodeURIComponent(window.btoa(dataSelect.array['turno']));
  area = encodeURIComponent(window.btoa(areaActiva));


  window.open(http + servidor + "/nuevo_checkup/visualizar_reporte/?api=" + api + "&turno=" + turno + "&area=" + area, "_blank");
})

function chooseEstudio(row, modal, tip) {
  let html = '';

  console.log(row)
  switch (tip) {
    case 1:
      return false
      for (var i = 0; i < row.length; i++) {
        if (row[i]['INTERPRETACION'] == null) {
          html += `<button class="btn btn-cancelar" onClick = "estudioSeleccionado(` + row[i]['ID_SERVICIO'] + `, '` + modal + `')" type="button">` + row[i]['SERVICIO'] + `</button>`;
        }
      }
      if (html) {
        Swal.fire({
          html: '<h4>Seleccione el estudio a guardar</h4>' +
            '<div class="d-grid gap-2">' + html + '</div>',
          showCloseButton: true,
          showConfirmButton: false,
        });
      } else {
        alertSelectTable('Se han guardado todas sus interpretaciones')
      }
      break;
    case 2:
      for (var i = 0; i < row.length; i++) {
        if (row[i]['CAPTURAS'].length == 0) {
          html += `<button class="btn btn-cancelar" onClick = "estudioSeleccionado(` + row[i]['ID_SERVICIO'] + `, '` + modal + `', '` + row[i]['SERVICIO'] + `')" type="button">` + row[i]['SERVICIO'] + `</button>`;
        }
      }
      if (html) {
        Swal.fire({
          html: '<h4>Seleccione el estudio a capturar</h4>' +
            '<div class="d-grid gap-2">' + html + '</div>',
          showCloseButton: true,
          showConfirmButton: false,
        });
      } else {
        alertSelectTable('Se han guardado todas sus capturas', 'success')
      }
      break;
    default:

  }

}

function estudioSeleccionado(id, modal, serv) {
  selectEstudio.selectID = id;
  Swal.close();
  // console.log(selectEstudio.selectID)
  servicio_nombre = serv;
  $(modal).modal("show");
}