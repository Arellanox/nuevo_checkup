alert("js agregado")
//Formulario de Preregistro
$("#formAgregarContacto").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formAgregarContacto");
  var formData = new FormData(form);
    formData.set('id_cliente',array_selected['ID_CLIENTE'])
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
              title: "¡Contacto agregado correctamente!",
              timer: 2000,
            });
            document.getElementById("formAgregarContacto").reset();
            $("#ModalAgregarContacto").modal("hide");
            tablaContacto.ajax.reload();
          }
        },
      });
    }
  });
  event.preventDefault();
});
