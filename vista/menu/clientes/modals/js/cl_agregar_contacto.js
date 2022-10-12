const ModalEditarContacto = document.getElementById("ModalEditarContacto");
ModalEditarContacto.addEventListener("show.bs.modal", (event) => {

});

//Formulario de Preregistro
$("#formActualizarContacto").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formActualizarContacto");
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
        url: "../../../api/contactos_api.php",
        type: "POST",
        processData: false,
        contentType: false,
        success: function (data) {
          data = jQuery.parseJSON(data);
          if (mensajeAjax(data)) {
            Toast.fire({
              icon: "success",
              title: "DatosActualizados Correctamente!",
              timer: 2000,
            });
            document.getElementById("formActualizarContacto").reset();
            $("#ModalActualizarContacto").modal("hide");
            tablaEquipo.ajax.reload();
          }
        },
      });
    }
  });
  event.preventDefault();
});
