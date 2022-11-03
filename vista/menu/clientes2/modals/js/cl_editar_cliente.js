const ModalActualizarCliente = document.getElementById("ModalActualizarCliente");
ModalActualizarCliente.addEventListener("show.bs.modal", (event) => {


$("#nombre_cliente").val(array_selected["NOMBRE_COMERCIAL"]);
$("#razon_social").val(array_selected["RAZON_SOCIAL"]);
$("#nombre_sistema").val(array_selected["NOMBRE_SISTEMA"]);
$("#rfc_cliente").val(array_selected["RFC"]);
$("#curp_cliente").val(array_selected["CURP"]);
$("#abreviatura_cliente").val(array_selected["ABREVIATURA"]);
$("#limite_credito_cliente").val(array_selected["LIMITE_CREDITO"]);
$("#cuenta_contable_cliente").val(array_selected["CUENTA_CONTABLE"]);
$("#tiempo_credito_cliente").val(array_selected["TEMPORALIDAD_DE_CREDITO"]);
$("#pagina_web").val(array_selected["PAGINA_WEB"]);
$("#facebook").val(array_selected["FACEBOOK"]);
$("#instagram").val(array_selected["INSTAGRAM"]);
$("#twitter").val(array_selected["TWITTER"]);
$("#codigo").val(array_selected["CODIGO"]);


});

//Formulario de Preregistro
$("#formActualizarCliente").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formActualizarCliente");
  var formData = new FormData(form);
  formData.set('id',array_selected['ID_CLIENTE']);
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
            tablaClientes.ajax.reload();
          }
        },
      });
    }
  });
  event.preventDefault();
});
