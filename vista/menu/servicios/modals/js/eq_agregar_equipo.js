const ModalRegistrarEquipo = document.getElementById("ModalRegistrarEquipo");
ModalRegistrarEquipo.addEventListener("show.bs.modal", (event) => {

});

//Formulario de Preregistro
$("#formAgregarEquipo").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formAgregarEquipo");
  var formData = new FormData(form);
  formData.set('status',null)
    formData.set('api', 1);
  Swal.fire({
    title: "¿Está seguro que todos los datos están correctos?",
    text: "¡Verifique las Caracteristicas antes de Continuar!",
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
        url: "../../../api/laboratorio_equipos_api.php",
        type: "POST",
        processData: false,
        contentType: false,
        success: function (data) {
          data = jQuery.parseJSON(data);
          if (mensajeAjax(data)) {
            Toast.fire({
              icon: "success",
              title: "Equipo registrado!",
              timer: 2000,
            });
            document.getElementById("formAgregarEquipo").reset();
            $("#ModalRegistrarEquipo").modal("hide");
            tablaEquipo.ajax.reload();
          }
        },
      });
    }
  });
  event.preventDefault();
});
