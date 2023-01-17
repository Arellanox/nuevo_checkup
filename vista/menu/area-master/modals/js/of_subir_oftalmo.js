// const ModalSubirInterpretacionOftalmologia = document.getElementById('ModalSubirInterpretacionOftalmologia')
// ModalSubirInterpretacionOftalmologia.addEventListener('show.bs.modal', event => {
//   // console.log(selectListaLab)
//   $('#Area-estudio').html(hash)
//   $('#nombre-paciente-interpretacion').val(selectPacienteArea['NOMBRE_COMPLETO'])
// })

//Formulario Para Subir Interpretacion
$("#formSubirInterpretacionOftalmo").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formSubirInterpretacionOftalmo");
  var formData = new FormData(form);
  formData.set('turno_id', dataSelect.array['turno'])
  formData.set('api', 1);
  Swal.fire({
    title: "¿Está seguro de subir la interpretación?",
    text: "¡No podrá cambiar los valores!",
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
        url: "../../../api/oftalmologia_api.php",
        type: "POST",
        processData: false,
        contentType: false,
        beforeSend: function () {
          $("#formSubirInterpretacion:submit").prop('disabled', true)
          alertMensaje('info', 'Subiendo información', 'Espere un momento', 'No puede revertir esta acción')
        },
        success: function (data) {
          data = jQuery.parseJSON(data);
          if (mensajeAjax(data)) {
            alertMensaje('success', 'Interpretación guardada', 'Ya puede visualizar el reporte', 'Es necesario confirmar la interpretación');
            //estadoFormulario(1) //Desactiva el formulario
            obtenerServicios(3)
          }
        },
      });
    }
  });
  event.preventDefault();
});