const ModalActualizarCliente = document.getElementById("ModalActualizarCliente");
ModalActualizarCliente.addEventListener("show.bs.modal", (event) => {

});

//Formulario de Preregistro
$("#formActualizarCliente").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formActualizarCliente");
  var formData = new FormData(form);
  formData.set('status',null)
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
        url: "../../../api/clientes_api.php",
        type: "POST",
        processData: false,
        contentType: false,
        success: function (data) {
          data = jQuery.parseJSON(data);
          if (mensajeAjax(data)) {
            Toast.fire({
              icon: "success",
              title: "Datos de Cliente Actualizados Correctamente!",
              timer: 2000,
            });
            document.getElementById("formActualizarCliente").reset();
            $("#ModalActualizarCliente").modal("hide");
            tablaEquipo.ajax.reload();
          }
        },
      });
    }
  });
  event.preventDefault();
});
