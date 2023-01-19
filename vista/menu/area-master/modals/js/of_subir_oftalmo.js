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
  alertMensajeConfirm({
    title: "¿Está seguro guardar la interpretación?",
    text: "Una vez guardado, podrá visualizar el reporte",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Aceptar",
  }, function () {
    // $('#submit-registrarEstudio').prop('disabled', true);
    // Esto va dentro del AJAX
    $.ajax({
      data: formData,
      url: http + servidor + "/nuevo_checkup/api/oftalmologia_api.php",
      type: "POST",
      processData: false,
      contentType: false,
      beforeSend: function () {
        $("#formSubirInterpretacion:submit").prop('disabled', true)
        alertMensaje('info', 'Subiendo información', 'Espere un momento mientras se guarda la información')
      },
      success: function (data) {
        data = jQuery.parseJSON(data);
        if (mensajeAjax(data)) {
          alertMensaje('success', 'Interpretación guardada', 'Ya puede visualizar el reporte', 'Es necesario confirmar la interpretación');
          estadoFormulario(2)
          obtenerServicios(3)
        }
      },
    });
  })
  event.preventDefault();
});

//Formulario Para Subir Interpretacion
$('#btn-confirmar-reporte').click(function (event) {
  /*DATOS Y VALIDACION DEL REGISTRO*/
  alertMensajeConfirm({
    title: "¿Está seguro guardar la interpretación?",
    text: "Una vez guardado, podrá visualizar el reporte",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Aceptar",
  }, function () {
    // $('#submit-registrarEstudio').prop('disabled', true);
    // Esto va dentro del AJAX
    $.ajax({
      data: {
        tunro_id: dataSelect.array['tunro'],
        api: 1,
        confirmado: 1
      },
      url: http + servidor + "/nuevo_checkup/api/oftalmologia_api.php",
      type: "POST",
      beforeSend: function () {
        $("#formSubirInterpretacion:submit").prop('disabled', true)
        alertMensaje('info', 'Subiendo información', 'Espere un momento mientras se guarda la información')
      },
      success: function (data) {
        data = jQuery.parseJSON(data);
        if (mensajeAjax(data)) {
          alertMensaje('success', 'Interpretación guardada', 'Ya puede visualizar el reporte', 'Es necesario confirmar la interpretación');
          estadoFormulario(1) //Desactiva el formulario
          obtenerServicios(3)
        }
      },
    });
  })
});