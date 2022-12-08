const modalEditarEstudio = document.getElementById("modalEditarEstudio");
modalEditarEstudio.addEventListener("show.bs.modal", (event) => {
  cargarDatosEstuEdit();
});

async function cargarDatosEstuEdit() {
  $('#formEditarEstudio').trigger("reset");
  await rellenarSelect("#edit-grupo-estudio", 'servicios_api', 7, 0, 'DESCRIPCION');
  // await rellenarSelect("#edit-area-estudio", "areas_api", 2,0,2);
  await rellenarSelect('#edit-clasificacion-estudio', 'laboratorio_clasificacion_api', 2, 0, 1);
  await rellenarSelect('#edit-metodos-estudio', 'laboratorio_metodos_api', 2, 0, 1);
  await rellenarSelect("#edit-medidas-estudio", "laboratorio_medidas_api", 2, 0, 1);
  if (await rellenarSelect("#edit-concepto-facturacion", "sat_catalogo_api", 2, 0, 'COMPLETO')) {

    // $('#edit-clasificacion-estudio').val(null).trigger('change');
    $('#edit-nombre-estudio').val(array_selected['DESCRIPCION']);
    $('#edit-cve-estudio').val(array_selected['ABREVIATURA']);
    // $('#').val(array_selected['PADRE']).trigger('change');
    console.log(array_selected['DETALLE_GRUPOS'])
    for (var i = 0; i < array_selected['DETALLE_GRUPOS'].length; i++) {
      padre = new Array()
      padre[i] = array_selected['DETALLE_GRUPOS'][i]['ID_SERVICIO']
    }

    $("#edit-grupo-estudio").val(padre).trigger('change');

    $('#edit-area-estudio').val(array_selected['ID_AREA']).trigger('change');
    $('#edit-clasificacion-estudio').val(array_selected['ID_CLASIFICACION']).trigger('change');
    $('#edit-medidas-estudio').val(array_selected['ID_MEDIDA']).trigger('change');
    $('#edit-dias-estudio').val(array_selected['DIAS_DE_ENTREGA']);
    $('#edit-concepto-facturacion').val(array_selected['SAT_ID_CODIGO']).trigger('change');
    $('#edit-indicaciones-estudio').val(array_selected['INDICACIONES']);

    // Check Valor referencia
    if (array_selected['MUESTRA_VALORES_REFERENCIA'] == 1) {
      $('#edit-checkValSi-estudio').attr('checked', true);
    } else {
      $('#edit-checkValNo-estudio').attr('checked', true);
    }
    // Check Subroga
    if (array_selected['LOCAL'] == 1) {
      $('#edit-checkRogSi-estudio').attr('checked', true);
    } else {
      $('#edit-checkRogNo-estudio').attr('checked', true);
    }
  }
}

//Formulario de Preregistro
$("#formEditarEstudio").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formEditarEstudio");
  var formData = new FormData(form);
  var padre = formData.get("grupo");
  formData.delete("grupo");
  formData.set("padre", padre);
  formData.set("grupos", 0);
  formData.set("producto", 1);
  formData.set("seleccionable", null);
  formData.set("para", 3);
  formData.set("costos", null);
  formData.set("utilidad", null);
  formData.set("venta", null);
  formData.set("id", array_selected['ID_SERVICIO']);
  formData.set("api", 4);

  Swal.fire({
    title: "¿Está seguro que todos los datos están correctos?",
    text: "Verifique la nueva información antes de actualizar",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      //$("#btn-registrarse").prop('disabled', true);
      $.ajax({
        data: formData,
        url: "../../../api/servicios_api.php",
        type: "POST",
        processData: false,
        contentType: false,
        success: function (data) {
          data = jQuery.parseJSON(data);
          if (mensajeAjax(data)) {
            Toast.fire({
              icon: "success",
              title: "¡Estudio registrado!",
              timer: 2000,
            });
            document.getElementById("formEditarEstudio").reset();
            $('##div-select-contenedores-edit').empty();
            $("#modalEditarEstudio").modal("hide");
            tablaServicio.ajax.reload();
          }
        },
      });
    }
  });
  event.preventDefault();
});

// Nuevo contenedores
$('#nuevo-contenedor-edit').on('click', function () {
  alert("ajsbdj");
  numberContenedorEdit += 1;
  agregarContenedorMuestra('#div-select-contenedores-edit', numberContenedorEdit, 2);
})

$(document).on('click', '.eliminarContenerMuestra2', function () {
  var parent_element = $(this).closest("div[class='row']");
  // console.log(parent_element)
  // numberContenedor -= 1;
  parent_element.remove();
});



select2("#edit-clasificacion-estudio", "modalEditarEstudio");
select2("#edit-metodos-estudio", "modalEditarEstudio");
select2("#edit-medidas-estudio", "modalEditarEstudio");
select2("#edit-concepto-facturacion", "modalEditarEstudio");
select2("#edit-grupo-estudio", "modalEditarEstudio");
select2("#edit-area-estudio", "modalEditarEstudio");