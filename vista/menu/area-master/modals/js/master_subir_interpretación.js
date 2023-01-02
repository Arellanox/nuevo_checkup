$('#inputFilesInterpreArea').on('change', function () {
    var fileList = $(this)[0].files || [] //registra todos los archivos
    let aviso = 0;
    for (file of fileList) { //una iteración de toda la vida
        ext = file.name.split('.').pop()
        console.log('>ARCHIVO: ', file.name)
        switch (ext) {
            case 'pdf':
                // console.log('>>TIPO DE ARCHIVO CORRECTO: ')
                break;
            default:
                aviso = 1;
                // console.log('>>TIPO DE ARCHIVO INCORRECTO', ext
                break;
        }
    }
    if (aviso == 1) {
        $(this).val('')
        alertMensaje('error', 'Archivo incorrecto', 'Algunos archivos no son correctos')
    }
});

// const ModalSubirInterpretacion = document.getElementById('ModalSubirInterpretacion')
// ModalSubirInterpretacion.addEventListener('show.bs.modal', event => {
//     // console.log(selectPacienteArea)
//     $('#Area-estudio').html(hash)
//     // alert(selectEstudio.selectID)
//     document.getElementById("formSubirInterpretacion").reset();
//     $('#nombre-paciente-interpretacion').val(selectPacienteArea['NOMBRE_COMPLETO'])
// })


//Formulario Para Subir Interpretacion
$("#formSubirInterpretacion").submit(function (event) {
    // alert(areaActiva)
    event.preventDefault();
    /*DATOS Y VALIDACION DEL REGISTRO*/
    if (confirmado != 1) {
        var form = document.getElementById("formSubirInterpretacion");
        var formData = new FormData(form);
        formData.set('id_turno', selectPacienteArea['ID_TURNO'])
        // formData.set('id_servicio', selectEstudio.selectID)
        formData.set('id_area', areaActiva)
        // formData.set('tipo_archivo', 1)


        //Api y url sacada desde el controlador
        formData.set('api', api);


        Swal.fire({
            title: "¿Está seguro de subir la interpretación?",
            text: "¡No podrá cambiar el reporte!",
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
                    url: http + servidor + "/nuevo_checkup/api/" + url_api + ".php",
                    type: "POST",
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $("#formSubirInterpretacion:submit").prop('disabled', true)
                    },
                    success: function (data) {
                        data = jQuery.parseJSON(data);
                        if (mensajeAjax(data)) {
                            alertMensaje('success', 'Interpretación guardada', '...', 'El formulario ha sido cerrado');
                            estadoFormulario(1) //Desactiva el formulario
                        }
                    },
                    complete: function () {
                        $("#formSubirInterpretacion:submit").prop('disabled', false)
                    }
                });
            }
        });

    } else {
        alertMensaje('info', 'EL resultado ya ha sido guardado', 'No puede cargar mas resultados a este paciente');
    }
    event.preventDefault();
});