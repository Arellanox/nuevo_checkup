
const ModalSubirCapturas = document.getElementById('ModalSubirCapturas')
ModalSubirCapturas.addEventListener('show.bs.modal', event => {
  // console.log(selectListaLab)
  $('#Area-estudio').html(hash)
  $('#nombre-paciente-capturas').val(selectListaLab['NOMBRE_COMPLETO'])
})

//Formulario Para Subir Interpretacion
$("#formSubirCapturas").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formSubirCapturas");
  var formData = new FormData(form);
    formData.set('id_cliente',array_selected['ID_CLIENTE'])
    formData.set('api', 3);
  Swal.fire({
    title: "¿Está seguro de subir la interpretación?",
    text: "¡No podrá cambiar el resultado!",
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
        url: '??',
        url: "../../../api/turnos_api.php",
        type: "POST",
        processData: false,
        contentType: false,
        success: function (data) {
          data = jQuery.parseJSON(data);
          if (mensajeAjax(data)) {
            Toast.fire({
              icon: "success",
              title: "¡Interpretación guardada!",
              timer: 2000,
            });
            document.getElementById("formSubirCapturas").reset();
            $("#ModalSubirCapturas").modal("hide");
            // tablaContacto.ajax.reload();
          }
        },
      });
    }
  });
  event.preventDefault();
});
