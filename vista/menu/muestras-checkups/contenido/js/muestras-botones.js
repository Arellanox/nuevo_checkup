$('#muestra-tomado').on('click', function () {
    if (selectListaMuestras['MUESTRA_TOMADA'] === 0) {
        Swal.fire({
            title: "¿Está seguro de confirmar la muestra?",
            text: "¡El paciente seguirá su turno!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, confirmar muestra",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    data: {api: 3, id_turno: selectListaMuestras['ID_TURNO']},
                    url: "../../../api/toma_de_muestra_api.php",
                    type: "POST",
                    success: function (data) {
                        data = jQuery.parseJSON(data);
                        if (mensajeAjax(data)) {
                            Toast.fire({
                                icon: "success",
                                title: "¡Muestra tomada!",
                                timer: 2000,
                            });
                            tablaMuestras.ajax.reload();
                        }
                    },
                });
            }
        });
    }
})

// cambiar fecha de la Lista
$('#fechaListadoAreaMaster').change(function () {
    recargarVistaLab();
})

$('#fechaFinalListadoAreaMaster').change(function () {
    recargarVistaLab();
})

$('#checkDiaAnalisis').click(function () {
    if ($(this).is(':checked')) {
        recargarVistaLab(0)
        $('#fechaListadoAreaMaster').prop('disabled', true)
        $('#fechaFinalListadoAreaMaster').prop('disabled', true)
    } else {
        recargarVistaLab();
        $('#fechaListadoAreaMaster').prop('disabled', false)
        $('#fechaFinalListadoAreaMaster').prop('disabled', false)
    }
})

function recargarVistaLab(fecha = 1) {
    dataListaPaciente = {
        api: 1,
        id_area: 6,
        con_paquete: 1
    }

    if (fecha) {
        dataListaPaciente['fecha_agenda'] = $('#fechaListadoAreaMaster').val();
        dataListaPaciente['fecha_agenda_final'] = $('#fechaFinalListadoAreaMaster').val();
    }

    tablaMuestras.ajax.reload();
}