
const ModalSubirInterpretacion = document.getElementById('ModalSubirInterpretacion')
ModalSubirInterpretacion.addEventListener('show.bs.modal', event => {
  // console.log(selectPacienteArea)
  $('#Area-estudio').html(hash)
  // alert(selectEstudio.selectID)
  $('#nombre-paciente-interpretacion').val(selectPacienteArea['NOMBRE_COMPLETO'])
})

//Formulario Para Subir Interpretacion
$("#formSubirInterpretacion").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formSubirInterpretacion");
  var formData = new FormData(form);
  formData.set('id_turno',selectPacienteArea['ID_TURNO'])
  formData.set('id_servicio', selectEstudio.selectID)
  formData.set('api', 10);
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
        url: "../../../api/servicios_api.php",
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
            document.getElementById("formSubirInterpretacion").reset();
            $("#ModalSubirInterpretacion").modal("hide");
            // tablaContacto.ajax.reload();
          }
        },
      });
    }
  });
  event.preventDefault();
});
