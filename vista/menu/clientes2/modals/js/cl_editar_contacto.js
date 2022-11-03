const ModalActualizarContacto = document.getElementById("ModalActualizarContacto");
ModalActualizarContacto.addEventListener("show.bs.modal", (event) => {



$("#nombre_contacto").val(selectContacto["NOMBRE"]);
$("#apellidos_contacto").val(selectContacto["APELLIDOS"]);
$("#telefono1_contacto").val(selectContacto["TELEFONO1"]);
$("#telefono2_contacto").val(selectContacto["TELEFONO2"]);
$("#email_contacto").val(selectContacto["EMAIL"]);






});

//Formulario de Preregistro
$("#formActualizarContacto").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formActualizarContacto");
  var formData = new FormData(form);
  formData.set('id_contacto',selectContacto['ID_CONTACTO']);
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
              title: "Datos Actualizados Correctamente!",
              timer: 2000,
            });
            document.getElementById("formActualizarContacto").reset();
            $("#ModalActualizarContacto").modal("hide");
            tablaContacto.ajax.reload();
          }
        },
      });
    }
  });
  event.preventDefault();
});

$('#btn-eliminar-contacto').on('click', function(){
  event.preventDefault();
  Swal.fire({
    title: "¿Está seguro que desea eliminar este contacto?",
    text: "¡Este contacto no podrá recuperarse!",
    icon: 'warning',
    showCancelButton: true,
    cancelButtonColor: '#3085d6',
    confirmButtonColor: '#d33',
    confirmButtonText: 'ELIMINAR',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      // $('#submit-registrarEstudio').prop('disabled', true);
      // Esto va dentro del AJAX

      $.ajax({
        data: {id: selectContacto['ID_CONTACTO'], api: 4},
        url: "../../../api/contactos_api.php",
        type: "POST",
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
            tablaContacto.ajax.reload();
          }
        },
      });
    }
  });
})
