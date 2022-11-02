const ModalRegistrarSegmentos = document.getElementById("ModalRegistrarSegmentos");
ModalRegistrarSegmentos.addEventListener("show.bs.modal", (event) => {
  rellenarSelect('#selectSegmentos', 'segmentos_api', 2, 'ID_SEGMENTO', 'DESCRIPCION', {cliente_id: array_selected["ID_CLIENTE"]})
});

//Formulario de Preregistro
$("#formRegistrarSegmento").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formRegistrarSegmento");
  var formData = new FormData(form);
  if($('#selectSegmentos').is(":checked")) {
     formData.delete('padre')
  }
  formData.set("cliente_id", array_selected["ID_CLIENTE"]);
  formData.set("api", 1);
  Swal.fire({
    title: "¿Está seguro que todos los datos están correctos?",
    text: "¡Verifique los Datos Antes de Continuar!",
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
              title: "Segmento Registrado Correctamente!",
              timer: 2000,
            });
            document.getElementById("formRegistrarSegmento").reset();
            $("#ModalRegistrarSegmentos").modal("hide");
            tablaSegmentos.ajax.reload();
          }
        },
      });
    }
  });
  event.preventDefault();
});

$('#checkSegmentoPadre').change(function(){
  if($(this).is(":checked")) {
     $('#selectSegmentos').prop('disabled', true);
  }else{
     $('#selectSegmentos').prop('disabled', false);
  }
})
