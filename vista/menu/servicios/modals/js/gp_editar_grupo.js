const ModalEditarGrupo = document.getElementById("ModalEditarGrupo");
ModalEditarGrupo.addEventListener("show.bs.modal", (event) => {
  cargarDatosGrupoEdit();
});

async function cargarDatosGrupoEdit() {
  await rellenarSelect('#edit-clasificacion-grupo', 'laboratorio_clasificacion_api', 2, 0, 1);
  await rellenarSelect('#edit-metodos-grupo', 'laboratorio_metodos_api', 2, 0, 1);
  await rellenarSelect('#edit-medidas-grupo', 'laboratorio_medidas_api', 2, 0, 1);
  await rellenarSelect('#edit-area-grupo', 'areas_api', 2, 0, 2);


  if (await rellenarSelect('#edit-concepto-facturacion-grupo', 'sat_catalogo_api', 2, 0, 'COMPLETO')) {
    // console.log(array_selected)

    $('#edit-clasificacion-grupo').val(null).trigger('change');
    $('#edit-nombre-grupo').val(array_selected['DESCRIPCION']);
    $('#edit-cve-grupo').val(array_selected['ABREVIATURA']);
    $('#edit-grupo-grupo').val(array_selected['PADRE']).trigger('change');
    $('#edit-area-grupo').val(array_selected['ID_AREA']).trigger('change');
    $('#edit-clasificacion-grupo').val(array_selected['ID_CLASIFICACION']).trigger('change');
    $('#edit-medidas-grupo').val(array_selected['ID_MEDIDA']).trigger('change');
    $('#edit-dias-grupo').val(array_selected['DIAS_DE_ENTREGA']);
    $('#edit-concepto-facturacion-grupo').val(array_selected['SAT_ID_CODIGO']).trigger('change');
    $('#edit-indicaciones-grupo').val(array_selected['INDICACIONES']);

    if (array_selected['MUESTRA_VALORES_REFERENCIA'] == 1) {
      $('#edit-checkValSi-grupo').attr('checked', true);
    } else {
      $('#edit-checkValNo-grupo').attr('checked', true);
    }
    // Check Subroga
    if (array_selected['LOCAL'] == 1) {
      $('#edit-checkRogSi-grupo').attr('checked', true);
    } else {
      $('#edit-checkRogNo-grupo').attr('checked', true);
    }
  }
}

//Formulario de Preregistro
$("#formEditarGrupo").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formEditarGrupo");
  var formData = new FormData(form);
  formData.set("padre", null);
  formData.set("grupos", 1);
  formData.set("producto", 1);
  formData.set("seleccionable", null);
  formData.set("para", 3);
  formData.set("costos", null);
  formData.set("utilidad", null);
  formData.set("venta", null);
  formData.set("id", array_selected[0]);
  formData.set("api", 4);

  Swal.fire({
    title: "¿Está seguro que todos los datos están correctos?",
    text: "Verifique la Informacion antes de Continuar!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      // $('#submit-registrarEstudio').prop('disabled', true);
      // Esto va dentro del AJAX
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
              title: "¡Estudio Actualizado Correctamente!",
              timer: 2000,
            });
            document.getElementById("formEditarGrupo").reset();
            $('#div-select-contenedoresGrupoEdit').empty();
            $("#ModalEditarGrupo").modal("hide");
            tablaGrupos.ajax.reload();
          }
        },
      });
    }
  });
  event.preventDefault();
});

// Nuevo contenedores
$('#nuevo-contenedorGrupoEdit').on('click', function () {
  numberContenedorGrupo += 1;
  agregarContenedorMuestra('#div-select-contenedoresGrupoEdit', numberContenedorGrupo, 2);
})

$(document).on('click', '.eliminarContenerMuestra2', function () {
  var parent_element = $(this).closest("div[class='row']");
  // console.log(parent_element)
  // numberContenedor -= 1;
  parent_element.remove();
});

select2("#edit-area-grupo", "ModalEditarGrupo");
select2("#edit-metodos-grupo", "ModalEditarGrupo");
select2("#edit-medidas-grupo", "ModalEditarGrupo");
select2("#edit-concepto-facturacion-grupo", "ModalEditarGrupo");
select2("#edit-clasificacion-grupo", "ModalEditarGrupo");
select2("#edit-area-estudio", "ModalEditarGrupo");
