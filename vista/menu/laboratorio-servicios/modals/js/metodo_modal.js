const ModalVistaMetodos = document.getElementById('ModalVistaMetodos')
ModalVistaMetodos.addEventListener('show.bs.modal', event => {
  TablaMetodos.ajax.reload();
})

//Ajusta el ancho del encabezado cuando es dinamico
$('#ModalVistaMetodos').on('shown.bs.modal', function (e) {
  $.fn.dataTable
    .tables({
      visible: true,
      api: true
    })
    .columns.adjust();
})

//Formulario de registro de metodo
$("#formRegistrarMetodo").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formRegistrarMetodo");
  var formData = new FormData(form);
  formData.set('api', 1);

  Swal.fire({
    title: '¿Está seguro que todos los datos están correctos?',
    text: "¡Guarde o recuerde la contraseña!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Aceptar',
    cancelButtonText: "Cancelar"
  }).then((result) => {
    if (result.isConfirmed) {
      //$("#btn-registrarse").prop('disabled', true);
      // Esto va dentro del AJAX
      $.ajax({
        data: formData,
        url: "../../../api/laboratorio_metodos_api.php",
        type: "POST",
        processData: false,
        contentType: false,
        success: function (data) {
          data = jQuery.parseJSON(data);
          if (mensajeAjax(data)) {
            Toast.fire({
              icon: "success",
              title: "¡Método registrado!",
              timer: 2000,
            });
            document.getElementById("formRegistrarMetodo").reset();
            TablaMetodos.ajax.reload();
            cambiarFormMetodo(0);
            // selectMetodo()
          }
        },
      });
    }
  })
  event.preventDefault();
});

//Formulario de actualizar metodo
$("#formEditarmetodo").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formEditarmetodo");
  var formData = new FormData(form);
  formData.set('id_metodo', array_metodo['ID_METODO']);
  formData.set('api', 3);

  alertMensajeConfirm({
    title: '¿Está seguro de cambiar la descripcion?',
    text: "¡Cuidado con esta accion!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Aceptar',
    cancelButtonText: "Cancelar"
  }, function () {
    //$("#btn-registrarse").prop('disabled', true);
    // Esto va dentro del AJAX
    $.ajax({
      data: formData,
      url: "../../../api/laboratorio_metodos_api.php",
      type: "POST",
      processData: false,
      contentType: false,
      success: function (data) {
        data = jQuery.parseJSON(data);
        if (mensajeAjax(data)) {
          Toast.fire({
            icon: "success",
            title: "¡Método Actualizado!",
            timer: 2000,
          });
          document.getElementById("formEditarmetodo").reset();
          TablaMetodos.ajax.reload();
          cambiarFormMetodo(0);
          // selectMetodo()
        }
      },
    });
  })
  event.preventDefault();
});

// function selectMetodo() {
//   rellenarSelect("#select_metodos", "laboratorio_metodos_api", 2, 0, 1);
// }
// select2('#select_metodos', 'ModalVistaMetodos')