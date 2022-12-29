//Formulario Para Subir Interpretacion
$("#formSubirInterpretacionAudiome").submit(function (event) {
    event.preventDefault();
    /*DATOS Y VALIDACION DEL REGISTRO*/
    var form = document.getElementById("formSubirInterpretacionAudiome");
    var formData = new FormData(form);
    formData.set('turno_id', selectPacienteArea['ID_TURNO'])
    formData.set('api', 1); // Api a donde ir
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
                url: "../../../api/oftalmologia_api.php", // Que api ir
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = jQuery.parseJSON(data);
                    if (mensajeAjax(data)) {
                        alertMensaje('success', 'Interpretación guardada', 'El reporte de resultado ha sido generado...', 'El formulario ha sido cerrado');
                        // document.getElementById("formSubirInterpretacionAudiome").reset();
                        $('button[type="submit"][form="formSubirInterpretacionAudiome"]').prop('disabled', true)
                        $('#formSubirInterpretacionAudiome :textarea').prop('disabled', true)
                        // $("#ModalSubirInterpretacion").modal("hide");
                        // tablaContacto.ajax.reload();
                    }
                },
            });
        }
    });
    event.preventDefault();
});