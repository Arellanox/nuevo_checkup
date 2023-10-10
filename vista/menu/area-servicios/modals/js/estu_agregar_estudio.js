const ModalRegistrarEstudio = document.getElementById("ModalRegistrarEstudio");
ModalRegistrarEstudio.addEventListener("show.bs.modal", (event) => {

  setTimeout(() => {
    if (areaActiva != 'todos') {
      $('#cont-area-estudios').fadeOut(0);
    } else {
      $('#cont-area-estudios').fadeIn(0);
    }
  }, 150);
})


async function getDataFirst(row) {
  $('#formEstudios')[0].reset();
  await rellenarSelect("#registrar-area-estudio", "areas_api", 2, 0, 2);
  await rellenarSelect('#registrar-concepto-facturacion', 'sat_catalogo_api', 2, 0, 'COMPLETO');
  if (row) {
    id_servicio = row['ID_SERVICIO']
    console.log('despues del if de row')
    console.log(row)
    $('#formEstudios input[name="descripcion"]').val(row['DESCRIPCION']);
    $('#formEstudios input[name="abreviatura"]').val(row['ABREVIATURA']);
    $('#formEstudios select[name="area"]').val(row['ID_AREA']).change();
    $('#formEstudios input[name="dias_entrega"]').val(row['DIAS_DE_ENTREGA']);
    $('#formEstudios input[name="seleccionable"]').val(row['SELECCIONABLE']);
    $('#formEstudios input[name="duracion"]').val(row['MINUTOS']);
    $('#registrar-concepto-facturacion').val(row['SAT_ID_CODIGO']).change();
    $('#formEstudios input[name="es_para"]').val(row['ES_PARA']);
    $('#formEstudios textarea[name="indicaciones"]').val(row['INDICACIONES']);

    $('#ModalRegistrarEstudio').modal('show');
  } else {
    id_servicio = '';
    $('#ModalRegistrarEstudio').modal('show');
    $('#btn-agregar-estudio').prop('disabled', false);
    $('#btn-estudio-editar').prop('disabled', false);

  }
}

let id_servicio = '';

$(document).on('submit', '#formEstudios', function (event) {
  event.preventDefault();

  alertMensajeConfirm({
    title: '¿Desea guardar este estudios?',
    text: 'Asegúrese que todos los datos sean correctos',
    icon: 'info',
  }, function () {
    dataJson = {
      api: 1,
      id_area: areaActiva,
      producto: 1, local: 1, es_grupo: 0, es_producto: 0
    }

    if (areaActiva == 'todos') {
      dataJson['area'] = $('#cont-area-estudios').val();
    }

    if (id_servicio)
      dataJson['id_servicio'] = id_servicio

    ajaxAwaitFormData(dataJson, 'servicios_api', 'formEstudios', { callbackAfter: true }, false, function (row) {
      alertToast('¡Estudio cargado con exito!', 'success', 5000);
      $('#ModalRegistrarEstudio').modal('hide');
      $('#formEstudios')[0].reset();
      tablaServicio.ajax.reload()
      // $('#contenido-form-estudios').html(htmlBodyFormEstudios);
    })
  }, 1)

  event.preventDefault();
})


select2("#registrar-concepto-facturacion", "ModalRegistrarEstudio");
select2("#registrar-area-estudio", "ModalRegistrarEstudio");
