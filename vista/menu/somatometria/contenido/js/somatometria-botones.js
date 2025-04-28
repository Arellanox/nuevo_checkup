$('#form-resultados-somatometria').submit(function (event) {
    // if (selectListaMuestras['MUESTRA_TOMADA'] == 0) {
    event.preventDefault();
    var form = document.getElementById("form-resultados-somatometria");
    var formData = new FormData(form);
    formData.set('id_turno', selectListaSignos['ID_TURNO'])
    formData.set('medidas[3]', $('#masaCorporal').val())

    formData.set('api', 3);

    Swal.fire({
        title: "¿Está seguro que todos los datos están correctos?",
        text: "¡No podrá cambiar estos datos!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                data: formData,
                url: "../../../api/somatometria_api.php",
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = jQuery.parseJSON(data);
                    if (mensajeAjax(data)) {
                        Toast.fire({
                            icon: "success",
                            title: "¡Signos vitales guardados!",
                            timer: 2000,
                        });
                        tablaSignos.ajax.reload();
                    }
                },
            });

        }
    });
    // }
})

//Panel turnos, mandar id fisica al  principio
obtenerPanelInformacion(3, null, "turnos_panel", '#turnos_panel')

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
        api: 5,
        area_id: 2
    }
    if (fecha) {
        dataListaPaciente['fecha_busqueda'] = $('#fechaListadoAreaMaster').val();
        dataListaPaciente['fecha_busqueda_final'] = $('#fechaFilnalListadoAreaMaster').val();
    }

    tablaSignos.ajax.reload();
}
