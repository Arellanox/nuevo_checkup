
//Formulario de Preregistro
$("#formRegistrarCliente").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formRegistrarCliente");
  var formData = new FormData(form);
  formData.set('api', 1);
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
              title: "Cliente agregado Correctamente!",
              timer: 2000,
            });
            document.getElementById("formRegistrarCliente").reset();
            $("#ModalRegistrarCliente").modal("hide");
            tablaClientes.ajax.reload();
          }
        },
      });
    }
  });
  event.preventDefault();
});
