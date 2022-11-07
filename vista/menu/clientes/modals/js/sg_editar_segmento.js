const ModalEditarSegmentos = document.getElementById("ModalEditarSegmentos");
ModalEditarSegmentos.addEventListener("show.bs.modal", (event) => {
  document.getElementById("formEditarSegmento").reset();
  datosEditarSegmentos();
});

async function datosEditarSegmentos(){
  await rellenarSelect('#selectSegmentos_editar', 'segmentos_api', 2, 'ID_SEGMENTO', 'DESCRIPCION', {cliente_id: array_selected["ID_CLIENTE"]})
  $("#nombre_segmento_editar").val(selectSegmento["DESCRIPCION"]);
  // console.log(selectSegmento);
  if (selectSegmento['PADRE'] == null) {
    $('#selectSegmentos_editar').val(0)
    $('#selectSegmentos_editar').prop('disabled', true);
    $('#checkSegmentoPadre_editar').prop('checked', true);
  }else{
    // $('#selectSegmentos_editar').val($("#selectSegmentos_editar option:first").val());
    $('#selectSegmentos_editar').prop('disabled', false);
    $("#selectSegmentos_editar").val(selectSegmento['PADRE']);
    $('#checkSegmentoPadre_editar').prop('checked', false);
  }
  // $("#selectSegmentos_editar").val(selectSegmento["ID_SEGMENTO"]); #Falta recibir correctamente los segmentos
}

//Formulario de Preregistro
$("#formEditarSegmento").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formEditarSegmento");
  var formData = new FormData(form);
  formData.set('id_segmento',selectSegmento['ID_SEGMENTO']);
    formData.set('api', 3);
  Swal.fire({
    title: "¿Está seguro que todos los datos están correctos?",
    text: "¡Verifique los Nuevos datos antes de continuar!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Aceptar",
  }).then((result) => {
    if (result.isConfirmed) {
      // $('#submit-registrarEstudio').prop('disabled', true);
      // Esto va dentro del AJAX

      $.ajax({
        data: formData,
        url: "../../../api/segmentos_api.php",
        type: "POST",
        processData: false,
        contentType: false,
        success: function (data) {
          data = jQuery.parseJSON(data);
          if (mensajeAjax(data)) {
            Toast.fire({
              icon: "success",
              title: "Segmento Actualizado Correctamente!",
              timer: 2000,
            });
            document.getElementById("formEditarSegmento").reset();
            $("#ModalEditarSegmentos").modal("hide");
            tablaSegmentos.ajax.reload();
          }
        },
      });
    }
  });
  event.preventDefault();
});

$('#checkSegmentoPadre_editar').change(function(){
  if($(this).is(":checked")) {
    $('#selectSegmentos_editar').val(0)
    $('#selectSegmentos_editar').prop('disabled', true);
  }else{
    $('#selectSegmentos_editar').val($("#selectSegmentos_editar option:first").val());
    $('#selectSegmentos_editar').prop('disabled', false);
  }
})
