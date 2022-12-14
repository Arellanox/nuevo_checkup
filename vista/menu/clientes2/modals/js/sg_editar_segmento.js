const ModalEditarSegmentos = document.getElementById("ModalEditarSegmentos");
ModalEditarSegmentos.addEventListener("show.bs.modal", (event) => {

  console.log(selectSegmento)

  $("#descripcion_segmento").val(selectSegmento["DESCRIPCION"]);
  $("#nombre_segmento_editar").val(selectSegmento["ID_SEGMENTO"]);



});

//Formulario de Preregistro
$("#formEditarSegmento").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formEditarSegmento");
  var formData = new FormData(form);
  formData.set('id',selectSegmento['ID_SEGMENTO']);
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
            $("#ModalEditarSegmento").modal("hide");
            tablaClientes.ajax.reload();
          }
        },
      });
    }
  });
  event.preventDefault();
});
